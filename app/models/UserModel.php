    <?php

    class UserModel
    {
        private $DB;

        public function __construct()
        {
            $this->DB = new Database();
        }

        public function getUserByOtp($otp)
        {
            $DB = new Database();
            $query = "SELECT otp.user_id, otp.otp, u.username, u.email
                    FROM otp_requests otp
                    LEFT JOIN users u ON otp.user_id = u.user_id
                    WHERE otp.otp = :otp"; 
            $data = [
                "otp" => $otp
            ];
            $resultData = $DB->read($query, $data);
            return $resultData ?? false;
        }

        public function createOtp($inputEmail, $otp)
        {
            $DB = new Database();
            $query = "SELECT user_id FROM users WHERE email = :email"; // Assuming you also want user_id
            $data = [
                "email" => $inputEmail
            ];
            $resultData = $DB->read($query, $data);
            if ($resultData) {
                $query = "INSERT INTO otp_requests (user_id,otp,created_at) VALUES (:user_id,:otp,:created_at)"; // Assuming you also want user_id
                $data = [
                    'user_id' => $resultData[0]->user_id,
                    'otp' => $otp,
                    'created_at' => manilaTimeZone('Y-m-d H:i:s')
                ];
                $result = $DB->write($query, $data);
                return $result ? true : false;
            }
        }

        // Method to select user email
        public function selectUserEmail($inputEmail)
        {
            $DB = new Database();
            $query = "SELECT user_id, email FROM users WHERE email = :email"; // Assuming you also want user_id
            $data = [
                "email" => $inputEmail
            ];
            $result = $DB->read($query, $data);
            return $result ? $result[0] : false; // Return the first result or false
        }

        function create($post)
        {
            $DB = new Database();
            $data = [
                'full_name' => $post['full_name'],
                'username' => $post['username'],
                'password' => password_hash($post['password'], PASSWORD_DEFAULT),
            ];
            $query = "INSERT INTO users (full_name, username, password) VALUES (:full_name, :username, :password)";
            $result = $DB->write($query, $data);
            return $result ? true : false;
        }


        // Method to select all accounts
        function selectAllAccounts()
        {
            $query = "SELECT a.*, u.username FROM accounts a LEFT JOIN users u ON a.user_id = u.user_id";
            return $this->DB->read($query) ?: false; // Return false if no results
        }

        // Method to select all login attempts
        function selectAllLoginAttempts()
        {
            $query = "SELECT * FROM login_attempts ORDER BY timestamp DESC";
            return $this->DB->read($query) ?: false; // Return false if no results
        }

        // Method to select all withdrawals
        function selectAllWithdrawals()
        {
            $query = "SELECT w.withdrawal_id, a.account_number, u.username, w.amount, w.date 
                    FROM withdrawals w
                    JOIN accounts a ON w.account_id = a.account_id
                    JOIN users u ON a.user_id = u.user_id
                    ORDER BY w.date DESC";
            return $this->DB->read($query) ?: false; // Return false if no results
        }

        // Method to select all deposits
        function selectAllDeposits()
        {
            $query = "SELECT d.deposit_id, a.account_number, u.username, d.amount, d.date 
                    FROM deposits d
                    JOIN accounts a ON d.account_id = a.account_id
                    JOIN users u ON a.user_id = u.user_id
                    ORDER BY d.date DESC";
            return $this->DB->read($query) ?: false; // Return false if no results
        }

        // Method to insert login attempt
        function insertLoginAttempt($username, $success)
        {
            $data = ['username' => $username];

            // Check if the username exists and get the user_id
            $query = "SELECT user_id FROM users WHERE username = :username";
            $result = $this->DB->read($query, $data);

            if ($result) {
                $user_id = $result[0]->user_id;
                $attemptData = [
                    'user_id' => $user_id,
                    'username' => $username,
                    'ip_address' => getUserIpAddr(),
                    'timestamp' => manilaTimeZone('Y-m-d H:i:s'),
                    'success' => $success ? 1 : 0,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                ];

                // Insert into the login_attempts table
                $insertQuery = "INSERT INTO login_attempts (user_id, username, ip_address, timestamp, success, user_agent) 
                                VALUES (:user_id, :username, :ip_address, :timestamp, :success, :user_agent)";
                return $this->DB->write($insertQuery, $attemptData);
            }
            return false; // Username not found
        }

        // Method to select user by username
        function selectUser($post)
        {
            $data = ['username' => $post['username']];
            $query = "SELECT * FROM users WHERE username = :username";
            $result = $this->DB->read($query, $data);
            return $result ? $result[0] : false; // Return user object or false
        }

        // Method to find a user by their email address
        public function findByEmail($email)
        {
            $DB = new Database();
            $data = [
                'email' => $email,
            ];

            $query = "SELECT * FROM users WHERE email = :email";
            $result = $DB->read($query, $data);
            return $result ? $result[0] : false; // Return the first object or false
        }
        public function storeOtp($userId, $otp)
        {
            if (empty($userId)) {
                return false; // Early exit if user_id is not provided
            }

            $DB = new Database();
            $data = [
                'user_id' => $userId,
                'otp' => $otp,
                'created_at' => manilaTimeZone('Y-m-d H:i:s'), // Ensure this function returns the correct format
            ];

            $query = "INSERT INTO otp_requests (user_id, otp, created_at) VALUES (:user_id, :otp, :created_at)";

            try {
                $result = $DB->write($query, $data); // Ensure this method is functioning correctly
                return $result ? true : false; // This line is redundant
            } catch (PDOException $e) {
                // Log the error for debugging
                error_log("Error storing OTP: " . $e->getMessage());
                return false; // Return false on exception
            }
        }

        // Method to get stored OTP by user ID
        public function getOtpByUserId($userId)
        {
            $data = ['user_id' => $userId];
            $query = "SELECT otp FROM otp_requests WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1";
            $result = $this->DB->read($query, $data);
            return $result ? $result[0]->otp : false; // Return OTP or false
        }

        // Method to clear OTP for a user
        public function clearOtp($userId)
        {
            $data = ['user_id' => $userId];
            $query = "DELETE FROM otp_requests WHERE user_id = :user_id";
            return $this->DB->write($query, $data); // Return true or false
        }

        // Method to update user's password
        public function updatePassword($user_id,$new_password)
        {
            $DB = new Database();
            $query = "UPDATE users SET password = :password WHERE user_id = :user_id";
            $data = [
                'password' => $new_password, 
                'user_id' => $user_id];

            $result = $DB->write($query, $data); // Return true or false
            return $result ? true : false;
        }

        // Method to initiate password reset process
        function resetPassword($username, $newPassword)
        {
            $data = ['username' => $username];
            $query = "SELECT user_id FROM users WHERE username = :username";
            $result = $this->DB->read($query, $data);

            if ($result) {
                $user_id = $result[0]->user_id;
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateData = ['password' => $hashedPassword, 'user_id' => $user_id];
                $updateQuery = "UPDATE users SET password = :password WHERE user_id = :user_id";
                return $this->DB->write($updateQuery, $updateData); // Return true or false
            }

            return false; // Username not found
        }

        // Method for logging out user
        function logout()
        {
            session_destroy(); // End the session
        }
    }

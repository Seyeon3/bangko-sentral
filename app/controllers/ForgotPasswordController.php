<?php

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        if (isset($_SESSION['user_id'])) {
            header("Location: " . PAGE . "dashboard");
            exit();
        }
    }

    // Default method to display the reset password page
    public function index()
    {
        if (isset($_SESSION['send_email_success'])) {
            $this->loadView("components/send_email_success");
            unset($_SESSION['send_email_success']); // Clear the success message after displaying
        }

        $data['current_page'] = "Forgot Password";
        $data['forgot_password_form_errors_messages'] = $_SESSION['forgot_password_form_errors_messages'] ?? null;
        $data['input_email_red_border'] = !empty($data['forgot_password_form_errors_messages']) && in_array("Email is invalid.", $_SESSION['forgot_password_form_errors_messages']) ? 'is-invalid' : '';
        $data['input_email'] = $_SESSION['input_email'] ?? '';
        $this->loadView("forgot_password", $data);
        exit();
    }

    public function send_email()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Initialize session variables
            $_SESSION['forgot_password_form_errors_messages'] = [];
            $_SESSION['input_email'] = htmlspecialchars(trim($_POST['email'])); // Trim whitespace

            if (empty($_SESSION['input_email'])) {
                $_SESSION['forgot_password_form_errors_messages'][] = "Email is required.";
            }

            // If there are validation errors, redirect back to the forgot password page
            if (!empty($_SESSION['forgot_password_form_errors_messages'])) {
                header('Location: ' . PAGE . 'forgotpassword');
                exit();
            }

            // reCAPTCHA verification
            $recaptcha_secret = "6Lc3n1IqAAAAAHkClbuWORNsxl3q9QuvYmli3gjN"; // Replace with your secret key
            $recaptcha_response = $_POST['g-recaptcha-response'];
            $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $response_data = json_decode($verify_response);

            if (!$response_data->success) {
                // reCAPTCHA validation failed
                $_SESSION['forgot_password_form_errors_messages'][] = "reCAPTCHA verification failed. Please try again.";
                header('Location: ' . PAGE . 'forgotpassword');
                exit();
            }

            // Validate email if existing in database
            $USER = $this->loadModel("UserModel");
            $returnData = $USER->selectUserEmail($_SESSION['input_email']);

            if ($returnData) {
                // Generate a random OTP
                $otp = generateRandomString(20);

                $USER->createOtp($_SESSION['input_email'],$otp);
                
                $recipient = $_SESSION['input_email'];
                $subject = 'Change Password';
                $body = "You can now change your password <a href=\"http://localhost/bangko_central/changepassword/key/$otp\">HERE</a>";

                // Store the OTP in the database
                if (!$USER->storeOtp($returnData->user_id, $otp)) {
                    $_SESSION['forgot_password_form_errors_messages'][] = "Failed to store OTP.";
                    header('Location: ' . PAGE . 'forgotpassword');
                    exit();
                } else {
                    // OTP stored successfully, now send the email
                    $_SESSION['send_email_success'] = "An OTP has been sent to your email address."; // Set success message
                }

                // Send the OTP via email using Google Apps Script
                $scriptUrl = "https://script.google.com/macros/s/AKfycbwbBd44OS6Pu0X6W_kzFnTOJUaG2ohRDR1DILmbOSR-y9HrAaF9l7_mgbrjeF8cvjpfnw/exec";
                $data = array(
                    "recipient" => $recipient,
                    "subject" => $subject,
                    "body" => $body,
                    "isHTML" => 'true' // Set to true to send HTML email
                );

                // Initialize cURL
                $ch = curl_init($scriptUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

                // Execute cURL and check for errors
                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    $_SESSION['forgot_password_form_errors_messages'][] = "Failed to send email: " . curl_error($ch);
                } else {
                    // Email sent successfully
                    header('Location: ' . PAGE . 'forgotpassword');
                    exit();
                }
                curl_close($ch);
            } else {
                $_SESSION['forgot_password_form_errors_messages'][] = "Email is invalid.";
                header('Location: ' . PAGE . 'forgotpassword');
                exit();
            }
        } else {
            // Invalid request method
            header("Location: " . PAGE . "404");
            exit();
        }
    }
    // Handle invalid pages
    public function invalid_page()
    {
        $data['current_page'] = "Invalid Page";
        $this->loadView("404", $data);
    }
}

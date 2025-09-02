<?php

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        // Redirect logged-in users to the dashboard
        if (isset($_SESSION['user_id'])) {
            header("Location: " . PAGE . "dashboard");
            exit();
        }
    }

    // Method to display the change password form
    public function index()
    {
        header("Location: changepassword/key");
        exit();
    }
    // Method to handle the submission of the new password
    public function key($key = "")
    {
        if ($key)
        {
            $USER = $this->loadModel("UserModel");
            $resultData = $USER->getUserByOtp($key);
            $data['user_id'] = $resultData[0]->user_id;
            $data['username'] = $resultData[0]->username;
            $data['email'] = $resultData[0]->email;
            $data['key'] = $resultData[0]->otp;
            $data['current_page'] = 'Change Password';

            $data['changepassword_form_errors_messages'] = $_SESSION['changepassword_form_errors_messages'] ?? null;
            $data['input_confirm_password_red_border'] = !empty($data['changepassword_form_errors_messages']) && in_array("Confirm password do not match", $_SESSION['changepassword_form_errors_messages']) ? 'is-invalid' : '';
            $data['input_password'] = $_SESSION['input_password'] ?? '';

            $this->loadView("change_password", $data);
            exit(); 
        }else{
            header("Location: " . PAGE . "404");
            exit();
        }

    }

    public function change($key="")
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $userId = $_SESSION['reset_user_id'];
            $_SESSION['changepassword_form_errors'] = [];
            $_SESSION['new_password'] = htmlspecialchars($_POST['new_password']);
            $_SESSION['confirm_password'] = htmlspecialchars($_POST['confirm_password']);

            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
 

            if ($new_password !== $confirm_password) {
                $_SESSION['changepassword_form_errors'][] = "Confirm password do not match";
                header("Location: ../../changepassword/key/".$key);
                exit();
            }


            // Hash the new password
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Load the user model and update the password
            $USER = $this->loadModel("UserModel");
            $result = $USER->updatePassword($_POST['user_id'],$new_password);
            

            if ($result) {
                header("Location: " . PAGE . "login");
                exit();
            }
        } else {
            // Invalid request method
            header("Location: " . PAGE . "404");
            exit();
        }
    }
}

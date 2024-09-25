<?php
class ContactController extends Controller
{

  public function __construct()
  {
    if (isset($_SESSION['user_id'])) {
      header("Location: " . PAGE . "profile");
      exit();
    }
  }
  function index() //default method
  {
    $data['current_page'] = "Contact";
    $data['contact_form_success_message'] = $_SESSION['contact_form_success_message'] ?? null;
    $data['contact_form_errors_messages'] = $_SESSION['contact_form_errors_messages'] ?? null;

    $data['input_full_name_red_border'] = !empty($data['contact_form_errors_messages']) && in_array("Full Name must be greater than 3 characters and less than 20 characters.", $_SESSION['contact_form_errors_messages']) ? 'is-invalid' : '';
    $data['input_subject_red_border'] = !empty($data['contact_form_errors_messages']) && in_array("Subject must be between 3 and 100 characters.", $_SESSION['contact_form_errors_messages']) ? 'is-invalid' : '';
    $data['input_message_red_border'] = !empty($data['contact_form_errors_messages']) && in_array("Message must be between 3 and 255 characters.", $_SESSION['contact_form_errors_messages']) ? 'is-invalid' : '';
    $data['checkbox_recaptcha_red_border'] = !empty($data['contact_form_errors_messages']) && in_array("reCAPTCHA verification failed. Please try again.", $_SESSION['contact_form_errors_messages']) ? 'border-danger' : '';
   
    $data['input_full_name_value'] = $_SESSION['input_full_name'] ?? '';
    $data['input_email_value'] = $_SESSION['input_email'] ?? '';
    $data['input_subject_value'] = $_SESSION['input_subject'] ?? '';
    $data['input_message_value'] = $_SESSION['input_message'] ?? '';
    
    $this->loadView("contact", $data);

    unset($_SESSION['contact_form_errors_messages']);
    unset($_SESSION['input_full_name']);
    unset($_SESSION['input_email']);
    unset($_SESSION['input_subject']);
    unset($_SESSION['input_message']);
    unset($_SESSION['contact_form_success_message']);
  }

  function send()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $_SESSION['contact_form_errors_messages'] = [];
      $_SESSION['input_full_name'] = htmlspecialchars($_POST['full_name'], ENT_QUOTES, 'UTF-8');
      $_SESSION['input_email'] = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
      $_SESSION['input_subject'] = htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8');
      $_SESSION['input_message'] = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

      if (strlen($_SESSION['input_full_name']) < 3 || strlen($_SESSION['input_full_name']) > 20) {
        $_SESSION['contact_form_errors_messages'][] = "Full Name must be greater than 3 characters and less than 20 characters.";
      }

      if (strlen($_SESSION['input_subject']) < 3 || strlen($_SESSION['input_subject']) > 100) {
        $_SESSION['contact_form_errors_messages'][] = "Subject must be between 3 and 100 characters.";
      }
      if (strlen($_SESSION['input_message']) < 3 || strlen($_SESSION['input_message']) > 100) {
        $_SESSION['contact_form_errors_messages'][] = "Message must be between 3 and 255 characters.";
      }

      if (!empty($_SESSION['contact_form_errors_messages'])) {
        header('Location: ' . PAGE . 'contact');
        exit();
      }

      // reCAPTCHA verification
      $recaptcha_secret = "6Lfs0k0qAAAAAFIuoQqvm42oDbI84cT789i8D0cq";
      $recaptcha_response = $_POST['g-recaptcha-response'];
      $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
      $response_data = json_decode($verify_response);

      if (!$response_data->success) {
        // reCAPTCHA validation failed
        $_SESSION['contact_form_errors_messages'][] = "reCAPTCHA verification failed. Please try again.";
        header('Location: ' . PAGE . 'contact');
        exit();
      }

      $CONTACT = $this->loadModel("ContactModel");
      $returnResult = $CONTACT->sendMessage($_POST);

      if ($returnResult) {
        $_SESSION['contact_form_success_message']= "Message Sent Success.";
        unset($_SESSION['input_full_name']);
        unset($_SESSION['input_email']);
        unset($_SESSION['input_subject']); 
        unset($_SESSION['input_message']);
        header('Location: ' . PAGE . 'contact');
        exit();
      } else {
        $_SESSION['contact_form_errors_messages'][] = "Sending Message Failed.";
        header('Location: ' . PAGE . 'contact');
        exit();
      }
    } else {
      // Invalid request method
      header("Location: " . PAGE . "invalid_page");
      exit();
    }
  }


  function invalid_page() //invalid the page if the method if doesn't exist
  {
    $data['current_page'] = "Invalid Page";
    $this->loadView("404", $data);
  }
}

<?php
class DashboardController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      header("Location: " . PAGE);
      exit();
    }
  }

  function index()
  {
    $data['current_page'] = "Dashboard";
    $USER = $this->loadModel("UserModel");
    $data['login_attempts_table'] = $USER->selectAllLoginAttempts();
    $data['contact_messages_table'] = $USER->selectAllContactMessages();
    $this->loadView("dashboard", $data);
  }
  
  function invalid_page()
  {
    $data['current_page'] = "Invalid Page";
    $this->loadView("404", $data);
  }
}

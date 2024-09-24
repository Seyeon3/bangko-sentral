<?php
class ProfileController extends Controller
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
    $USER = $this->loadModel("UserModel");
    $data['current_page'] = "Profile";
    $this->loadView("profile", $data);
  }

  function invalid_page()
  {
    $data['current_page'] = "Invalid Page";
    $this->loadView("404", $data);
  }
}

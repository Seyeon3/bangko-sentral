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
    $this->loadView("contact", $data);
  }


  function invalid_page() //invalid the page if the method if doesn't exist
  {
    $data['current_page'] = "Invalid Page";
    $this->loadView("404", $data);
  }
}

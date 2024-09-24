<?php
class ContactModel
{
  function sendMessage($post)
  {
    $DB = new Database();
    $data = [
      'full_name' => $post['full_name'],
      'email' => $post['email'],
      'subject' => $post['subject'],
      'message' => $post['message'],
      'created_at' => manilaTimeZone('Y-m-d H:i:s'),
    ];
    $query = "INSERT INTO contact_messages (full_name, email, subject, message, created_at) VALUES (:full_name, :email, :subject, :message, :created_at)";
    $result = $DB->write($query, $data);
    return $result ? true : false;
  }
}

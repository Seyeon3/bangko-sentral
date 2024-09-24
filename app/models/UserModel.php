<?php
class UserModel
{
  function selectUser($post)
  {
    $DB = new Database();
    $data = [
      'username' => $post['username'],
    ];
    $query = "SELECT * FROM users WHERE username = :username";
    $result = $DB->read($query, $data);
    return $result ? $result : false;
  }

  function logout()
  {
    session_destroy();
  }
}

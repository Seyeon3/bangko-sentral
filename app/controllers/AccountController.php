<?php
session_start();
require 'bangko';

// Check if logged in
if (!isset($_SESSION['user']['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
$errors = [];
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($fullname) || empty($email)) {
        $errors[] = "Full Name and Email are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($errors)) {
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET fullname = ?, email = ?, password = ? WHERE id = ?");
            $stmt->bind_param("sssi", $fullname, $email, $hashedPassword, $user_id);
        } else {
            $stmt = $conn->prepare("UPDATE users SET fullname = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssi", $fullname, $email, $user_id);
        }

        if ($stmt->execute()) {
            // Update session
            $_SESSION['user']['fullname'] = $fullname;
            $_SESSION['user']['email'] = $email;
            $success = "Account updated successfully.";
        } else {
            $errors[] = "Something went wrong.";
        }
    }
}

// Get current user info
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

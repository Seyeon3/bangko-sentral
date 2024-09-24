<?php
// Explicit function created by programmer 

function sessionFloatingAlert($type, $message)
{
  if (isset($_SESSION['floating_alert']) && $_SESSION['floating_alert'] === $message) {
    echo '
    <div id="sessionFloatingAlert" class="floating-alert alert alert-'.$type.' d-flex w-100 shadow" role="alert">
      <span class="text mx-auto">' . $message . '.</span>
    </div>';
    unset($_SESSION['floating_alert']);
  }
}

function generateIssuanceReference($length = 10) {
  $prefix = 'ISS'; // You can customize the prefix if needed
  $randomString = $prefix . substr(uniqid(mt_rand(), true), 0, $length - strlen($prefix));
  return $randomString;
}

function uppercaseFirstLetter($str) {
  return ucfirst($str);
}

function manilaTimeZone($format)
{
  $manilaTimezone = new DateTimeZone('Asia/Manila');
  $currentDateTimeManila = new DateTime('now', $manilaTimezone);
  $formattedDateTime = $currentDateTimeManila->format($format);
  return $formattedDateTime;
}

function show($stuff)
{
  echo "<pre>";
  print_r($stuff);
  echo "</pre>";
}
function showAllSession()
{
  foreach ($_SESSION as $key => $value) {
    echo $key . ' = ' . $value . '<br>';
  }
}
function generateRandomString($length = 10)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';

  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, strlen($characters) - 1)];
  }

  return $randomString;
}
function datePrettier($inputDate)
{
  $timestamp = strtotime($inputDate);
  if ($timestamp === false) {
    return "Invalid date format";
  }
  $formattedDate = date("F d, Y", $timestamp); // Use 'd' for two-digit day
  return $formattedDate;
}
function datePrettierWithTime($inputDate)
{
  $timestamp = strtotime($inputDate);
  if ($timestamp === false) {
    return "Invalid date format";
  }
  $formattedDate = date("F d, Y, g:i A", $timestamp); // Use 'd' for two-digit day
  return $formattedDate;
}
function relativeTime($timestamp)
{
  date_default_timezone_set('Asia/Manila');
  $currentTimestamp = time();
  $timestamp = strtotime($timestamp);
  $difference = $currentTimestamp - $timestamp;

  if ($difference < 60) {
    return "just now";
  } elseif ($difference < 3600) {
    $minutes = floor($difference / 60);
    return $minutes . " minute" . ($minutes > 1 ? "s" : "") . " ago";
  } elseif ($difference < 86400) {
    $hours = floor($difference / 3600);
    return $hours . " hour" . ($hours > 1 ? "s" : "") . " ago";
  } else {
    return date("F d, Y H:i A", $timestamp);
  }
}
function ticketStatusBadge($data)
{
  if ($data == 'New') {
    return 'badge text-bg-success';
  }
  if ($data == 'Open') {
    return 'badge text-bg-primary';
  }
  if ($data == 'Solved') {
    return 'badge text-bg-warning';
  }
  if ($data == 'Closed') {
    return 'badge text-bg-danger';
  }
}
function ticketStatusColor($data)
{
  if ($data == 'New') {
    return 'text-success';
  }
  if ($data == 'Open') {
    return 'text-primary';
  }
  if ($data == 'Solved') {
    return 'text-warning';
  }
  if ($data == 'Closed') {
    return 'text-danger';
  }
}
function isNullDate($datetime)
{
  if ($datetime == null) {
    return "-- -- --";
  } else {
    return datePrettierWithTime($datetime);
  }
}

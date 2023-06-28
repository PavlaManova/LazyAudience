<?php

require_once './userModel.php';

$curr_user = new User();
$hosted_events = $curr_user->fetchAllHostedEvents($_SESSION['user_id']);
$eventId = $_GET['id'];
$isAdmin = false;

foreach ($hosted_events as &$e) {
  $isAdmin |= $e['id'] == $eventId;
}

if (!isset($_SESSION['username']) || !$isAdmin) {
  header('Location: ./loginView.php');
}
?>
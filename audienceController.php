<?php

$curr_user = new User();
$guest_events = $curr_user->fetchAllGuestEvents($_SESSION['user_id']);
$eventId = $_GET['id'];
$isGuest = false;

foreach ($guest_events as &$e) {
    if ($e['id'] == $eventId) {
        $isGuest = true;
        break;
    }
}

if (!isset($_SESSION['username']) || !$isGuest) {
    header('Location: ./loginView.php');
}
?>
<?php

require_once 'eventsModel.php';
session_start();

$event = new Event();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_event'])) {
    if ($event->insertEvent($_POST['name'], $_POST['description'], $_POST['date'], $_POST['hour'], $_SESSION['user_id'])) {
        $audience_data = json_decode($_POST['audience'], true);
        //save audience links to the event id
        for($i=0; $i<count($audience_data); $i++ )
        {
            $event->bindEventToInvitedUser($audience_data[array_keys($audience_data)[$i]],$event->getLastInsertedEventId());
        } 
        echo "success";
    } else {
        echo "fail";
    }
}
?>
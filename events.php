<?php

require_once 'eventsModel.php';
session_start();

$event = new Event();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_event'])) {
    if ($event->insertEvent($_POST['name'], $_POST['description'], $_POST['date'], $_POST['hour'], $_SESSION['user_id'])) {
        $audiance_data = json_decode($_POST['audiance'], true);
        //save audiance links to the event id
        for($i=0; $i<count($audiance_data); $i++ )
        {
            $event->bindEventToInvitedUser($audiance_data[array_keys($audiance_data)[$i]],$event->getLastInsertedEventId());
        } 
        echo "success";
    } else {
        echo "fail";
    }
}
?>
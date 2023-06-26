<?php
$message = isset($_POST["message"]) ? $_POST["message"] : "";
$memoryEfficientMsg = strlen($message) > 0 ? $message."\n" : "";
$eventID = isset($_POST["eventId"]) ? $_POST["eventId"] : 0;

file_put_contents("text_".$eventID.".tmp", $message,  FILE_APPEND );
file_put_contents("text_".$eventID.".log", $memoryEfficientMsg,  FILE_APPEND );
?>
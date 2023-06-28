<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    echo $_POST['message'];


    $message = isset($_POST["message"]) ? $_POST["message"] : "";
    $memoryEfficientMsg = strlen($message) > 0 ? $message . "\n" : "";
    $eventID = isset($_POST["eventId"]) ? $_POST["eventId"] : 0;

    // file_put_contents("./tmp/text_".$eventID.".tmp", $message,  FILE_APPEND );
    file_put_contents("./events_logs/text_" . $eventID . ".log", $memoryEfficientMsg, FILE_APPEND);
}
?>
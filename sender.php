<?php

$message = isset($_GET["message"]) ? $_GET["message"] : "5";
file_put_contents("text.txt", $message);
?>
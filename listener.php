<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['eventId'])) {

	$eventID = isset($_GET["eventId"]) ? $_GET["eventId"] : -1;
	$file = "./events_logs/text_" . $eventID . ".log";

	if (file_exists($file)) {
		$lines = file($file);

		echo json_encode(["message" => $lines[count($lines) - 1]]);
	}
	else
	{
		echo json_encode(["message" => ""]);
	}

}
?>
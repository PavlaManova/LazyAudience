<?php
// this->userID ima li eventID
$lastTimeStamp= isset($_GET["timestamp"]) ? $_GET["timestamp"] : 0;
$eventID= isset($_GET["eventId"]) ? $_GET["eventId"] : 0;
$file = "./tmp/text_".$eventID.".tmp";
$currentTimeStamp = filemtime($file);

while ($lastTimeStamp == $currentTimeStamp)
{
	clearstatcache();
	session_write_close();
	$currentTimeStamp = filemtime($file);
	usleep(5000);
}

echo json_encode(["message" => file_get_contents($file), "timestamp" => $currentTimeStamp]);

//Clear file
file_put_contents($file, "");
?>
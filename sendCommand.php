<?php
set_time_limit(0);
// var_dump(1);

header('Content-Type: text/event-stream');
header('Connection: keep-alive');
header('Cache-Control: no-store');

header('Access-Control-Allow-Origin: *');
session_start();
echo "retry: 500\n\n";
// while (true) {
echo "data: \n\n";
ob_flush();
flush();

// if (connection_aborted())
//    break;


if ($_SESSION['changed']) {
  echo 'data: ' . $_SESSION['msg'] . '. Message from bigboxcode, at - ' . date('Y-m-d H:i:s');
  echo "55\n\n";

  $_SESSION['changed'] = false;
} else {
  echo "\n\n";
}

ob_flush();
flush();

// sleep(1);
?>
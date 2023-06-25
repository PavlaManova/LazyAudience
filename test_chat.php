<?php
// index.php

session_start();



if (!isset($_SESSION['msg'])) {
    $_SESSION['msg'] = 1;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['msg']++;
    $_SESSION['changed'] = true;
    echo $_SESSION['msg'];
}
?>
<?php
require_once './userModel.php';
$user = new User();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_points_to_user'])) {
    $currentPoints = $user->getUserInfo($_SESSION['username'])['user_points'];
    $newPoints = $currentPoints+$_POST['add_points_to_user'];
    $user->updatePoints($_SESSION['user_id'], $newPoints);
    echo $newPoints;
}

?>
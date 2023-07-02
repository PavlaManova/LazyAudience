<?php 
require_once './userModel.php';
$user = new User();
session_start();
$userInfo;
if (isset($_SESSION['username'])) {
    $userInfo = $user->getUserInfo($_SESSION['username']);
    $username = $userInfo['username'];
    $avatar_img = $userInfo['avatar_img_path'];
    $user_points = $userInfo['user_points'];

    $_SESSION['user_id'] = $userInfo['id'];
    $_SESSION['user_points'] = $userInfo['user_points'];
    $_SESSION['avatar_img'] = $avatar_img;
} else {
    // user is not authenticated
    header('Location: ./loginView.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['get_users'])) {
    $usersInfoJson = json_encode($user->fetchAllUsersForInvitation($userInfo['username']));
    header('Content-Type: application/json');
    echo $usersInfoJson;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['load_guest_events'])) {
    $userEventsInfoJson = json_encode($user->fetchAllGuestEvents($userInfo['id']));
    header('Content-Type: application/json');
    echo $userEventsInfoJson;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['load_hosted_events'])) {
    $userEventsInfoJson = json_encode($user->fetchAllHostedEvents($userInfo['id']));
    header('Content-Type: application/json');
    echo $userEventsInfoJson;
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sound_id'])){
    $sound_id = $_POST['sound_id'];
    $user->buySound($_SESSION['user_id'], $sound_id, (int)$_SESSION['user_points']);
    header('Content-Type: application/json');
}
?>
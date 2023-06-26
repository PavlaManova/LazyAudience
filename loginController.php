<?php
require_once 'connect.php';
session_start();
$error_message = "";
$user = new User();

// If user is logged then log out him/her.
if (isset($_SESSION['username'])){
    session_destroy();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrieve the form data
    $entered_username = $_POST['username'];
    $entered_password = $_POST['password'];

    // server-side validation
    if (empty($entered_username) || empty($entered_password)) {
        $error_message = "Error: Please fill in all the required fields.";
        die("Error: Please fill in all the required fields.");
    }

    $userInfo = $user->getUserInfo($entered_username);

    if ($userInfo) {
        $userPassword = $userInfo['password'];

        //check password
        if (password_verify($entered_password, $userPassword)) {
            $_SESSION['username'] = $entered_username;
            $_SESSION['fileName'] = $userInfo['avatar_img_path'];
            header(("Location: homepageView.php"));
            exit();
        } else {
            $error_message = "Incorrect password.";
        }

    } else {
        $error_message = "User does not exist.";
    }
}
?>
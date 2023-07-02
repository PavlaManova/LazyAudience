<?php

require_once './userModel.php';
session_start();
$user = new User();
$error_message = "";

// Define allowed image file types
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrieve the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $targetDir;
    $fileIsUploaded = false;
    if ((isset($_FILES['avatar']) && !empty($_FILES['avatar']['tmp_name']))) {
        $profilePicture = $_FILES["avatar"]["tmp_name"];
        $targetDir = './uploads/' . basename($_FILES["avatar"]["name"]);
        $fileIsUploaded = true;
    } else {
        $targetDir = './uploads/1.png';
        
    }


    // Server-side validation
    if (empty($username) || empty($password) || empty($email)) {
        $error_message = "Error: Please fill in all the required fields.";
    }


    //check user exists
    elseif ($user->checkUserExists($username, $email)) {
        $error_message = "Username or email already exist.";
    }

    //validate username
    elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $error_message = "Invalid username. Please use only alphanumeric characters and underscores.";
    }
    // validate email
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email address. Please enter a valid email.";
    }

    //validate img path
    // Check if the file is an image type
    elseif ($fileIsUploaded && in_array($_FILES["avatar"]['type'], $allowedTypes)) {
        // File is an image type
        if (move_uploaded_file($profilePicture, $targetDir)) {
            //var_dump( "Profile picture uploaded successfully!");
        } else {
            $error_message = "Error uploading the profile picture.";
        }
    }


    if (empty($error_message)) {
        if ($user->insertUser($username, $password, $email, $targetDir)) {
            $_SESSION["username"] = $username;

            header("Location: homepageView.php");
            exit();
        } else {
            $error_message = "Registration failed.";
        }
    }
}
?>
<?php

require_once './userModel.php';
session_start();
$error_message = "";
$user = new User();

// Define allowed image file types
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrieve the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $profilePicture = $_FILES["avatar"]["tmp_name"];
    $targetDir = 'uploads/' . basename($_FILES["avatar"]["name"]);

    // Server-side validation
    if (empty($username) || empty($password) || empty($email)) {
        $error_message = "Error: Please fill in all the required fields.";
        die("Error: Please fill in all the required fields.");
    }


    //check user exists
    if ($user->checkUserExists($username, $email)) {
        $error_message = "Username or email already exist.";
        //die("Username or email already exist");
    }

    //validate username
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $error_message = "Invalid username. Please use only alphanumeric characters and underscores.";
       // die("Invalid username. Please use only alphanumeric characters and underscores.");
    }

    // validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email address. Please enter a valid email.";
      //  die("Invalid email address. Please enter a valid email.");
    }

    // ДА СЕ ОПРАВЯТ ГРЕШКИТЕ ДА НЕ СА САМО С ECHO
    //validate img path
    // Check if the file is an image type
    if ($_FILES["avatar"]!=null && in_array($_FILES["avatar"]['type'], $allowedTypes)) {
        // File is an image type
        if (move_uploaded_file($profilePicture, $targetDir)) {
            //var_dump( "Profile picture uploaded successfully!");
        } else {
            //var_dump( "Error uploading the profile picture.");
            $error_message = "Error uploading the profile picture.";
        }
    } else {
        var_dump( 'Invalid file type. Only JPEG, PNG, and GIF images are allowed.');
        // File is not an image type
        $error_message = 'Invalid file type. Only JPEG, PNG, and GIF images are allowed.';
    }

    if ($user->insertUser($username, $password, $email, $targetDir)) {
        // $response = array("success" => true);
        $_SESSION["username"] = $username;
        $_SESSION["fileName"] = $targetDir;

        header("Location: ./homepageView.php");
        // //echo json_encode($response);
        exit();
    } else {
        $error_message = "Registration failed.";
        die("Registration failed.");
    }


}
?>
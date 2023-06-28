<?php

require_once './userModel.php';
session_start();

// Define allowed image file types
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrieve the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $targetDir;
    $fileIsUploaded = false;
    if (!file_exists($_FILES['avatar']['tmp_name']) || !is_uploaded_file($_FILES['avatar']['tmp_name'])) {
        $targetDir = 'uploads/1.png';
    } else {
        $profilePicture = $_FILES["avatar"]["tmp_name"];
        $targetDir = 'uploads/' . basename($_FILES["avatar"]["name"]);
        $fileIsUploaded = true;
    }
    $_SESSION['message'] = "";


    // Server-side validation
    if (empty($username) || empty($password) || empty($email)) {
        $_SESSION['message'] = 'Please fill all the required fields.';
        // header("Location: registration.html");
        // exit();

        // $response = array("success" => false, "message" => "Please fill all the fields.");

    }

    //check user exists
    if ($user->checkUserExists($username, $email)) {
        $_SESSION['message'] = "Username or email already exist.";
        // header(("Location: registration.html"));
        // exit();

        //$response = array("success" => false, "message" => "Username or email already exist");
    }

    //validate username
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $_SESSION['message'] = "Invalid username. Please use only alphanumeric characters and underscores.";
        // header("Location: registration.html");
        // exit();
    }

    // validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email address. Please enter a valid email.";
        // header("Location: registration.html");
        // exit();
    }

    //validate img path
    // Check if the file is an image type
    if ($fileIsUploaded && in_array($_FILES["avatar"]['type'], $allowedTypes)) {
        // File is an image type
        if (move_uploaded_file($profilePicture, $targetDir)) {
            var_dump("Profile picture uploaded successfully!");
        } else {
            var_dump("Error uploading the profile picture.");
            $_SESSION['message'] = "Error uploading the profile picture.";
            // header("Location: registration.html");
            // exit();
        }
    }
    // else {
    //     var_dump( 'Invalid file type. Only JPEG, PNG, and GIF images are allowed.');
    //     // File is not an image type
    //     $_SESSION['message'] = 'Invalid file type. Only JPEG, PNG, and GIF images are allowed.';
    //     // header("Location: registration.html");
    //     // exit();
    // }

    if ($user->insertUser($username, $password, $email, $targetDir)) {
        // $response = array("success" => true);
        $_SESSION["username"] = $username;
        // $_SESSION["fileName"] = $targetDir;

        header("Location: ./homepageView.php");
        // //echo json_encode($response);
        exit();
    } else {
        //$response = array("success" => false);
        $_SESSION['message'] = "Registration failed.";
        // header("Location: registration.html");
        // //echo json_encode($response);
        // exit();
    }


}
?>
<?php
    include('./registrationController.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" text="text/css" href="styles.css">
</head>
<body>
    <header  class="display-flex">
        <h1 class="index-title">Registration Form</h1>
    </header>
    <?php if (!empty($error_message)) { ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php } ?>
    <main id="mainregistration">
        <form id="registrationForm" method="POST" action="">
            <div>    
                <label for="username">Username:</label>
                <input type="text" id="username1" name="username" class="registration-input" required><br>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="registration-input" required><br>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="registration-input" required><br>
            </div>
            <div>
                <label for="avatar">Upload Avatar Image</label>
                <input type="file" id="avatar" name="avatar" class="custom-file-input"><br>
            </div>
            <button type="submit" id="register" class="btn-big">Register</button>
        </form>
        <button onclick="goBack()" id="goback" class="btn-big margin-top-15">Go Back</button>
    </main>
    <script>
        function goBack() {
            window.location.href = './index.php';
        }
    </script>
</body>
</html>

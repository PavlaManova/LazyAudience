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
    <header>
        <h1>Registration Form</h1>
    </header>
    <?php if (!empty($error_message)) { ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php } ?>
    <main>
        <form id="registrationForm" method="POST" action="">
            <div>    
                <label for="username">Username:</label>
                <input type="text" id="username1" name="username" required><br>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
            </div>
            <div>
                <label for="avatar">Upload Avatar Image</label>
                <input type="file" id="avatar" name="avatar" class="custom-file-input"><br>
            </div>
            <button type="submit" id="register">Register</button>
        </form>
        <button onclick="goBack()" id="goback">Go Back</button>
    </main>
    <script>
        function goBack() {
            window.location.href = './index.php';
        }
    </script>
</body>
</html>

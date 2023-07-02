<?php 
    include('./loginController.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="display-flex">
        <h1 class="index-title">Login</h1>
    </header>
    <?php if (!empty($error_message)) { ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php } ?>
    <main id="mainlogin">
        <form id="loginForm" method="POST" action="">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="registration-input" required>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="registration-input" required>
            </div>

            <button type="submit" id="loging" class="btn-big margin-top-15">Login</button>
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

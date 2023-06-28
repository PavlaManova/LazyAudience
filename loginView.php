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
    <header>
        <h1>Login</h1>
    </header>
    <?php if (!empty($error_message)) { ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php } ?>
    <main>
        <form method="POST" action="">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" id="loging">Login</button>
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

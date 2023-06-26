<?php include 'homepageController.php' ?>
<?php include 'audienceController.php' ?>

<!DOCTYPE html>
<html>

<head>
    <title>Audience Page</title>
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <header>
        <section id="user-info">
            <img id="profile-picture" src="<?php echo $avatar_img; ?>"></img>
            <p id="username" class="username">
                <?php echo $_SESSION['username']; ?> <br>
                <?php echo $_SESSION['user_points']; ?> pts
            </p>
        </section>
        <button id="log-out-btn" onclick="logout()"></button>
    </header>
    <section class="display-flex">
        <h1 id="site-name" onclick="showHomePage()">Lazy Audience</h1>
    </section>

    <section class="command-screen display-flex">
        <figure class="command-background">
            <p class="command-text">Waiting for command...</p>
            <p class="command-time"></p>
        </figure>
    </section>
    <section class="text-align-center" id="user-sounds-categories">
        <h1 class="error-message hide">You don't have any sounds yet</h1>
        <section class="hide">
            <button class="play-sound-btn">Applause</button>
        </section>
    </section>
</body>
<script src="audience.js"></script>

</html>
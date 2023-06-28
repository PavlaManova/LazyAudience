<?php include './homepageController.php' ?>
<?php include './hostController.php' ?>

<!DOCTYPE html>
<html>

<head>
    <title>Host Event Page</title>
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <header>
        <section id="user-info">
            <img id="profile-picture" src="<?php echo $avatar_img; ?>"></img>
            <p id="username" class="username">
                <?php echo $username; ?> <br>
                <?php echo $user_points; ?> pts
            </p>
        </section>
        <button id="log-out-btn" onclick="logout()"></button>
    </header>
    <section class="display-flex">
        <h1 id="site-name" onclick="showHomePage()">Lazy Audience</h1>
    </section>

    <section class="text-align-center">
        <h1>Select the time for your next command</h1>
        <section class="options-container">
            <section class="time-btns-container  w-50">
                <input label="Immediately" type="radio" id="immediately" name="time" value="immediately" checked>
                <input label="In 3 2 1" type="radio" id="3-2-1" name="time" value="3-2-1">
                <input label="In 10 9 8..." type="radio" id="10-9-8" name="time" value="10-9-8">
            </section>
        </section>
        <br>
        <h1>Select the type of the command</h1>
        <section class="options-container">
            <section class="time-btns-container w-100">
                <input label="Applause" type="radio" id="applause" name="category" value="applause" checked>
                <input label="Laugh" type="radio" id="laugh" name="category" value="laugh">
                <input label="Booing" type="radio" id="booing" name="category" value="booing">
                <input style="display:block;" label="Bravo!" type="radio" id="bravo" name="category" value="bravo">
                <input label="Whistle" type="radio" id="whistle" name="category" value="whistle">
                <input label="Cheering" type="radio" id="cheering" name="category" value="cheering">
                <input label="Disappointment" type="radio" id="disappointment" name="category" value="disappointment">
                <input label="Distinct Chatter" type="radio" id="distinct-chatter" name="category" value="distinct-chatter">
            </section>
            
        </section>
        <button class="btn-big margin-top-15" id="commandButton"
      onclick="sendCommand()">Send</button>
    </section>

</body>
<script src="./hostEvent.js"></script>
</html>
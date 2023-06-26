<?php
session_start();

require_once 'connect.php';

$curr_user = new User();
$hosted_events = $curr_user->fetchAllHostedEvents($_SESSION['user_id']);
$eventId = $_GET['id'];
$isAdmin = false;

foreach ($hosted_events as &$e) {
  $isAdmin |= $e['id'] == $eventId;
}

if (!isset($_SESSION['username']) || !$isAdmin) {
  header('Location: ./loginView.php');
}
?>

<html>
  <head>
    <title>PHP SSE Demo</title>
  </head>

  <body>
    <button
      id="commandButton"
      onclick="commandBtnClick()"
      action="sendCommand.php"
    >
      Send
    </button>
    <ul id="list">
      <!-- new content appears here -->
    </ul>
  </body>

  <script>
    var l = 5;
    function commandBtnClick() {
      const urlParams = new URLSearchParams(window.location.search);
      const eventId = urlParams.get("id");

      var command = "Your command" + (++l).toString(); // Replace with the command you want to send
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "./sender.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          console.log(xhr.responseText);
        }
      };
      xhr.onerror = function () {
        console.log("An error occurred");
      };
      xhr.send("message=" + command + "&eventId=" + eventId);
    }

    function runScript() {
      fetch("sendCommand.php", {
        method: "POST",
      })
        .then(function (response) {
          return response.text();
        })
        .then(function (data) {
          console.log(data); // Handle the response from the PHP script
        })
        .catch(function (error) {
          console.log("Error:", error);
        });
    }
  </script>
</html>

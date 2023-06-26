<html>
  <head>
    <title>PHP SSE Demo</title>
  </head>

  <script src="AjaxPush.js"></script>

  <body>
    <!-- <button id="commandButton" onclick="commandBtnClick()">Send</button> -->
    <ul id="list">
      <!-- new content appears here -->
    </ul>
    <div id="history"></div>
  </body>

  <script>
    let timestamp = 0;
    var n = function () {
      return (Math.random() * 190).toFixed(0);
    };

    // create anonymous users
    var c = "rgb(" + n() + ", " + n() + "," + n() + ")";
    var template =
      "<strong style='color: " + c + "'>" + "user_" + n() + "</strong>: ";

    const urlParams = new URLSearchParams(window.location.search);
    const eventId = urlParams.get("id");

    function listener() {
      var xhttpr = new XMLHttpRequest();
      xhttpr.open(
        "GET",
        "listener.php?timestamp=" + new Date().getTime() + 
        "&eventId=" + eventId,
        true
      );
      xhttpr.setRequestHeader("Content-Type", "application/json");

      xhttpr.onload = function () {
        if (xhttpr.status === 200) {
          var data = JSON.parse(xhttpr.responseText);
          console.log(data);
          timestamp = data.timestamp;
          var historyElement = document.getElementById("history");

          let newMsg = data.message.length > 0 ? data.message + "<br>" : "";
          historyElement.textContent += newMsg;
        }
      };

      xhttpr.onerror = function () {
        console.info("The connection has been lost!, trying to reconnect ...");
      };

      xhttpr.send(JSON.stringify({ timestamp: timestamp }));
    }

    listener();
    setInterval(listener, 200);

    // // Function to fetch new messages and update the list
    // function fetchMessages() {
    //   var xhr = new XMLHttpRequest();
    //   xhr.open("GET", "http://localhost/Demo/get_messages.php", true);
    //   xhr.onreadystatechange = function () {
    //     if (xhr.readyState === 4 && xhr.status === 200) {
    //       console.log(xhr.response);
    //       // var newMessages = JSON.parse(xhr.responseText);

    //       // // Update the list of messages on the page
    //       // var messagesList = document.getElementById('list');
    //       // for (var i = 0; i < newMessages.length; i++) {
    //       //   var newMessageElement = document.createElement('li');
    //       //   newMessageElement.textContent = newMessages[i];
    //       //   messagesList.appendChild(newMessageElement);
    //       // }
    //     }
    //   };
    //   xhr.send();
    // }

    // // Execute fetchMessages function initially and every 5 seconds
    // fetchMessages();
    // setInterval(fetchMessages, 500);

    // function commandBtnClick() {
    //   var command = "Your command"; // Replace with the command you want to send
    //   var xhr = new XMLHttpRequest();
    //   xhr.open("POST", "./test_chat.php", true);
    //   xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //   xhr.onreadystatechange = function () {
    //     if (xhr.readyState === 4 && xhr.status === 200) {
    //       console.log(xhr.responseText);
    //     }
    //   };
    //   xhr.onerror = function () {
    //     console.log("An error occurred");
    //   };
    //   xhr.send("command=" + encodeURIComponent(command));
    // }
  </script>
</html>

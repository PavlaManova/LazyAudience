currentCategoryFromCommand = "";
const pointsForCorrectSound = 3;
let lastFetchedCommandId = -1;

const commandIdIndex = 0,
commandTextIndex = 1,
commandTimeIndex = 2;

const urlParams = new URLSearchParams(window.location.search);
const eventId = urlParams.get("id");

function showHomePage() {
  window.location.href = "./homepageView.php";
}

loadCategoriesSounds();

function loadCategoriesSounds() {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "./soundsController.php?get_user_categories=true", true);
  xhttp.onload = function () {
    if (this.status === 200) {
      var data = JSON.parse(this.responseText);

      if (data.length == 0) {
        document
          .getElementsByClassName("error-message")[0]
          .classList.remove("hide");
      } else {
        data.forEach((element) => {
          appendCategoryBtnChildToList(element);
        });
      }
    } else {
      console.log("Error" + xhttp.status);
    }
  };
  xhttp.send();
}

function appendCategoryBtnChildToList(element) {
  let singleCategory = document
    .getElementsByClassName("play-sound-btn")[0]
    .cloneNode(true);
  singleCategory.textContent = element["category"];

  singleCategory.id = "play-" + element["category"];
  singleCategory.onclick = (function (categoryName) {
    return function () {
      playRandomSoundFromCategory(categoryName);
    };
  })(element["category"]);

  document.getElementById("user-sounds-categories").appendChild(singleCategory);
}

let timesPressed = 0;

function playRandomSoundFromCategory(categoryName) {
  if (timesPressed) return;

  let commandCategory =
    document.getElementsByClassName("command-text")[0].textContent;
  let commandTime =
    document.getElementsByClassName("command-time")[0].textContent;

  //if the button pressed is for the correct category and the user is allowed to make sound
  if (
    categoryName == commandCategory &&
    (commandTime == "Now" || commandTime == "")
  ) {
    timesPressed++;
    updateUserPointsOnCorrectSound();
  } else {
    timesPressed++;
    return;
  }
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "./soundsController.php?category=" + categoryName, true);
  xhttp.onload = function () {
    if (this.status === 200) {
      let randomSound = new Audio(this.responseText);
      randomSound.play();
    } else {
      console.log("Error" + xhttp.status);
    }
  };
  xhttp.send();
}

function logout() {
  var newUrl = "./index.php"; // Replace with the desired URL
  history.replaceState({}, "", newUrl);

  window.location.href = newUrl;
}

function polling() {
  var xhttpr = new XMLHttpRequest();
  xhttpr.open(
    "GET",
    "./listener.php?&eventId=" + eventId,
    true
  );
  xhttpr.setRequestHeader("Content-Type", "application/json");

  xhttpr.onload = function () {
    if (xhttpr.status === 200) {
      if(!xhttpr.responseText) return;
      var data = JSON.parse(xhttpr.responseText);

      var command = document.getElementsByClassName("command-text")[0];
      var time = document.getElementsByClassName("command-time")[0];

      let newMsg = data.message.length > 0 ? data.message : "";
      if (newMsg) {
        let dataArr = newMsg.split(";");
        if (lastFetchedCommandId == dataArr[commandIdIndex]) return;
        else {
          lastFetchedCommandId = dataArr[commandIdIndex];
        }
        command.textContent = dataArr[commandTextIndex];
        timesPressed = 0;

        switch (dataArr[commandTimeIndex]) {
          case "Immediately\n": {
            time.textContent = "Now";
            timesPressed = 0;
            break;
          }
          case "In 3 2 1\n": {
            messages = ["In 3", "In 2", "In 1", "Now", ""];
            displayMessage(messages, 0, time);
            break;
          }
          case "In 10 9 8...\n": {
            messages = [
              "In 10",
              "In 9",
              "In 8",
              "In 7",
              "In 6",
              "In 5",
              "In 4",
              "In 3",
              "In 2",
              "In 1",
              "Now",
              "",
            ];
            displayMessage(messages, 0, time);
            break;
          }
        }
      }
    }
  };

  xhttpr.onerror = function () {
    console.log("The connection has been lost!");
  };

  xhttpr.send();
}

polling();
setInterval(polling, 500);

function displayMessage(message, index, timeElement) {
  let delay;
  if (index == 0 || index == message.length) {
    delay = 0;
  } else delay = 1000;

  setTimeout(function () {
    timeElement.textContent = message[index];

    if (index + 1 < message.length) {
      displayMessage(message, index + 1, timeElement); // Recursive call to display next message
    }
  }, delay);
}

function updateUserPointsOnCorrectSound() {
  //save new points in DB
  let newPoints = 0;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./userController.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      //update points in current page view
      document.getElementById("username").textContent =
        document.getElementById("username").textContent.split("\n")[0] +
        "\n" +
        document.getElementById("username").textContent.split("\n")[1] +
        "\n" +
        xhr.responseText +
        " pts";
    }
  };
  xhr.onerror = function () {
    console.log("An error occurred");
  };
  xhr.send("add_points_to_user=" + encodeURIComponent(pointsForCorrectSound));
}

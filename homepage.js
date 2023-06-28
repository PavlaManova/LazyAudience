let contentShowingId = "hero";

let usersForCurrentEvent = [];
let soundsForBuying = [];
let currentBuySoundWrapper;

const categoriesCount = 8;

loadSounds();
loadEvents();
loadSoundsForBuying();

function navBtnPressed(element) {
  document.getElementById("line").classList.remove("hide");
  moveLine(element);
  changeSection(element);
}

function moveLine(element) {
  const line = document.getElementById("line");
  const navItems = document.getElementsByClassName("nav-item");

  for (let i = 0; i < navItems.length; i++) {
    navItems[i].classList.remove("active");
  }

  element.classList.add("active");
  const offsetLeft = element.offsetLeft - 39;
  const width = element.offsetWidth;
  line.style.width = width + "px";
  line.style.transform = "translateX(" + offsetLeft + "px)";
}

function changeSection(element) {
  document.getElementById(contentShowingId).classList.add("hide");

  let contentToBeShownId;
  switch (element.id) {
    case "sounds": {
      contentToBeShownId = "sounds-content";
      break;
    }
    case "invitations": {
      contentToBeShownId = "invitations-content";
      break;
    }
    case "create-event": {
      contentToBeShownId = "create-event-content";
      break;
    }
    case "events": {
      contentToBeShownId = "events-content";
      break;
    }
  }

  document.getElementById(contentToBeShownId).classList.remove("hide");

  contentShowingId = contentToBeShownId;
}

function showHomePage() {
  moveLine(document.getElementById("site-name"));
  document.getElementById("line").classList.add("hide");
  document.getElementById(contentShowingId).classList.add("hide");
  document.getElementById("hero").classList.remove("hide");

  contentShowingId = "hero";
}

function logout() {
  var newUrl = "./index.php"; // Replace with the desired URL
  history.replaceState({}, "", newUrl);

  window.location.href = newUrl;
}

function openUsersPopUp() {
  window.scrollTo(0, 0);

  document.getElementById("users-wrapper").classList.remove("hide");

  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "./homepageController.php?get_users=true", true);

  xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      // Parse the response as JSON
      var usersInfo = JSON.parse(this.responseText);

      for (var i = 0; i < usersInfo.length; i++) {
        createInviteUserElement(usersInfo[i]);
      }
    }
  };
  xhttp.send();
}

function createInviteUserElement(user) {
  let singleUser = document.getElementById("single-user-info").cloneNode(true);
  singleUser.getElementsByClassName("user-to-invite-username")[0].textContent =
    user["username"];
  singleUser.getElementsByClassName("user-to-invite-points")[0].textContent =
    user["user_points"];

  let inviteBtn = singleUser.getElementsByClassName("accept-btn")[0];
  inviteBtn.id = "invite-" + user["id"];
  inviteBtn.onclick = (function (userID) {
    return function () {
      inviteUser(userID);
    };
  })(user["id"]);

  document.getElementById("users-pop-up").appendChild(singleUser);
}

function closeUsersPopUp() {
  window.scrollTo(0, 0);
  document.getElementById("users-wrapper").classList.add("hide");
}

function inviteUser(otherUserID) {
  usersForCurrentEvent.push(otherUserID);
}

document
  .getElementById("create-event-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    //TO DO - add the current event to events container because the container is already fetched

    let name = document.getElementById("name").value;
    let description = document.getElementById("description").value;
    let date = document.getElementById("date").value;
    let time = document.getElementById("hour").value;

    var audienceJsonString = JSON.stringify(usersForCurrentEvent);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./events.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          if (xhr.responseText == "success") {
            document.getElementById("create-event-form").reset();
          } else {
            alert("Something went wrong. Try again");
          }
        } else {
          console.error("Request failed with status:", xhr.status);
        }
      }
    };
    xhr.onerror = function () {
      console.log("An error occurred");
    };
    xhr.send(
      "create_event=1&name=" +
        encodeURIComponent(name) +
        "&description=" +
        encodeURIComponent(description) +
        "&date=" +
        encodeURIComponent(date) +
        "&hour=" +
        encodeURIComponent(time) +
        "&audience=" +
        encodeURIComponent(audienceJsonString)
    );

    usersForCurrentEvent = [];

    alert("Event added successfully!");
    location.reload();
  });

function loadEvents() {
  GETRequestForHostedEvents(
    "./homepageController.php?load_hosted_events=true",
    "events-host-list",
    true
  );
  GETRequestForHostedEvents(
    "./homepageController.php?load_guest_events=true",
    "events-list",
    false
  );
}

function GETRequestForHostedEvents(requestURL, listId, isHost) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", requestURL, true);
  xhttp.onload = function () {
    if (this.status === 200) {
      var data = JSON.parse(this.responseText);

      data.forEach((element) => {
        appendEventChildToGivenList(element, listId, isHost);
      });
    } else {
      console.log("Error" + xhttp.status);
    }
  };
  xhttp.send();
}

function appendEventChildToGivenList(element, listId, isHost) {
  let singleEvent = document.getElementsByClassName("event")[0].cloneNode(true);

  singleEvent.getElementsByClassName("event-title")[0].textContent =
    element["name"];

  singleEvent.getElementsByClassName("event-time")[0].textContent =
    element["date"];

  let enterBtn = singleEvent.getElementsByClassName("btn-big")[0];
  enterBtn.id = "enter-" + element["id"];
  enterBtn.onclick = (function (eventId, isHost) {
    return function () {
      if (isHost) enterHostedEvent(eventId);
      else enterGuestEvent(eventId);
    };
  })(element["id"], isHost);

  document.getElementById(listId).appendChild(singleEvent);
}

function enterGuestEvent(event_id) {
  window.location.href = "./audienceView.php?id=" + event_id;
}

function enterHostedEvent(event_id) {
  window.location.href = "./hostView.php?id=" + event_id;
}

function loadSounds() {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "./soundsController.php?load_sounds=true", true);
  xhttp.onload = function () {
    if (this.status === 200) {
      var data = JSON.parse(this.responseText);
      for (var i = 0; i < data.length; i++) {
        let categoryData = data[i];
        for (var key in categoryData) {
          if (categoryData.hasOwnProperty(key)) {
            if (categoryData[key]) {
              categoryData[key].forEach((element) => {
                appendSoundChildToList(element, i);
              });
            }
          }
        }
      }
    } else {
      console.log("Error" + xhttp.status);
    }
  };
  xhttp.send();
}

function appendSoundChildToList(element, i) {
  let singleSound = document.getElementsByClassName("sound")[0].cloneNode(true);
  singleSound.getElementsByClassName("sound-name")[0].textContent =
    element["name"];

  let playBtn = singleSound.getElementsByClassName("btn-small")[0];
  playBtn.id = "play-" + element["id"];
  playBtn.onclick = (function (soundPath) {
    return function () {
      new Audio(soundPath).play();
    };
  })(element["path"]);

  let parentNode = document.getElementsByClassName("sounds")[i];
  let buyBtn = parentNode.getElementsByClassName("buy-sound-btn")[0];
  parentNode.insertBefore(singleSound, buyBtn);
}

function loadSoundsForBuying() {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "./soundsController.php?load_sounds_for_buying=true", true);
  xhttp.onload = function () {
    if (this.status === 200) {
      soundsForBuying = JSON.parse(this.responseText);
    } else {
      console.log("Error" + xhttp.status);
    }
  };
  xhttp.send();
}

function openBuyPopUp(categoryIndex) {
  window.scrollTo(0, 0);
  currentBuySoundWrapper = document
    .getElementById("buy-sounds-wrapper")
    .cloneNode(true);
  currentBuySoundWrapper.classList.remove("hide");

  var currentList = currentBuySoundWrapper.getElementsByClassName("pop-up")[0];

  let categoryData = soundsForBuying[categoryIndex];
  for (var key in categoryData) {
    if (categoryData.hasOwnProperty(key)) {
      if (categoryData[key]) {
        categoryData[key].forEach((element) => {
          appendSoundChildToBuyPopUp(element, currentList);
        });
      }
    }
  }

  document.body.appendChild(currentBuySoundWrapper);
}

function appendSoundChildToBuyPopUp(element, currentList) {
  let singleSound = currentList
    .getElementsByClassName("single-sound-info")[0]
    .cloneNode(true);
  singleSound.getElementsByClassName("sound-to-buy-name")[0].textContent =
    element["name"];
  singleSound.getElementsByClassName("sound-to-buy-points")[0].textContent =
    element["points"];
  currentList.appendChild(singleSound);
}

function buySound() {}

function closeBuyPopUp() {
  window.scrollTo(0, 0);
  document.body.removeChild(currentBuySoundWrapper);
}

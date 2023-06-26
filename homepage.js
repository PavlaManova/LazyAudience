let contentShowingId = "hero";

let usersForCurrentEvent = [];

loadEvents();

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
  var newUrl = "../Demo/index.html"; // Replace with the desired URL
  history.replaceState({}, "", newUrl);

  // Redirect the user to the logout or home page
  // Example: Redirecting to the login page
  window.location.href = newUrl;
}

function openUsersPopUp() {
  window.scrollTo(0, 0);

  document.getElementById("users-wrapper").classList.remove("hide");

  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "homepageController.php?get_users=true", true);

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

    //TO DO - DA SE DOBAVI EVENTA KUM EVENTS TABA

    let name = document.getElementById("name").value;
    let description = document.getElementById("description").value;
    let date = document.getElementById("date").value;
    let time = document.getElementById("hour").value;

    var audianceJsonString = JSON.stringify(usersForCurrentEvent);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./events.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          console.log(xhr.responseText);
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
      "&audiance=" +
      encodeURIComponent(audianceJsonString)
    );

    usersForCurrentEvent = [];
  });

function loadEvents() {
  GETRequestForHostedEvents(
    "homepageController.php?load_hosted_events=true",
    "events-host-list",
    true
  );
  GETRequestForHostedEvents(
    "homepageController.php?load_guest_events=true",
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
  window.location.href = './test.php?id=' + event_id;
}

function enterHostedEvent(event_id) {
  fetch('sendCommand.php');
  window.location.href = './admin.php?id=' + event_id;

}

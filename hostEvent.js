let commandId = 0;
let sendingColor = true;

let colorInputContainer = document.getElementById("color-input-container");

function showColorInput()
{
  sendingColor = true;
  colorInputContainer.classList.remove('hide');
}

function hideColorInput()
{
  sendingColor = false;
  colorInputContainer.classList.add('hide');
}

function sendCommand() {
  const urlParams = new URLSearchParams(window.location.search);
  const eventId = urlParams.get("id");

  let category = getCheckedButtonLabelFrom("category");
  let time = getCheckedButtonLabelFrom("time");
  let hexColor = document.getElementById('color-input').value;

  var command = commandId.toString() + ";" + category + ";" + time;
  sendingColor? command+=';'+hexColor : 0;
  commandId++;
  
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./sender.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
  };
  xhr.onerror = function () {
    console.log("An error occurred");
  };
  xhr.send("message=" + command + "&eventId=" + eventId);
}

function getCheckedButtonLabelFrom(name) {
  let radioButtons = document.getElementsByName(name);

  var checkedButton;
  for (var i = 0; i < radioButtons.length; i++) {
    if (radioButtons[i].checked) {
      checkedButton = radioButtons[i];
      break;
    }
  }
  return checkedButton.getAttribute("label");
}

function showHomePage() {
  window.location.href = "./homepageView.php";
}

function logout() {
  var newUrl = "./index.php"; // Replace with the desired URL
  history.replaceState({}, "", newUrl);

  window.location.href = newUrl;
}

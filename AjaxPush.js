function AjaxPush(listener, sender) {
  this.listener = listener || "";
  this.sender = sender || "";
  this.state = false;
  this.timestamp = 0;
}

AjaxPush.prototype.connect = function(callback) {
  var that = this;
  var status = false;

  var xhr = new XMLHttpRequest();
  xhr.open('GET', this.listener, true);
  xhr.setRequestHeader('Content-Type', 'application/json');

  xhr.onload = function() {
    if (!that.state)
      console.info("Connected!");

    status = true;
    that.state = true;

    if (xhr.status === 200) {
      var data = JSON.parse(xhr.responseText);
      that.timestamp = data.timestamp;
      callback(data);
    }
  };

  xhr.onerror = function() {
    console.info("The connection has been lost!, trying to reconnect ...");
    setTimeout(function() {
      that.connect(callback);
    }, 1000);
  };

  xhr.onloadend = function() {
    that.state = (xhr.status === 200);
    that.connect(callback);
  };

  xhr.send(JSON.stringify({ timestamp: this.timestamp }));
};
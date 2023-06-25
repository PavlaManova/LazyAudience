 document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var isValid = validateForm();
    if (isValid)
    {
        var messageElement = document.getElementById('message');
        var message = sessionStorage.getItem('message');
    
        if ( message !== null && message !== '') {
            messageElement.innerText = message;
            messageElement.style.display = 'block'; // Show the pop-up message
        }
    
        // Clear the session storage variables
        sessionStorage.removeItem('message'); 
    }
   
});


/* function submitForm(event) {
    event.preventDefault(); // Prevent the default form submission

    var form = event.target; // Get the form element

    // Create a new FormData object and append the form data to it
    var formData = new FormData(form);

    // Send an AJAX request to the server
    var xhr = new XMLHttpRequest();
    xhr.open("POST", form.action);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Request successful
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Registration successful, redirect to another page
                    window.location.href = "home.html";
                } else {
                    // Display the error message
                    var errorMessage = response.message;
                    var errorDiv = document.getElementById("error-message");
                    errorDiv.textContent = errorMessage;
                }
            } else {
                // Request failed
                console.error("Error: " + xhr.status);
            }
        }
    };
    xhr.send(formData);
}
*/

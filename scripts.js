document.getElementById('loginForm').addEventListener('submit', function (event) {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
  
    if (!username || !password) {
        event.preventDefault();
        document.getElementById('error').textContent = 'Please fill out all fields.';
    }
  });
  function validateForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var errorMessage = document.getElementById("errorMessage");
  
    if (username === "" || password === "") {
      errorMessage.textContent = "Both fields are required.";
      return false;
    }

    if (username === "admin" && password === "admin123") {
        location.replace('loggedIn.php');
      return true;
    } else {
      errorMessage.textContent = "Invalid username or password.";
      return false;
    }
  } 
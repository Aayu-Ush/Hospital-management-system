<?php
    include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Manchester Hospital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="non_loggedin.css" type="text/css">
    <style>
        
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f4f8; /* Light background */
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    overflow-x: hidden;
}

.top-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #1E244B; /* New color */
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    padding: 15px 20px;
    z-index: 950;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.top-nav .contact-info span {
    font-size: 14px;
    font-weight: 500;
}

.top-nav .login-button {
    padding: 10px 20px;
    background-color: #ffffff;
    color: #1E244B; /* New color */
    font-weight: 600;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.top-nav .login-button:hover {
    background-color: #e0e0e0; /* Light hover effect */
    transform: scale(1.05);
}

.container {
    display: flex;
    flex-grow: 1;
    margin-top: 70px;
    background-color: #2D336B;
}

.navPart {
    width: 60px;
    background-color: #1E244B; /* New color */
    color: white;
    transition: width 0.3s ease;
    position: fixed;
    top: 70px;
    left: 0;
    bottom: 0;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    z-index: 1000;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

.navPart.expanded {
    width: 200px;
}

.toggle-button {
    margin: 10px;
    cursor: pointer;
    font-size: 20px;
    background: none;
    border: none;
    color: white;
}

.navPart nav {
    margin-top: 20px;
    width: 100%;
}

.navPart ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.navPart li {
    width: 100%;
}

.navPart a {
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 15px 0;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.navPart a:hover {
    background-color: rgba(255, 255, 255, 0.2); /* Lighter hover effect */
    transform: scale(1.05);
}

.navPart i {
    margin-right: 10px;
}

.navPart.expanded a {
    justify-content: flex-start;
    padding-left: 20px;
}

.navPart.expanded a span {
    display: inline;
}

.navPart a span {
    display: none;
}

.otherPart {
    flex-grow: 1;
    padding: 20px;
    margin-left: 60px;
    transition: margin-left 0.3s ease;
}

.navPart.expanded ~ .otherPart {
    margin-left: 200px;
}

.header {
    text-align: center;
    padding: 20px;
}

.header h1 {
    font-size: 32px;
    margin: 0;
    color: rgb(255, 255, 255); /* New color */
    font-weight: 600;
}

.header h2 {
    text-align: center;
    margin-top: 10px;
    font-weight: 500;
    color: rgb(255, 255, 255); /* New color */
}

.login-container {
    background: #ffffff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 450px;
    margin: 0 auto;
    text-align: center;
}

.login-container h2 {
    font-size: 26px;
    color: #2D336B; /* Main color */
    margin-bottom: 30px;
    font-weight: 600;
    letter-spacing: -0.5px;
}

.input-group {
    margin-bottom: 25px;
    text-align: left;
}

.input-group label {
    display: block;
    font-size: 14px;
    color: #555;
    margin-bottom: 8px;
    font-weight: 500;
}

.input-group input {
    width: 100%;
    padding: 12px 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    background-color: #f9f9f9;
    text-align: left;
}

.input-group input:focus {
    border-color: #2D336B; /* Main color */
    background-color: #fff;
    outline: none;
}

.input-group input::placeholder {
    color: #999;
}

button {
    width: 100%;
    padding: 14px;
    background-color: #2D336B; /* Main color */
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 10px;
}

button:hover {
    background-color: #1E244B; 
}

.error-message {
    color: #ff6b6b;
    font-size: 14px;
    margin-bottom: 20px;
    font-weight: 500;
}

.login-container p {
    font-size: 14px;
    color: #777;
    margin-top: 20px;
}

.login-container a {
    color: #2D336B; /* Main color */
}
        </style>
</head>
<body>
    <div class="top-nav">
        <div class="contact-info">
            <span>Email: contact@manchesterhospital.com</span>
            <span>Phone: +1 234 567 890</span>
        </div>
        <button class="login-button"><img src="loggedIn.png" alt="Login"><marquee>Hello Dear, Please log in to continue! This is the Manchester Hospital. Feel free to talk about your problems and we shall solve them!</marquee></button>
    </div>

    <div class="container">
        <div class="navPart" id="nav">
            <button class="toggle-button" id="toggleNav">☰</button>
            <nav>
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i><span>Home</span></a></li>
                    <li><a href="#"><i class="fas fa-calendar-check"></i><span>Appointments</span></a></li>
                    <li><a href="#"><i class="fas fa-user-md"></i><span>Doctors</span></a></li>
                    <li><a href="#"><i class="fas fa-user"></i><span>Patients</span></a></li>
                    <li><a href="#"><i class="fas fa-file-invoice-dollar"></i><span>Billings</span></a></li>
                    <li><a href="#"><i class="fas fa-chart-line"></i><span>Reports</span></a></li>
                    <li><a href="#"><i class="fas fa-book-medical"></i><span>Book A Doctor</span></a></li>
                    <li><a href="#"><i class="fas fa-cog"></i><span>Settings</span></a></li>
                </ul>
            </nav>
        </div>

        <div class="otherPart" id="mainContent">
            <div class="header">
                <h1>Welcome to The Manchester Hospital, Please Log In!</h1>
            </div>
                    
            <div class="login-container">
                <h2>Login</h2>
                <form id="loginForm" onsubmit="return validateForm()" action="login.php" method="POST">
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="error-message" id="errorMessage"></div>
                    <button type="submit">Login</button>
                </form>
                <p>Forgot your password? <a href="#">Reset it here</a></p>
            </div>
        </div>
    </div>
    <script src="scripts.js"></script>
    <script>
        const toggleNav = document.getElementById('toggleNav');
        const nav = document.getElementById('nav');
        const mainContent = document.getElementById('mainContent');

        nav.classList.add('expanded');

        toggleNav.addEventListener('click', () => {
        nav.classList.toggle('expanded');
        mainContent.classList.toggle('expanded');
});
    </script>
</body>
</html>
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="loggedin.css">
</head>
<body>
    <div class="top-nav">
        <div class="contact-info">
            <span>Email: contact@manchesterhospital.com</span><td>
            <span>Phone: +1 234 567 890</span>
        </div>
        <button class="login-button">
            <img src="loggedIn.png" alt="Login"> User
        </button>
    </div>

    <div class="container">
        <div class="navPart" id="nav" class="expanded"> <!-- Added class 'expanded' -->
            <button class="toggle-button" id="toggleNav">☰</button>
            <nav>
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i><span>Home</span></a></li>
                    <li><a href="appointments.php"><i class="fas fa-calendar-check"></i><span>Appointments</span></a></li>
                    <li><a href="doctors.php"><i class="fas fa-user-md"></i><span>Doctors</span></a></li>
                    <li><a href="patients.php"><i class="fas fa-user"></i><span>Patients</span></a></li>
                    <li><a href="#"><i class="fas fa-file-invoice-dollar"></i><span>Billings</span></a></li>
                    <li><a href="#"><i class="fas fa-chart-line"></i><span>Reports</span></a></li>
                    <li><a href="#"><i class="fas fa-cog"></i><span>Settings</span></a></li>
                </ul>
            </nav>
        </div>

        <div class="otherPart" id="mainContent">
            <div class="header">
                <h1>Hello Receptionist, Welcome to The Manchester Hospital</h1>
            </div>

            <div class="Lists">
                <div class="dashboard-container">
                    <div class="dashboard-card" onclick="delayedRedirect('doctors.php');">
                        <h4>Doctor List</h4>
                        <i class="fas fa-user-md fa-3x"></i>
                    </div>
                    <div class="dashboard-card" onclick="delayedRedirect('patients.php');">
                        <h4>Patient List</h4>
                        <i class="fas fa-procedures fa-3x"></i>
                    </div>
                    <div class="dashboard-card" onclick="location.href='appointments.php';">
                        <h4>View Appointments</h4>
                        <i class="fas fa-calendar-alt fa-3x"></i>
                    </div>
                    <div class="dashboard-card" onclick="location.href='#';">
                        <h4>Billings</h4>
                        <i class="fas fa-file-invoice-dollar fa-3x"></i>
                    </div>
                    <div class="dashboard-card" onclick="location.href='#';">
                        <h4>Reports</h4>
                        <i class="fas fa-bed fa-3x"></i>
                    </div>
                    <div class="dashboard-card" onclick="location.href='#';">
                        <h4>Settings</h4>
                        <i class="fas fa-chart-line fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function delayedRedirect(url) {
            setTimeout(function() {
                window.location.href = url;
            }, 1000);
        }

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
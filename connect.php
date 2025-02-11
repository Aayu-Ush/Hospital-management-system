<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "manchester_hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

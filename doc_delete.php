<?php
include 'connect.php';

if (isset($_GET['deleteid'])) {
    $id = intval($_GET['deleteid']); 

    $sql = "DELETE FROM doctors WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: doctors.php');
        exit();
    } else {
        die("Error: " . mysqli_error($conn));
    }
}
?>

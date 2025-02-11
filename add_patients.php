<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $address = $_POST['address'];
    $age = $_POST['age'];

    if (empty($name) || empty($email) || empty($phone_no) || empty($address) || empty($age)) {
        die("All fields are required.");
    }

    $sql = "INSERT INTO patients (name, email, phone_no, address, age) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone_no, $address, $age);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: patients.php');
            exit();
        } else {
            echo "Error executing query: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Patients</title>
    <link rel="stylesheet" href="addlists.css">
</head>
<body>

<div class="container">
    <h1>The Manchester Hospital, Add Patient</h1>
    <form method="post">
        <table>
            <tr>
                <th colspan="2">Enter Details of Patient</th>
            </tr>
            <tr>
                <td><label for="name">Name</label></td>
                <td><input type="text" id="name" name="name" placeholder="Enter Patient's name" required></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" id="email" name="email" placeholder="Enter email" required></td>
            </tr>
            <tr>
                <td><label for="phone_no">Phone No</label></td>
                <td><input type="text" id="mobile" name="phone_no" placeholder="Enter phone number" required></td>
            </tr>
            <tr>
                <td><label for="address">Address</label></td>
                <td><input type="text" id="address" name="address" placeholder="Enter address" required></td>
            </tr>
            <tr>
                <td><label for="age">Age</label></td>
                <td><input type="text" id="age" name="age" placeholder="Enter age" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit" class="btn-primary" name="submit">Submit</button>
                    <a href="patients.php" class="btn-primary">Back to List</a>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html> 
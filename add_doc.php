<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $address = $_POST['address'];
    $department = $_POST['department'];

    if (empty($name) || empty($email) || empty($phone_no) || empty($address) || empty($department)) {
        die("All fields are required.");
    }

    $sql = "INSERT INTO doctors (name, email, phone_no, address, department) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone_no, $address, $department);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect to display.php after successful insertion
            header('Location: doctors.php');
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
    <title>Crud Operation</title>
    <link rel="stylesheet" href="addlists.css">
</head>
<body>

<div class="container">
    <h1>The Manchester Hospital, Add Doctor</h1>
    <form method="post">
        <table>
            <tr>
                <th colspan="2">Enter Details of Doctor</th>
            </tr>
            <tr>
                <td><label for="name">Name</label></td>
                <td><input type="text" id="name" name="name" placeholder="Enter doctor's name" required></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" id="email" name="email" placeholder="Enter email" required></td>
            </tr>
            <tr>
                <td><label for="phone_no">Phone_No</label></td>
                <td><input type="text" id="mobile" name="phone_no" placeholder="Enter phone number" required></td>
            </tr>
            <tr>
                <td><label for="address">Address</label></td>
                <td><input type="text" id="address" name="address" placeholder="Enter address" required></td>
            </tr>
            <tr>
                <td><label for="department">Department</label></td>
                <td><input type="text" id="department" name="department" placeholder="Enter Department" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit" class="btn-primary" name="submit">Submit</button>
                    <button type="submit" class="btn-primary" name="return"><a href="doctors.php">Return</a></button>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html> 
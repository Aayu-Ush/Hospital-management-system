<?php
include 'connect.php';

if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];

    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        die("Invalid ID provided.");
    }

    $query = "SELECT * FROM patients WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        die("Error preparing statement: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("Record not found.");
    }

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone_no = $_POST['phone_no'];
        $address = $_POST['address'];
        $age = $_POST['age'];

        $sql = "UPDATE patients SET name=?, email=?, phone_no=?, address=?, age=? WHERE id=?";

        $stmt = mysqli_prepare($conn, $sql);

        if (!$stmt) {
            die("Error preparing statement: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, 'sssssi', $name, $email, $phone_no, $address, $age, $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: patients.php");
            exit();
        } else {
            echo "Error updating data: " . mysqli_error($conn);
        }
    }
} else {
    die("No ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Record</title>
    <link rel="stylesheet" href="addlists.css">
</head>
<body>

<div class="container">
    <h1>The Manchester Hospital, Update Patients</h1>
    <form method="post">
        <table>
            <tr>
                <th colspan="2">Update Details</th>
            </tr>
            <tr>
                <td><label for="name">Name</label></td>
                <td><input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required></td>
            </tr>
            <tr>
                <td><label for="phone_no">Phone No</label></td>
                <td><input type="text" id="phone_no" name="phone_no" value="<?php echo htmlspecialchars($row['phone_no']); ?>" required></td>
            </tr>
            <tr>
                <td><label for="address">Address</label></td>
                <td><input type="text" id="address" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" required></td>
            </tr>
            <tr>
                <td><label for="age">Age</label></td>
                <td><input type="text" id="age" name="age" value="<?php echo htmlspecialchars($row['age']); ?>" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit" class="btn-primary" name="submit">Update</button>
                    <a href="patients.php" class="btn-primary">Back to List</a>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>

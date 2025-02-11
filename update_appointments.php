<?php
include 'connect.php';

if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];

    // Fetch the appointment details
    $query = "SELECT * FROM appointments WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("Appointment not found.");
    }
} else {
    die("No appointment ID provided.");
}

// Handle form submission
if (isset($_POST['submit'])) {
    $doctor_id = $_POST['doctor_id'];
    $patient_id = $_POST['patient_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = $_POST['status'];

    // Validate doctor ID
    $sql_doctor = "SELECT * FROM doctors WHERE id = ?";
    $stmt_doctor = mysqli_prepare($conn, $sql_doctor);
    mysqli_stmt_bind_param($stmt_doctor, "i", $doctor_id);
    mysqli_stmt_execute($stmt_doctor);
    mysqli_stmt_store_result($stmt_doctor);

    if (mysqli_stmt_num_rows($stmt_doctor) == 0) {
        die("Invalid Doctor ID.");
    }

    // Validate patient ID
    $sql_patient = "SELECT * FROM patients WHERE id = ?";
    $stmt_patient = mysqli_prepare($conn, $sql_patient);
    mysqli_stmt_bind_param($stmt_patient, "i", $patient_id);
    mysqli_stmt_execute($stmt_patient);
    mysqli_stmt_store_result($stmt_patient);

    if (mysqli_stmt_num_rows($stmt_patient) == 0) {
        die("Invalid Patient ID.");
    }

    // Update the appointment in the database
    $sql = "UPDATE appointments SET doctor_id=?, patient_id=?, date=?, time=?, status=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iisssi", $doctor_id, $patient_id, $date, $time, $status, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            header('Location: appointments.php');
            exit();
        } else {
            echo "Error executing query: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}

// Fetch distinct statuses from the appointments table
$sql_status = "SELECT DISTINCT status FROM appointments";
$result_status = mysqli_query($conn, $sql_status);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="addlists.css">
</head>
<body>

<div class="container">
    <h1>The Manchester Hospital, Edit Appointment</h1>
    <form method="post">
        <table>
            <tr>
                <th colspan="2">Enter Details of Appointment</th>
            </tr>
            <tr>
                <td><label for="doctor_id">Doctor ID</label></td>
                <td>
                    <input type="text" id="doctor_id" name="doctor_id" placeholder="Enter Doctor ID" value="<?php echo htmlspecialchars($row['doctor_id']); ?>" required>
                    <div id="doctor_id_error" class="error"></div>
                </td>
            </tr>
            <tr>
                <td><label for="patient_id">Patient ID</label></td>
                <td>
                    <input type="text" id="patient_id" name="patient_id" placeholder="Enter Patient ID" value="<?php echo htmlspecialchars($row['patient_id']); ?>" required>
                    <div id="patient_id_error" class="error"></div>
                </td>
            </tr>
            <tr>
                <td><label for="date">Date</label></td>
                <td><input type="date" id="date" name="date" value="<?php echo htmlspecialchars($row['date']); ?>" required></td>
            </tr>
            <tr>
                <td><label for="time">Time</label></td>
                <td><input type="time" id="time" name="time" value="<?php echo htmlspecialchars($row['time']); ?>" required></td>
            </tr>
            <tr>
                <td><label for="status">Status</label></td>
                <td>
                    <select id="status" name="status" required>
                        <?php
                        // Populate the select options with statuses
                        while ($status_row = mysqli_fetch_assoc($result_status)) {
                            $selected = ($status_row['status'] == $row['status']) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($status_row['status']) . '" ' . $selected . '>' . htmlspecialchars($status_row['status']) . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit" class="btn-primary" name="submit">Update</button>
                    <a href="appointments.php" class="btn-primary">Back to List</a>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
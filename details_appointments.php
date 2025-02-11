<?php
include 'connect.php';

if (isset($_GET['detailsid'])) {
    $id = $_GET['detailsid'];

    // Fetching patient_id and doctor_id from the appointment table of given id
    $sql = "SELECT patient_id, doctor_id FROM appointments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();
        $patient_id = $appointment['patient_id'];
        $doctor_id = $appointment['doctor_id'];
    } else {
        die("No appointment found.");
    }

    // Fetch the appointment details
    $query = "SELECT * FROM appointments WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result3 = $stmt->get_result();
    $appointment = $result3->fetch_assoc();

    // Fetch patient details
    $query = "SELECT * FROM patients WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result4 = $stmt->get_result();
    $patient = $result4->fetch_assoc();

    // Fetch doctor details
    $query = "SELECT * FROM doctors WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $result5 = $stmt->get_result();
    $doctor = $result5->fetch_assoc();

} else {
    die("No appointment ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="detail.css">
</head>
<body>

<div class="container">
    
    <h1>The Manchester Hospital, Appointment Details</h1>
    <form method="post">
        <table>
            <tr>
                <td><label for="appointment_id">Appointment ID</label></td>
                <td>
                    <input type="text" id="appointment_id" name="appointment_id" value="<?php echo htmlspecialchars($appointment['id']); ?>" readonly>
                </td>
            </tr>
            <tr>
                <td><label for="doctor_id">Doctor ID</label></td>
                <td>
                    <input type="text" id="doctor_id" name="doctor_id" value="<?php echo htmlspecialchars($doctor['id']); ?>" readonly>
                </td>
            </tr>
            <tr>
                <td><label for="doctor_name">Doctor Name</label></td>
                <td>
                    <input type="text" id="doctor_name" name="doctor_name" value="<?php echo htmlspecialchars($doctor['name']); ?>" readonly>
                </td>
            </tr>
            <tr>
                <td><label for="patient_id">Patient ID</label></td>
                <td>
                    <input type="text" id="patient_id" name="patient_id" value="<?php echo htmlspecialchars($patient['id']); ?>" readonly>
                </td>
            </tr>
            <tr>
                <td><label for="patient_name">Patient Name</label></td>
                <td>
                    <input type="text" id="patient_name" name="patient_name" value="<?php echo htmlspecialchars($patient['name']); ?>" readonly>
                </td>
            </tr>
            <tr>
                <td><label for="date">Date</label></td>
                <td><input type="date" id="date" name="date" value="<?php echo htmlspecialchars($appointment['date']); ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="time">Time</label></td>
                <td><input type="time" id="time" name="time" value="<?php echo htmlspecialchars($appointment['time']); ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="status">Status</label></td>
                <td><input type="text" id="status" name="status" value="<?php echo htmlspecialchars($appointment['status']); ?>" readonly></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <a href="appointments.php" class="btn-primary">Return To List</a>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
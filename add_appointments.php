<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $doctor_id = $_POST['doctor_id'];
    $doctor_name = $_POST['doctor_name'];
    $patient_id = $_POST['patient_id'];
    $patient_name = $_POST['patient_name'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    if (empty($doctor_id) || empty($doctor_name) || empty($patient_id) || empty($patient_name) || empty($date) || empty($time)) {
        die("All fields are required.");
    }

    // Check if doctor_id and doctor_name exist in the doctors table
    $sql_doctor = "SELECT * FROM doctors WHERE id = ? AND name = ?";
    $stmt_doctor = mysqli_prepare($conn, $sql_doctor);
    mysqli_stmt_bind_param($stmt_doctor, "is", $id, $name);
    mysqli_stmt_execute($stmt_doctor);
    mysqli_stmt_store_result($stmt_doctor);

    if (mysqli_stmt_num_rows($stmt_doctor) == 0) {
        die("Invalid Doctor ID or Doctor Name.");
    }

    // Check if patient_id and patient_name exist in the patients table
    $sql_patient = "SELECT * FROM patients WHERE id = ? AND name = ?";
    $stmt_patient = mysqli_prepare($conn, $sql_patient);
    mysqli_stmt_bind_param($stmt_patient, "is", $id, $name);
    mysqli_stmt_execute($stmt_patient);
    mysqli_stmt_store_result($stmt_patient);

    if (mysqli_stmt_num_rows($stmt_patient) == 0) {
        die("Invalid Patient ID or Patient Name.");
    }

    // Insert the appointment into the database
    $sql = "INSERT INTO appointments (doctor_id, patient_id, date, time) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iiss", $doctor_id, $patient_id, $date, $time);

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Appointment</title>
    <link rel="stylesheet" href="addlists.css">
</head>
<body>

<div class="container">
    <h1>The Manchester Hospital, Add Appointment</h1>
    <form method="post">
        <table>
            <tr>
                <th colspan="2">Enter Details of Appointment</th>
            </tr>
            <tr>
                <td><label for="doctor_id">Doctor ID</label></td>
                <td>
                    <input type="text" id="doctor_id" name="doctor_id" placeholder="Enter Doctor ID" required>
                    <div id="doctor_id_error" class="error"></div>
                </td>
            </tr>
            <tr>
                <td><label for="doctor_name">Doctor Name</label></td>
                <td>
                    <input type="text" id="doctor_name" name="doctor_name" placeholder="Enter Doctor Name" required>
                    <div id="doctor_name_error" class="error"></div>
                </td>
            </tr>
            <tr>
                <td><label for="patient_id">Patient ID</label></td>
                <td>
                    <input type="text" id="patient_id" name="patient_id" placeholder="Enter Patient ID" required>
                    <div id="patient_id_error" class="error"></div>
                </td>
            </tr>
            <tr>
                <td><label for="patient_name">Patient Name</label></td>
                <td>
                    <input type="text" id="patient_name" name="patient_name" placeholder="Enter Patient Name" required>
                    <div id="patient_name_error" class="error"></div>
                </td>
            </tr>
            <tr>
                <td><label for="date">Date</label></td>
                <td><input type="date" id="date" name="date" required></td>
            </tr>
            <tr>
                <td><label for="time">Time</label></td>
                <td><input type="time" id="time" name="time" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit" class="btn-primary" name="submit">Submit</button>
                    <a href="appointments.php" class="btn-primary">Back to List</a>
                </td>
            </tr>
        </table>
    </form>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        let isValid = true;

        // Validate Doctor ID and Name
        const doctorId = document.getElementById('doctor_id').value;
        const doctorName = document.getElementById('doctor_name').value;
        if (!validateDoctor(doctorId, doctorName)) {
            document.getElementById('doctor_id_error').innerText = 'Invalid Doctor ID or Name';
            document.getElementById('doctor_name_error').innerText = 'Invalid Doctor ID or Name';
            isValid = false;
        } else {
            document.getElementById('doctor_id_error').innerText = '';
            document.getElementById('doctor_name_error').innerText = '';
        }

        // Validate Patient ID and Name
        const patientId = document.getElementById('patient_id').value;
        const patientName = document.getElementById('patient_name').value;
        if (!validatePatient(patientId, patientName)) {
            document.getElementById('patient_id_error').innerText = 'Invalid Patient ID or Name';
            document.getElementById('patient_name_error').innerText = 'Invalid Patient ID or Name';
            isValid = false;
        } else {
            document.getElementById('patient_id_error').innerText = '';
            document.getElementById('patient_name_error').innerText = '';
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    function validateDoctor(doctorId, doctorName) {
        // This function should make an AJAX request to validate the doctor ID and name
        // For simplicity, we'll assume it returns true if the doctor exists
        // In a real application, you would make an AJAX request to the server to check the database
        return true; // Replace with actual validation logic
    }

    function validatePatient(patientId, patientName) {
        // This function should make an AJAX request to validate the patient ID and name
        // For simplicity, we'll assume it returns true if the patient existss
        // In a real application, you would make an AJAX request to the server to check the database
        return true; // Replace with actual validation logic
    }
</script>

</body>
</html>
<?php 
include ('connect.php'); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="tables.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>The Manchester Hospital</h1>
        <button class="btn btn-primary btn-custom my-3">
            <a href="add_appointments.php" class="btn-custom">Add Appointments</a>
        </button>
        <button class="btn btn-secondary btn-custom my-3 ms-2">
            <a href="loggedIn.php" class="btn-custom">Go to Homepage</a>
        </button>

        
        <div class="search-container">
            <form method="GET" class="d-flex w-100">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by Name or ID" required>
                <button type="submit" class="btn btn-primary">Search</button>
                <?php
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    echo '<a href="appointments.php" class="btn btn-secondary ms-2">Show All</a>';
                }
                ?>
            </form>
        </div>
        
        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Patient ID</th>
                    <th scope="col">Doctor ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Details</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $search_query = "";
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $search_query = "WHERE id LIKE '%$search%' OR patient_id LIKE '%$search%' OR doctor_id LIKE '%$search%'";
                }
                
                $sql = "SELECT * FROM appointments $search_query";
                $result = mysqli_query($conn, $sql);
                
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                            <th scope="row">' . $row['id'] . '</th>
                            <td>' . $row['patient_id'] . '</td>
                            <td>' . $row['doctor_id'] . '</td>
                            <td>' . $row['date'] . '</td>
                            <td>' . $row['time'] . '</td>
                            <td>' . $row['status'] . '</td>
                            
                            <td>
                                <button class="btn btn-primary details-btn" data-id="' . $row['id'] . '">Details</button>
                            </td>
                            <td>
                                <button class="btn btn-primary update-btn" data-id="' . $row['id'] . '">Update</button>
                                <button class="btn btn-danger delete-btn" data-id="' . $row['id'] . '">Delete</button>
                            </td>
                        </tr>';
                    }
                } else {
                    echo '<tr><td colspan="7" class="no-results">No search results found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            
            document.querySelectorAll('.details-btn').forEach(button => {
                button.addEventListener('click', function() {
                        window.location.href = `details_appointments.php?detailsid=${this.getAttribute('data-id')}`;
                    });
                });

            document.querySelectorAll('.update-btn').forEach(button => {
                button.addEventListener('click', function() {
                        window.location.href = `update_appointments.php?updateid=${this.getAttribute('data-id')}`;
                    });
                });
            
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    if (confirm('Are you sure you want to delete this doctor?')) {
                        window.location.href = `appointment_delete.php?deleteid=${this.getAttribute('data-id')}`;
                    }
                });
            });
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointments</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
$is_doctor = false;
$name = "Mahmut";
include "partials/_p_header.php";


?>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">My Appointments</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">City</th>
                    <th scope="col">Clinic</th>
                    <th scope="col">Hospital</th>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'db/DatabaseManager.php';
                session_start();
                $dbManager = new DatabaseManager();
                $appointments = $dbManager->getAppointments($_SESSION['rid']);


                foreach($appointments as $row){
                    $addressParts = explode(',', $row['address']);
                    $city = trim(end($addressParts));
                    $clinic = $row['dname'];
                    $hospital = $row['hname'];
                    $dName = $row['pname'];
                    $date = $row['date'];
                    $time = $row['time'];
                    
                    echo "<tr>";
                    echo "<td>$city</td>";
                    echo "<td>$clinic</td>";
                    echo "<td>$hospital</td>";
                    echo "<td>$dName</td>";
                    echo "<td>$date</td>";
                    echo "<td>$time</td>";
                    echo "</tr>"; 
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

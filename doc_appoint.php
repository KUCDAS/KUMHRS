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
include "partials/_p_header.php";
?>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Appointments To Me</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Clinic</th>
                    <th scope="col">Hospital</th>
                    <th scope="col">Patient Name</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Central Clinic</td>
                    <td>Mount Sinai Hospital</td>
                    <td>John Doe</td>
                    <td>2024-05-20</td>
                    <td>10:00 AM</td>
                </tr>
                <tr>
                    <td>Downtown Health</td>
                    <td>UCLA Medical Center</td>
                    <td>Jane Smith</td>
                    <td>2024-05-22</td>
                    <td>02:00 PM</td>
                </tr>
                <tr>
                    <td>Northside Clinic</td>
                    <td>Northwestern Hospital</td>
                    <td>Emily White</td>
                    <td>2024-05-25</td>
                    <td>11:30 AM</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</body>
</html>

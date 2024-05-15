<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Doctor Appointment Booking</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        padding: 0;
    }
    .container {
        width: 80%;
        margin: auto;
        padding: 20px;
    }
    input[type="text"], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    h2 {
        text-align: center;
    }
</style>
</head>
<?php
include "partials/_p_header.php";
include "db/DatabaseManager.php";
$dbManager = new DatabaseManager();
$clinics = $dbManager->getAllClinics();
?>
<body>
<div class="container">
    <h2>Book Your Appointment</h2>
    <form action="process/appointmentProcess.php" method="POST">
        <label for="city">City:</label>
        <select id="city" name="city" required>
            <option value="">Select a city</option>
            <option value="newyork">New York</option>
            <option value="losangeles">Los Angeles</option>
        </select>

        <?php include "partials/Appointment/_clinic.php"; ?>

        <label for="hospital">Hospital:</label>
        <select id="hospital" name="hospital" required>
            <option value="">Select a hospital</option>
            <option value="hospital1">Hospital 1</option>
            <option value="hospital2">Hospital 2</option>
        </select>

        <label for="doctor">Doctor:</label>
        <select id="doctor" name="doctor" required>
            <option value="">Select a doctor</option>
            <option value="doctor1">Doctor 1</option>
            <option value="doctor2">Doctor 2</option>
        </select>

        <label for="appt">Appointment Time:</label required>
        <input type="text" id="appt" name="appointment_time" placeholder="Choose time...">

        <input type="submit" value="Book Appointment">
    </form>
</div>
</body>
</html>


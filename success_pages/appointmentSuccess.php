<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
session_start();
$name = $_SESSION['name'];
$date = $_SESSION['date'];
$time = $_SESSION['time'];
$doctor = $_SESSION['doctor'];
$clinic = $_SESSION['clinic'];
$hospital = $_SESSION['hospital'];
?>
<body>
    <div class="container mt-5 col-md-4">
        <div class="alert alert-success" role="alert">
        <h1 class="text-center mb-4"><strong>Appointment Confirmed</strong></h1>

            <h4 class="card-title">Appointment Details</h4>
            <p class="card-text"><strong>Patient Name:</strong> <?=$name?></p>
            <p class="card-text"><strong>Clinic Name:</strong> <?=$clinic?></p>
            <p class="card-text"><strong>Hospital Name:</strong> <?=$hospital?></p>
            <p class="card-text"><strong>Doctor Name:</strong> Dr. <?=$doctor?></p>
            <p class="card-text"><strong>Date:</strong> <?=$date?></p>
            <p class="card-text"><strong>Time:</strong> <?=$time?></p>

            <h4 class="alert-heading">Successfully Created!</h4>
            <p>Your appointment has been successfully created.</p>
            <hr>
            <p class="mb-0">Thank you for using our service.</p>
        </div>
        <a href="../main.php" class="btn btn-secondary float-end">Go To The Main Menu</a>
    </div>
</body>
</html>

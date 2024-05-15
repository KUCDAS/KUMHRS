<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Appointment Form</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
include "../db/DatabaseManager.php";
$dbManager = new DatabaseManager();
session_start();
if(isset($_GET['doctor'])){
    $doctor = $_GET['doctor'];
    $_SESSION['doctor'] = $doctor;
}else if(isset($_SESSION['doctor'])){
    $doctor = $_SESSION['doctor'];
}
$times = $dbManager->getNonavaliableAppointmentTimes($_SESSION['clinic'], $_SESSION['hospital'], $doctor);

?>
<body>
<div class="container mt-5">
    <h2>Select a Doctor</h2>
    <form action="../process/appointmentProcess.php" method = "GET">
        <div class="form-group">

            <?php include "../partials/Appointment/_time.php"; ?>
        </div>
        <div class="btn-group">
            <a href = "doctor.php" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary">Forward</button>
        </div>
        <a href="../main.php" class="btn btn-success">Go Home</a>
    </form>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>

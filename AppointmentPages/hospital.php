<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Appointment Form</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
$button_url = "../main.php";
$button_name = "Go Home";
$button_visibility = "hidden";
include "../partials/_p_header.php";
?>
<?php
include "../db/DatabaseManager.php";
$dbManager = new DatabaseManager();
session_start();
if(isset($_GET['clinic'])){
    $clinic = $_GET['clinic'];
    $_SESSION['clinic'] = $clinic;
}else if(isset($_SESSION['clinic'])){
    $clinic = $_SESSION['clinic'];
}
$hospitals = $dbManager->getHospitals($clinic);
?>
<body>
<div class="container mt-5">
    <h2>Select a Hospital</h2>
    <form action="doctor.php" method = "GET">
        <div class="form-group">

            <?php include "../partials/Appointment/_hospital.php"; ?>
        </div>
        <div class="btn-group">
            <a href = "appointment.php" class="btn btn-secondary">Back</a>
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

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
if(isset($_GET['date'])){
    $date = $_GET['date'];
    $_SESSION['date'] = $date;
}else if(isset($_SESSION['date'])){
    $date = $_SESSION['date'];
}
$dateString = $date;
$date = DateTime::createFromFormat("l d-M-Y", $dateString);

// Check if the date was parsed correctly
if ($date === false) {
    echo "Failed to parse date.";
} else {
    // Format the DateTime object to 'Y-m-d'
    $formattedDate = $date->format("Y-m-d");
}
$times = $dbManager->getNonavailableAppoitmentTimes($_SESSION['clinic'], $_SESSION['hospital'], $_SESSION['doctor'], $formattedDate);

?>
<body>
<div class="container mt-5">
    <h2>Select a Date</h2>
    <form action="../process/appointmentProcess.php" method = "GET">
        <div class="form-group">

            <?php include "../partials/Appointment/_time.php"; ?>
        </div>
        <div class="btn-group">
            <a href = "date.php" class="btn btn-secondary">Back</a>
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

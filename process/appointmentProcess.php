<?php
session_start();
if(isset($_GET['time'])){
    $_SESSION['time'] = $_GET['time'];
    $pid = $_SESSION['rid'];
    $date = $_SESSION['date'];
    $time = $_SESSION['time'];
    $doctor = $_SESSION['doctor'];

    // echo $_SESSION['clinic'];
    // echo $_SESSION['hospital'];
    // echo $_SESSION['doctor'];
    // echo $_GET['time'];
    // echo $_SESSION['date'];
    // echo $_SESSION['rid'];
    $dateString = $date;

    // Create a DateTime object from the specific format
    $date = DateTime::createFromFormat("l d-M-Y", $dateString);

    // Check if the date was parsed correctly
    if ($date === false) {
        echo "Failed to parse date.";
    } else {
        // Format the DateTime object to 'Y-m-d'
        $formattedDate = $date->format("Y-m-d");
    }

    include "../db/DatabaseManager.php";
    $dbManager = new DatabaseManager();
    $pid = $dbManager->getPatientId($pid);
    $dbManager->makeAppointment($pid, $formattedDate, $time.":00", $doctor);

    header("Location: ../success_pages/appointmentSuccess.php");
}
?>


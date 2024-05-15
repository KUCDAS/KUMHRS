<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['city'])){
        echo $_POST['city'];
        echo $_POST['clinic'];
        echo $_POST['hospital'];
        echo $_POST['doctor'];
        echo $_POST['appointment_time'];

        header("Location: ../success_pages/appointmentSuccess.php");

    }
    else{
        echo "notset";
    }
}
else{
    echo "noreq";
}
?>


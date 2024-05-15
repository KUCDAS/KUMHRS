<?php
session_start();
if(isset($_GET['time'])){

    echo $_SESSION['clinic'];
    echo $_SESSION['hospital'];
    echo $_SESSION['doctor'];
    echo $_GET['time'];
    echo $_SESSION['rid'];
}
?>


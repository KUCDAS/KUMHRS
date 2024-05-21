<?php
echo $_POST['fullName']."<br>";
echo $_POST['email']."<br>";
echo $_POST['gender']."<br>";
echo $_POST['birthdate']."<br>";
echo $_POST['insNumber']."<br>";
echo $_POST['address']."<br>";
echo $_POST['phone']."<br>";
echo $_POST['password']."<br>";
// echo $_POST['isDoctor']."<br>";
echo $_POST['faculty']."<br>";
echo $_POST['department']."<br>";
echo $_POST['hospitalName']."<br>";
echo $_POST['city']."<br>";

$fullName = $_POST['fullName'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$birthdate = $_POST['birthdate'];
$insNumber = $_POST['insNumber'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$password = $_POST['password'];
// $isDoctor = $_POST['isDoctor']."<br>";
$faculty = $_POST['faculty'];
$department = $_POST['department'];
$hospitalName = $_POST['hospitalName'];
$city = $_POST['city'];

include "../db/DatabaseManager.php";
$dbManager = new DatabaseManager();

if(isset($_POST['isDoctor'])){
    $dbManager->insertDoctor($fullName, $email, $gender, "1990-01-01", $insNumber, $address, $phone, $password, $hospitalName, $city, $department);
} else{
    $dbManager->insertPerson($fullName, $email, $gender, $birthdate, $insNumber, $address, $phone, $password);
}
header("Location: ../success_pages/signupSuccess.php?email=$email");
?>
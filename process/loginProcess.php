<?php
require '../db/DatabaseManager.php';

$dbManager = new DatabaseManager();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        //check the password by username with using getPassWord command
        $passwordDb = $dbManager -> getPassWord($email);
        $usersInfo = $dbManager -> getUsersInfo($email);
        
        if($password == $passwordDb){
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['is_doctor'] = false;
            $_SESSION['name'] = $usersInfo['name'];
            $_SESSION['gender'] = $usersInfo['gender'];
            $_SESSION['rid'] = $usersInfo['rid'];

            if($dbManager->isDoctor($email))
                $_SESSION['is_doctor'] = true;

            header("Location: ../main.php");       
        }else{
            header("Location: ../error_pages/login_error.php");
        }
    }
    else{
        header("Location: invalid_request.php");
    }
}
else{
    header("Location: invalid_request.php");
}

?>
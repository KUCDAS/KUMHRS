<?php

require 'db/DatabaseManager.php';

$dbManager = new DatabaseManager();

echo "Person Test\n";
$name = "John Doe";
$email = "john@gmail.com";
$gender = "M";
$bdate = "1990-01-01";
$insnumber = "123456";
$pnumber = "123456789";
$password = "123456789";
$address = "New York, NY";

if($dbManager->insertPerson($name,$email,$gender,$bdate,$insnumber,$address,$pnumber,$password)!= NULL){
    echo "Person inserted..\n";
}


echo "Doctor Test\n";
$name = "Doctor Who";
$email = "who@gmail.com";
$gender = "M";
$bdate = "1990-01-01";
$insnumber = "1234567";
$pnumber = "123456789";
$password = "123456789";
$address = "New York, NY";
$hname = "Acıbadem";
$hadress = "Istanbul";
$dname = "Onkoloji";


if($dbManager->insertDoctor($name,$email,$gender,$bdate,$insnumber,$address,$pnumber,$password,$hname,$hadress,$dname)!= NULL){
    echo "Doctor inserted..\n";
}

echo "Done.\n";

$dbManager->close();

?>
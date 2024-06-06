<?php

require 'db/DatabaseManager.php';
session_start();
$dbManager = new DatabaseManager();

$hospitals = $dbManager->getMostVisitedHospital(4, 3);

foreach($hospitals as $hospital){
    echo $hospital["name"]."   ".$hospital['count']."<br>";

}

$dbManager->close();

?>
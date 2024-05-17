<?php

require 'db/DatabaseManager.php';

$dbManager = new DatabaseManager();

$patient_id = $dbManager->getPatientId(31);
echo $patient_id;


?>

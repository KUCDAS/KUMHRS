<?php

require 'db/DatabaseManager.php';

$dbManager = new DatabaseManager();

// Example SQL to fetch all users
$sql = "SELECT name, email FROM Person WHERE";
$stmt = $dbManager->runQuery($sql);

$result = $stmt->get_result();
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "User ID: " . $row['name'] . ", Name: " . $row['email'] . "<br>";
    }
}

$stmt->close();
$dbManager->close();

?>

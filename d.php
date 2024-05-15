<?php
$servername = "sql309.infinityfree.com";
$username = "if0_36418161";
$password = "se4loziN8Lks";
$dbname = "if0_36418161_kumhrs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, surname FROM test";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["name"]. " - Name: " . $row["surname"]."<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
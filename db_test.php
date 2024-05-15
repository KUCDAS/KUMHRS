<?php

require 'db/DatabaseManager.php';

$dbManager = new DatabaseManager();

$appointment = $dbManager->getAppointments(1);

foreach($appointment as $row){
    $city = $row['address'];
    $clinic = $row['dname'];
    $hospital = $row['hname'];
    $dName = $row['pname'];
    $date = $row['date'];
    $time = $row['time'];
    
    echo "<tr>";
    echo "<td>$city</td>";
    echo "<td>$clinic</td>";
    echo "<td>$hospital</td>";
    echo "<td>$dName</td>";
    echo "<td>$date</td>";
    echo "<td>$time</td>";
    echo "<td><form action='prescript_view.php' method='POST'><button type='submit' class='btn btn-warning'><input name='id' value='1' style='visibility:hidden; width:0;'>ViewDetail</button></form></td>"; //View details
    echo "</tr>"; 
}
?>

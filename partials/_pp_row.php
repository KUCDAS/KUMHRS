<?php
require 'db/DatabaseManager.php';
$dbManager = new DatabaseManager();
session_start();
$res = $dbManager->getPatientPresc($_SESSION['rid']);

foreach($res as $row){
    echo $row['medicine_name'];
}
$_SESSION['presc'] = $res;

?>


<!DOCTYPE html>
<html lang="en">
    <tbody id="prescriptonData">
    <?php
        $i = 0;
        foreach($res as $row){
            $mname = $row['medicine_name'];
            $dosage = $row['dosage'];
            $quantity = $row['quantity'];
            $tpd = $row['tpd'];
            $tpu = $row['tpu'];
            $note = $row['note'];
            $date = $row['adate'];
            $i++;
            echo "<tr>"; 
            echo "<td>$i</td>";
            echo "<td>Walter White</td>"; //Doctor Name
            echo "<td>$mname</td>"; //Medicine Name
            echo "<td>20.04.2024</td>"; //Given time
            echo "<td><form action='prescript_view.php' method='POST'><button type='submit' class='btn btn-warning'><input name='id' value='$i' style='visibility:hidden; width:0;'>ViewDetail</button></form></td>"; //View details
            echo "</tr>"; 
        }
    ?>
    </tbody>

</html>

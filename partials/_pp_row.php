<?php
require 'db/DatabaseManager.php';
$dbManager = new DatabaseManager();
$res = $dbManager->getPatientPresc($_SESSION['rid']);
foreach($res as $row){
    echo $row['medicine_name'];
}
session_start();
$_SESSION['presc'] = $res;

?>


<!DOCTYPE html>
<html lang="en">
    <tbody id="prescriptonData">
    <?php
        $idx = 0;
        for($i = 0; $i < count($res); $i++){
        $row = $res[$i];
        $aid = $row['aid'];
        $mname = $row['medicine_name'];
        $dosage = $row['dosage'];
        $quantity = $row['quantity'];
        $tpd = $row['tpd'];
        $tpu = $row['tpu'];
        $note = $row['note'];


        if($result[$i+1]['aid'] == $aid){
            $mname .= ", ".$res[$i+1]['medicine_name'];
            $i++;
        }

        $infoOfPatientAndDoctor = $dbManager->getPatientAndDoctorInfo($aid);
        $dname = $infoOfPatientAndDoctor[0]['dname'];
        
        ++$idx;
        echo "<tr>"; 
        echo "<td>$idx</td>";
        echo "<td>$dname</td>"; //Doctor Name
        echo "<td>$mname</td>"; //Medicine Name
        echo "<td>20.04.2024</td>"; //Given time
        echo "<td><form action='prescript_view.php' method='POST'><button type='submit' class='btn btn-warning'><input name='id' value='$i' style='visibility:hidden; width:0;'>ViewDetail</button></form></td>"; //View details
        echo "</tr>"; 
    }
    ?>
    </tbody>

</html>

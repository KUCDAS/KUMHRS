<!DOCTYPE html>
<html lang="en">
    <tbody id="prescriptonData">
    <?php 
    require './db/DatabaseManager.php';
    session_start();
    $dbManager = new DatabaseManager();
    $result = $dbManager->getIssuedPrescription($_SESSION['rid']); 
    
    $idx = 1;
    for ($i = 0; $i < count($result); $i++) {
        $row = $result[$i];
        $aid = $row['aid'];
        $patientName = $row['pname'];
        $medicineNames = $row['medicinaNames'];
        //combine the medicine names if the aid is the same
        if ($i+1 < count($result)){
            if($result[$i+1]['aid'] == $aid){
                $medicineNames .= ", ".$result[$i+1]['medicinaNames'];
                $i++;
            }
        }
        $date = $row['date'];
        $date = new DateTime($date);
        $date = $date -> format("l d/m/Y");
        
        echo "<tr>"; 
        echo "<td>$idx</td>";
        echo "<td>$patientName</td>"; //Patient Name
        echo "<td>$medicineNames</td>"; //Medicine Name 
        echo "<td>$date</td>"; //Given time
        echo "<td><form action='prescript_view.php' method='POST'><button type='submit' class='btn btn-warning'><input name='presc_id' value='$aid' style='visibility:hidden; width:0;'>ViewDetail</button></form></td>"; //View details
        echo "</tr>";
        $idx++;
    }
    ?>
    </tbody>
</html>
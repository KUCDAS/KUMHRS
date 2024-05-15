<!DOCTYPE html>
<html lang="en">
    <tbody id="prescriptonData">
    <?php 
    require './db/DatabaseManager.php';
    session_start();
    $dbManager = new DatabaseManager();
    $appointments = $dbManager->getIssuedPrescription($_SESSION['rid']);
    
    for($i = 1; $i < 250; $i++){
        echo "<tr>"; 
        echo "<td>$i</td>";
        echo "<td>Jesse Pinkman</td>"; //Patient Name
        echo "<td>Methamphetamine, Methamphetamine,Methamphetamine</td>"; //Medicine Name
        echo "<td>20.04.2024</td>"; //Given time
        echo "<td><form action='prescript_view.php' method='POST'><button type='submit' class='btn btn-warning'><input name='id' value='$i' style='visibility:hidden; width:0;'>ViewDetail</button></form></td>"; //View details
        echo "</tr>";
    }
    ?>
    </tbody>
</html>
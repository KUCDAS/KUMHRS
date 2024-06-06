<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    

</head>

<?php
require 'db/DatabaseManager.php';
session_start();
$rid = $_SESSION['rid'];
$name = $_SESSION['name'];
$is_doctor = $_SESSION['is_doctor'];
$dbManager = new DatabaseManager();
$limit = 4;
$hospitals = $dbManager->getTopThreeHospitals();
$departments = $dbManager->getTopDepartments($limit);
$medicines = $dbManager->getTopMedicines($limit);
$visited_hosptials = $dbManager->getMostVisitedHospital($rid, $limit);
$nobs3 = $dbManager->getNumberOfBeingSick($rid, 3);
$nobs6 = $dbManager->getNumberOfBeingSick($rid, 6);
$nobs = $dbManager->getNumberOfBeingSick($rid, 0); //all

$notp3 = $dbManager->getNumberOfTakenPills($rid, 3);
$notp6 = $dbManager->getNumberOfTakenPills($rid, 6);
$notp = $dbManager->getNumberOfTakenPills($rid, 0);


if($is_doctor){
    $topDrNum = 1;
    $patients = $dbManager->getTopPatients($rid, $limit);
    $doctors = $dbManager->getTopDoctors($rid, $topDrNum);
}


?>
<body>
    <div class="container mt-5 col-md-5">
        <h2 class="mb-4">User & General Statistics for <?=$name?></h2>
        <div class="card">
        <?php if($is_doctor){
                echo "<div class='card-body' width='100px;'>";
                echo "    <h5 class='card-title'>The $limit Patients Who Book Me the Most Appointments</h5>";
                echo"    <hr>";
                    $i = 1;
                    foreach($patients as $patient){
                        $patient_name = $i.") ".$patient['name'];
                        $count = $patient['count'];
                        $visit = ($count > 1)? "times visited" : "time visited";
                        echo "<p class='card-text'><strong>$patient_name:</strong> $count $visit </p>";
                        $i++;
                    }
                echo "</div>";

                echo "<div class='card-body' width='100px;'>";
                echo "    <h5 class='card-title'>Top Doctor</h5>";
                echo"    <hr>";
                    $i = 1;
                    foreach($doctors as $doctor){
                        $doctor_name = $i.") ".$doctor['name'];
                        $count = $doctor['appointment_count'];
                        $visit = ($count > 1)? "Appointments total" : "Appointment total";
                        echo "<p class='card-text'><strong>$doctor_name:</strong> $count $visit </p>";
                        $i++;
                    }
                echo "</div>";
            }
            ?>
            <div class="card-body" width="100px;">
                <h5 class="card-title">Number of Being Sick</h5>
                <hr>
                <p class='card-text'><strong>Last three months:</strong> <?=$nobs3?></p>
                <p class='card-text'><strong>Last six months:</strong> <?=$nobs6?></p>
                <p class='card-text'><strong>All:</strong> <?=$nobs?></p>
            </div>
            <div class="card-body" width="100px;">
                <h5 class="card-title">Number of Taken Pills</h5>
                <hr>
                <p class='card-text'><strong>Last three months:</strong> <?=$notp3?></p>
                <p class='card-text'><strong>Last six months:</strong> <?=$notp?></p>
                <p class='card-text'><strong>All:</strong> <?=$notp?></p>
            </div>
            <div class="card-body" width="100px;">
                <h5 class="card-title">The <?=$limit?> Hospitals I Visit Most</h5>
                <hr>
                <?php
                $i = 1;
                foreach($visited_hosptials as $vhospital){
                    $vhname = $i.") ".$vhospital['name'];
                    $count = $vhospital['count'];
                    $visit = ($count > 1)? "times visited" : "time visited";
                    echo "<p class='card-text'><strong>$vhname:</strong> $count $visit</p>";
                    $i++;
                }
                ?>
            </div>
            <div class="card-body" width="100px;">
                <h5 class="card-title">Top 3 Hospitals</h5>
                <hr>
                <?php
                $i = 1;
                foreach($hospitals as $hospital){
                    $hname = $i.") ".$hospital['hname'];
                    $count = $hospital['appointment_count'];
                    echo "<p class='card-text'><strong>$hname:</strong> $count</p>";
                    $i++;
                }
                ?>
            </div>
            <div class="card-body" width="100px;">
                <h5 class="card-title">Top <?php echo $limit?> Visited Departments</h5>
                <hr>
                <?php
                $i = 1;
                foreach($departments as $department){
                    $dname = $i.") ".$department['dname'];
                    $count = $department['appointment_count'];
                    echo "<p class='card-text'><strong>$dname:</strong> $count visitors total</p>";
                    $i++;
                }
                ?>
            </div>
            

            <div class="card-body" width="100px;">
                <h5 class="card-title">Top <?php echo $limit?> Taken Medicines</h5>
                <hr>
                <?php
                $i = 1;
                foreach($medicines as $medicine){
                    $mname = $i.") ".$medicine['medicine_name'];
                    $count = $medicine['prescription_count'];
                    echo "<p class='card-text'><strong>$mname:</strong> $count pills taken total</p>";
                    $i++;
                }
                ?>
            </div>

        </div>
    </div>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

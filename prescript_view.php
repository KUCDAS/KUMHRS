<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription Visualization</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php
        session_start();
        require 'db/DatabaseManager.php';
        $dbManager = new DatabaseManager();
        $result = $dbManager->getPatientAndDoctorInfo($_POST['presc_id']);
        $dname = $result[0]['dname'];
        $pname = $_SESSION['name'];
        $id = $dbManager->getPrescriptionID($_POST['presc_id'])[0]['id'];
                ?>

</head>
<body>
    <div class="container mt-5 col-md-4">
        <h2 class="mb-4">Prescription Details</h2>
        <div class="card">
            <div class="card-body" width="25px;">
                <h5 class="card-title">Prescription ID: #<?=$id?></h5>
                <p class="card-text"><strong>Doctor Name:</strong> <?=$dname?></p>
                <p class="card-text"><strong>Patient Name:</strong> <?=$pname?></p>
                <hr>
                <?php
                    $result = $dbManager->getPrescriptionInfo($_POST['presc_id']);
                    $date = $result[0]['adate'];
                    foreach($result as $row){
                        $mname = $row['medicine_name'];
                        $dosage = $row['dosage'];
                        $quantity = $row['quantity'];
                        $tpd = $row['tpd'];
                        $tpu = $row['tpu'];
                        $note = $row['note'];
                        echo "<p class='card-text'><strong>Medicine:</strong> $mname</p>";
                        echo "<p class='card-text'><strong>Dosage:</strong> $dosage</p>";
                        echo "<p class='card-text'><strong>Quantity:</strong> $quantity pills</p>";
                        echo "<p class='card-text'><strong>Times Per Day:</strong> $tpd</p>";
                        echo "<p class='card-text'><strong>Times Per Usage:</strong> $tpu</p>";
                        if($note != null){
                            echo "<p class='card-text'><strong>Notes:</strong> $note</p>";
                        }
                        echo "<hr>";
                    }
                    echo "<p class='card-text'><strong>Given Time:</strong> $date</p>";
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


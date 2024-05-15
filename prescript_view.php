<?php
// target.php

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the name and email fields are set
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        header("Location: invalid_request.php");
        exit;
    }
    $dname = 'Walter White';
    $pname = "Jessey Pinkman";
} else {
    // Not a POST request, handle differently or redirect
    header("Location: invalid_request.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription Visualization</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    session_start();
                    $res = $_SESSION['presc'];
                    foreach($res as $row){
                        $mname = $row['medicine_name'];
                        $dosage = $row['dosage'];
                        $quantity = $row['quantity'];
                        $tpd = $row['tpd'];
                        $tpu = $row['tpu'];
                        $note = $row['note'];
                        $date = $row['adate'];
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

                ?>
                <p class="card-text"><strong>Given Time:</strong> <?=$date?></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

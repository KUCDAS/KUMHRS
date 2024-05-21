<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if medicine_name, dosage, and quantity are in the POST data
    if (isset($_POST['medicine_name']) && isset($_POST['dosage']) && isset($_POST['quantity'])) {
        $medicines = $_POST['medicine_name'];
        $dosages = $_POST['dosage'];
        $quantities = $_POST['quantity'];
        $tpds = $_POST['times_per_day'];
        $tpus = $_POST['pills_per_usage'];
        $notes = $_POST['notes'];
        $aid = $_POST['aid'];

        include "../db/DatabaseManager.php";
        $dbManager = new DatabaseManager();
        $dbManager -> insertPrescription($aid);

        // Iterate over one of the arrays and use the index to access elements from the others
        foreach ($medicines as $index => $medicine) {
            $dosage = $dosages[$index].' mg';
            $quantity = $quantities[$index];
            $tpd = $tpds[$index];
            $tpu = $tpus[$index];
            $note = $notes[$index];
            $dbManager -> insertMedicine($medicine, $dosage, $quantity, $tpd, $tpu, $note, $aid);
        }
        header("Location: ../success_pages/prescriptionSuccess.php");
    } else {
        echo "One or more required fields are missing.";
    }
}
?>

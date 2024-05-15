<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if(!isset($_SESSION['name'])){
    header("Location: invalid_request.php");
}
$is_doctor = $_SESSION['is_doctor'];
$name = $_SESSION['name'];
session_abort();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Prescription Viewer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<?php include "partials/_p_header.php"?>
<body>
    <div class="container mt-5">

        <h2 class="mb-4">Issued Prescriptions Overview</h2>
        <table class="table table-striped">
            <?php include "partials/_dp_head.php";?>
            <?php include "partials/_dp_row.php"; ?>
        </table>
    </div>
</body>
</html>

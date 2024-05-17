<?php
// header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invalid Request</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header">
                        <h3>Error</h3>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Invalid Request</h4>
                        <p class="card-text">The request could not be processed due to invalid input or malformed request. Please check your data and try again.</p>
                        <a href="index.php" class="btn btn-primary">Go Home</a>
                    </div>
                    <div class="card-footer text-muted">
                        If the problem persists, please contact support.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

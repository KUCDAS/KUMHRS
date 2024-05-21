<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#isDoctor').change(function() {
            if (this.checked) {
                $('#doctorFields').show();
            } else {
                $('#doctorFields').hide();
            }
        });

        $('#newDepartment').click(function() {
            var newDep = prompt("Please enter the new department name:");
            if (newDep) {
                $('#department').append($('<option>', {
                    value: newDep,
                    text: newDep,
                    selected: true
                }));
            }
        });

        $('#newHospital').click(function() {
            var newHosp = prompt("Please enter the new hospital name:");
            if (newHosp) {
                $('#hospitalName').append($('<option>', {
                    value: newHosp,
                    text: newHosp,
                    selected: true
                }));
            }
        });

        $('form').submit(function(event) {
            var password = $('#password').val();
            var confirmPassword = $('#confirmPassword').val();
            if (password !== confirmPassword) {
                event.preventDefault(); // Prevent form submission
                alert('Passwords do not match!');
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
        var dateInput = document.getElementById('birthdate');
        
        dateInput.addEventListener('change', function() {
            var date = new Date(this.value);
            var formattedDate = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
            console.log('Formatted Date:', formattedDate);  // or display it somewhere in your UI
        });
        });
    });
</script>
<?php
include "db/DatabaseManager.php";
$dbManager = new DatabaseManager();
$clinics = $dbManager->getAllClinics();
$hospitals = $dbManager->getAllHospitals();
?>
</head>
<body>
<div class="container mt-5">
    <h2>Sign Up</h2>
    <form action="process/signupProcess.php" method="post"> <!-- Placeholder action for actual registration processing -->
        <div class="form-group">
            <label for="fullName">Full Name:</label>
            <input type="text" class="form-control" id="fullName" name="fullName" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="birthdate">Birthdate:</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" required>
        </div>
        <div class="form-group">
            <label for="insNumber">Insurance Number:</label>
            <input type="text" class="form-control" id="insNumber" name="insNumber" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="isDoctor" name="isDoctor">
            <label class="form-check-label" for="isDoctor">Are you a doctor?</label>
        </div>
        <div id="doctorFields" style="display:none;">
            <div class="form-group">
                <label for="faculty">Faculty:</label>
                <input type="text" class="form-control" id="faculty" name="faculty">
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <select class="form-control" id="department" name="department">
                    <!-- Example department options, these should be fetched from a database -->
                    <?php
                    foreach($clinics as $clinic){
                        $clinicName = $clinic['dname'];
                        echo "<option value='$clinicName'>$clinicName</option>";
                    }
                    ?>
                </select>
                <button type="button" id="newDepartment" class="btn btn-link">Add new department</button>
            </div>
            <div class="form-group">
                <label for="hospitalName">Hospital Name:</label>
                <select class="form-control" id="hospitalName" name="hospitalName">
                    <!-- Example hospital options, these should be fetched from a database -->
                    <?php
                    foreach($hospitals as $hosptial){
                        $hospitalName = $hosptial['hospital_name'];
                        echo "<option value='$hospitalName'>$hospitalName</option>";
                    }
                    ?>
                </select>
                <button type="button" id="newHospital" class="btn btn-link">Add new hospital</button>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Sign Up</button>
    </form>
</div>
</body>
</html>

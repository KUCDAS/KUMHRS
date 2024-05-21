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
        });
    </script>
</head>
<body>
<div class="container mt-5">
    <h2>Sign Up</h2>
    <form action="register.php" method="post"> <!-- Placeholder action for actual registration processing -->
        <!-- Patient fields -->
        <!-- ... include other patient fields as earlier ... -->

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
                    <option value="Cardiology">Cardiology</option>
                    <option value="Neurology">Neurology</option>
                </select>
                <button type="button" id="newDepartment" class="btn btn-link">Add new department</button>
            </div>
            <div class="form-group">
                <label for="hospitalName">Hospital Name:</label>
                <select class="form-control" id="hospitalName" name="hospitalName">
                    <!-- Example hospital options, these should be fetched from a database -->
                    <option value="General Hospital">General Hospital</option>
                    <option value="City Hospital">City Hospital</option>
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

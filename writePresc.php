<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addMedicine').click(function() {
                var html = '<tr>';
                html += '<td><input type="text" class="form-control" name="medicine_name[]" required></td>';
                html += '<td><input type="text" class="form-control" name="dosage[]" placeholder="mg" required></td>';
                html += '<td><input type="number" class="form-control" name="quantity[]" placeholder="Number of pills/capsules" required></td>';
                html += '<td><input type="number" class="form-control" name="times_per_day[]" placeholder="Times per day" required></td>';
                html += '<td><input type="number" class="form-control" name="pills_per_usage[]" placeholder="Pills/capsules per usage" required></td>';
                html += '<td><input type="text" class="form-control" name="notes[]" required></td>';
                html += '<td><button type="button" class="btn btn-danger remove">Remove</button></td>';
                html += '</tr>';
                $('#medicationTable').append(html);
            });

            $(document).on('click', '.remove', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
</head>
<body>
<div class="container mt-5">
    <h2>Prescription Form</h2>
    <form action="process/submitPrescriptionProcess.php" method="post">
        <div class="form-group">
            <label for="doctorName">Doctor's Name:</label>
            <input type="text" class="form-control" id="doctorName" name="doctor_name" required>
        </div>
        <div class="form-group">
            <label for="patientName">Patient's Name:</label>
            <input type="text" class="form-control" id="patientName" name="patient_name" required>
        </div>
        <input type="hidden" name = "aid" value = "<?=$_GET['aid']?>">
        <table class="table" id="medicationTable">
            <thead>
                <tr>
                    <th>Medicine Name</th>
                    <th>Dosage (mg)</th>
                    <th>Quantity (pills/capsules)</th>
                    <th>Times per Day</th>
                    <th>Pills/Capsules per Usage</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="form-control" name="medicine_name[]" required></td>
                    <td><input type="text" class="form-control" name="dosage[]" placeholder="mg" required></td>
                    <td><input type="number" class="form-control" name="quantity[]" placeholder="Number of pills/capsules" required></td>
                    <td><input type="number" class="form-control" name="times_per_day[]" placeholder="Times per day" required></td>
                    <td><input type="number" class="form-control" name="pills_per_usage[]" placeholder="Pills/capsules per usage" required></td>
                    <td><input type="text" class="form-control" name="notes[]" required></td>
                    <td><button type="button" class="btn btn-danger remove">Remove</button></td>
                </tr>
            </tbody>
        </table>
        <button type="button" id="addMedicine" class="btn btn-primary">Add Medicine</button>
        <button type="submit" class="btn btn-success">Submit Prescription</button>
    </form>
</div>
</body>
</html>

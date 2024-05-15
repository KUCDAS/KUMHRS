<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Appointment Booking</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Hospital Appointment Booking</h2>
        <form id="appointmentForm">
            <div id="step1" class="form-group">
                <label for="city">Select City:</label>
                <select class="form-control" id="city" required>
                    <option value="">Select a city</option>
                    <option value="City1">City1</option>
                    <option value="City2">City2</option>
                </select>
                <button type="button" class="btn btn-primary mt-2" onclick="goToStep(2)">Next</button>
            </div>
            <div id="step2" class="form-group" style="display:none;">
                <button type="button" class="btn btn-secondary" onclick="goToStep(1)">Back</button>
                <label for="clinic">Select Clinic:</label>
                <select class="form-control" id="clinic" required>
                    <option value="">Select a clinic</option>
                    <option value="Clinic1">Clinic1</option>
                    <option value="Clinic2">Clinic2</option>
                </select>
                <button type="button" class="btn btn-primary mt-2" onclick="goToStep(3)">Next</button>
            </div>
            <!-- Add more steps similarly for Hospital, Doctor, and Time -->
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>

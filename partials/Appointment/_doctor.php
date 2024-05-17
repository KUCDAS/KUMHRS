<label for="clinicSelection">Choose a doctor:</label>
    <select class="form-control" id="clinicSelection" name = "doctor">
    <?php
    foreach($doctors as $doctor){
        $doctor_name = $doctor['name'];
        echo "<option value='$doctor_name'>$doctor_name</option>";
    }
?>
</select>
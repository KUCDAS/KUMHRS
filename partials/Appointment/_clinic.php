<label for="clinic">Clinic:</label>
<select id="clinic" name="clinic" required>
<option value="">Select a clinic</option>
<?php
    foreach($clinics as $clinic){
        $clinic_name = $clinic['dname'];
        echo "<option value='$clinic_name'>$clinic_name</option>";
    }
?>
</select>
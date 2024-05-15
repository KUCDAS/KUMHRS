
<label for="clinicSelection">Choose a clinic:</label>
    <select class="form-control" id="clinicSelection" name = "clinic">
    <?php
    foreach($clinics as $clinic){
        $clinic_name = $clinic['dname'];
        echo "<option value='$clinic_name'>$clinic_name</option>";
    }
?>
</select>
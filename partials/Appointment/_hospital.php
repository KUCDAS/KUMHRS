<label for="clinicSelection">Choose a hospital:</label>
    <select class="form-control" id="clinicSelection" name = "hospital">
    <?php
    foreach($hospitals as $hospital){
        $hospital_name = $hospital['hname'];
        echo "<option value='$hospital_name'>$hospital_name</option>";
    }
?>
</select>
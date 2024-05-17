
<label for="clinicSelection">Choose a date:</label>
    <select class="form-control" id="clinicSelection" name = "date">
    <?php
        // Set the timezone to avoid PHP using the default one if it's not set in php.ini
        date_default_timezone_set('UTC');
        
        // Create a DateTime object for today
        $today = new DateTime();
        
        // Loop to print the days from today to 15 days later
        for ($i = 0; $i <= 15; $i++) {
            if ($i > 0) {  // Skip the first iteration to print today's date
                $today->modify('+1 day');  // Add one day
            }
            $date = $today->format('l d-M-Y');
            echo "<option value='$date'>$date</option>";
        }
    ?>
</select>
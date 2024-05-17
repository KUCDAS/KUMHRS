
<label for="clinicSelection">Choose a doctor:</label>
    <select class="form-control" id="clinicSelection" name = "time">
    <?php
        $time_array = [];
        foreach($times as $time){
            array_push($time_array, $time['time']);
        }
        $initialHour = 8; //8:00 is the işbaşı
        $lastHour = 17; //17:00 is the last hour
        $minutes = $initialHour*60;

        while($minutes < 60*$lastHour){
            $hour = intdiv($minutes, 60);
            $minute = $minutes % 60;
            $shour = ($hour < 10) ? "0".$hour : $hour;
            $sminute = ($minute < 10) ? "0".$minute : $minute;

            $time_to_disp = $shour.":".$sminute;
            if(in_array($time_to_disp.":00", $time_array)){
                echo "<option value='$time_to_disp' disabled>$time_to_disp</option>";
            }else{
                echo "<option value='$time_to_disp'>$time_to_disp</option>";
            }
            $minutes += 30;
        }

        // foreach($times as $time){
        //     $hour = intdiv($minutes, 60);
        //     $minute = $minutes % 60;

        //     $shour = ($hour < 10)

        //     $time = $time['time'];
        //     if($time == $minutes)
        //     echo "<option value='$time'>$time</option>";
        // }
    ?>
</select>
<!-- Create title -->
<h1 class="title">Location
    <?php
        // Connect db 
        require_once "../config_db.php";

        $sql_locations =   "
        SELECT name
            FROM locations
            WHERE location_id = '{$_GET['locId']}'";
            
        $result_loc = $con->query($sql_locations);

        if($row_loc = $result_loc->fetch_assoc())
        {
            echo "{$row_loc['name']}\n";
        }

        // Close connection
        /*mysqli_close($con);*/
    ?>
</h1>

<!-- draw devices on this location -->
<div class="container">
    <?php
        // get values from header and session
        $user_id = $_SESSION["user_id"];
        $location_id = $_GET["locId"];
        
        // Connect db 
        /*require_once "../config_db.php";*/

        // get device id and device note
        $sql_get_devices = "
        SELECT device_id, dl.note, android_id
        FROM devices_locations AS dl
        JOIN devices
        USING (device_id)
        WHERE location_id = '{$location_id}'";

        $result_devs = $con->query($sql_get_devices);
        // for each device on this location
        while($row_devs = mysqli_fetch_row($result_devs)) {
            // device id and device name
            $device_id = $row_devs[0];
            $device_note = $row_devs[1];
            $android_id = $row_devs[2];

            // get last uploaded image by this device
            $sql_get_last_photo = "
            SELECT image_path, time_stamp
            FROM files
            WHERE
                device_id = '{$device_id}' 
                AND location_id = '{$location_id}'
            ORDER BY file_id DESC
            LIMIT 1";

            $result_photo = $con->query($sql_get_last_photo);

            // draw the last image
            echo "<div class='overlay-image'>";

            $time_stamp = 0;
            if($row_photo = $result_photo->fetch_assoc()) {
                $image_path = $row_photo['image_path'];
                echo "<img src='{$image_path}' class='image' id='dev_image'>";
                $time_stamp = $row_photo['time_stamp'];
            }
            $date = date('H:i d-m-Y', $time_stamp);

            // draw device note
            echo "<div class='text'>{$device_note}";

            // get last device status: location, charge, etc.
            $sql_get_status = "
            SELECT *
            FROM devices_statuses
            WHERE device_id = '{$device_id}' AND location_id = '{$location_id}'
            ORDER BY status_id DESC
            LIMIT 1";

            $result_status = $con->query($sql_get_status);

            // draw device status
            if($row_status = $result_status->fetch_assoc()) {
                $pos_str = sprintf('%0.3f/%0.3f', $row_status['latitude'], $row_status['longitude']);
                echo "
                <div>
                    <font  size='3''>
                        Android ID: {$android_id} <br>
                        Date: {$date} <br>
                        Position: {$pos_str}; 
                        Charge: {$row_status['charge_level']}% is {$row_status['charge_status']}
                    </font>
                </div>";
            }
            echo "</div>";

            // create icons for settings and gallery
            echo "<a href='settings.php?devId={$device_id}&locId={$location_id}'>
                    <img src='./photo-gallery/settings.png' class='sett_icon'>
                  </a>
                  <a href='#'>
                    <img src='./photo-gallery/gallery.png' class='gall_icon'>
                  </a>";

            echo "</div>";
        }

        // Close connection
        mysqli_close($con);
    ?>
</div>
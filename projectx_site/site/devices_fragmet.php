<h1 class="title">Location
    <?php
        $location_name = $_GET["locName"];
        echo "{$location_name}\n";
    ?>
</h1>

<div class="container" id="scores">
    <?php
        $user_id = $_SESSION["user_id"];
        $location_id = $_GET["locId"];
        
        // Include config file
        require_once "config.php";

        $sql_get_devices = "
        SELECT device_id, note
        FROM devices_locations
        WHERE location_id = '{$location_id}'";

        $result_devs = $con->query($sql_get_devices);

        while($row_devs = $result_devs->fetch_assoc()) {
            $device_id = $row_devs['device_id'];
            $device_note = $row_devs['note'];

            $sql_get_last_photo = "
            SELECT image_path
            FROM files
            WHERE 
                device_id = '{$device_id}' 
                AND location_id = '{$location_id}'
            ORDER BY file_id DESC
            LIMIT 1";

            $result_photo = $con->query($sql_get_last_photo);

            echo "<div class='overlay-image'>";
            if($row_photo = $result_photo->fetch_assoc()) {
                $image_path = $row_photo['image_path'];
                echo "<img src='{$image_path}' class='image' id='dev_image'>";
            }

            echo "<div class='text'>{$device_note}";

            $sql_get_status = "
            SELECT *
            FROM devices_statuses
            WHERE device_id = '{$device_id}' AND location_id = '{$location_id}'
            ORDER BY status_id DESC
            LIMIT 1";

            $result_status = $con->query($sql_get_status);

            if($row_status = $result_status->fetch_assoc()) {
                $pos_str = sprintf('%0.3f/%0.3f', $row_status['latitude'], $row_status['longitude']);
                echo "<div><font  size='3''>Position: {$pos_str};
                Charge: {$row_status['charge_level']}% is {$row_status['charge_status']}</font></div>";
            }

            
            echo "</div></div>";
        }

        // Close connection
        mysqli_close($con);
    ?>
</div>
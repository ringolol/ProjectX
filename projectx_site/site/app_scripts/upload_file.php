<?php
    if (is_uploaded_file($_FILES['sent_image']['tmp_name'])) {
        $android_id = $_POST['android_id'];
        $main_dir = "images/{$android_id}/";
        $uploads_dir = "../" . $main_dir;
        $tmp_name = $_FILES['sent_image']['tmp_name'];
        $pic_name = $_FILES['sent_image']['name'];
    
        $time_stamp = $_POST['time_stamp'];
        $GUID = uniqid();
        $image_name = "img{$time_stamp}{$GUID}.png";
        $image_path = $uploads_dir . $image_name;
        $main_image_path = $main_dir . $image_name;

        if ( ! is_dir($uploads_dir)) {
            mkdir($uploads_dir);
        }

        move_uploaded_file($tmp_name, $image_path);

        /* Include config file */
        require_once "../config.php";

        $sql_get_deviceID_locationID =
        "SELECT device_id, location_id
        FROM devices
        JOIN devices_locations USING (device_id)
        WHERE android_id = '{$android_id}';";

        if ($result_get = mysqli_query($con, $sql_get_deviceID_locationID))
        {
            $row = $result_get->fetch_assoc();
            $device_id = $row['device_id'];
            $location_id = $row['location_id'];
        } else {
            echo "Device is not linked to any location\n";
            exit();
        }

        $sql_insert_image = "INSERT INTO files (device_id, location_id, time_stamp, image_path)
                             VALUES
                                ('{$device_id}',
                                '{$location_id}',
                                '{$time_stamp}',
                                '{$main_image_path}');";

        if(mysqli_query($con, $sql_insert_image))
        {
            echo "The File is successfully uploaded\n";
        } else {
            echo "SQL insert query error\n";
        }
        
    } else {
        echo "Failed to upload the file. No file\n";
    }

?>
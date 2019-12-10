<?php

    /* if we recived a file */
    if (is_uploaded_file($_FILES['sent_image']['tmp_name'])) {
        /* get android_id from sent field */
        $android_id = $_POST['android_id'];

        /* Include config file */
        require_once "../config.php";

        /* check android_id and get device_id and location_id */
        /* it is used twice, might be put into separate file */
        $sql_get_deviceID_locationID =
        "SELECT device_id, location_id
        FROM devices
        JOIN devices_locations USING (device_id)
        WHERE android_id = '{$android_id}';";

        if(!($result_get = mysqli_query($con, $sql_get_deviceID_locationID)))
        {
            echo "SQL check android_id query error\n";
            exit();
        }

        if ($row = $result_get->fetch_assoc())
        {
            $device_id = $row['device_id'];
            $location_id = $row['location_id'];
        } else {
            echo "Device is not linked to any location\n";
            exit();
        }


        /* Prepare dirs */
        $main_dir = "images/{$android_id}/";
        $uploads_dir = "../" . $main_dir;
        /* Get temp file name */
        $tmp_name = $_FILES['sent_image']['tmp_name'];
        /* Get sent file name */
        $pic_name = $_FILES['sent_image']['name'];
    
        /* Get time_stamp from sent field */
        $time_stamp = $_POST['time_stamp'];
        /* Create GUID to hide image file */
        $GUID = uniqid();
        /* Add time_stamp to make file unic and GIUD to hide it */
        $image_name = "img{$time_stamp}{$GUID}.png";

        /* image_path -- path to save file */
        $image_path = $uploads_dir . $image_name;
        /* main_path -- path to save into DB */
        $main_image_path = $main_dir . $image_name;

        /* If no dir for this device, make it */
        if ( ! is_dir($uploads_dir)) {
            mkdir($uploads_dir);
        }

        /* Move temp file into device's dir */
        move_uploaded_file($tmp_name, $image_path);
        /*imagescale($tmp_name,450)*/

        /* Insert image path into DB -- table files */
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

    // Close connection
    mysqli_close($con);

?>
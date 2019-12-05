<?php

    if (is_uploaded_file($_FILES['sent_image']['tmp_name'])) {
        $android_id = $_GET['android_id'];
        $uploads_dir = "images/{$android_id}/";
        $tmp_name = $_FILES['sent_image']['tmp_name'];
        $pic_name = $_FILES['sent_image']['name'];
    
        $time_stamp = $_SERVER['REQUEST_TIME'];
        $image_path = $uploads_dir."img{$time_stamp}.png";

        if ( ! is_dir($uploads_dir)) {
            mkdir($uploads_dir);
        }

        move_uploaded_file($tmp_name, $image_path);

        // database "constants"
        $servername = "localhost";
        $username = "root";
        $password = "12344321aAcCc";
        $dbname = "projectx_db";
        
        // Create connection
        $con = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $sql_insert_image = "INSERT INTO files (device_id, location_id, image_path)
                             VALUES
                                ((SELECT device_id
                                FROM devices
                                WHERE android_id = '{$android_id}'),
                                (SELECT location_id
                                FROM devices_locations
                                JOIN devices
                                USING (device_id)
                                WHERE android_id = '{$android_id}'),
                                '{$image_path}');";

        $result_inserion = mysqli_query($con, $sql_insert_image);
        
    } else {
        echo "File not uploaded successfully.";
    }

?>
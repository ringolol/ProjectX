<?php

    // Takes raw data from the request
    $json = $_POST['json'];

    $vars = json_decode($json);
    $android_id = $vars->{'android_id'};
    $latitude = $vars->{'latitude'};
    $longitude = $vars->{'longitude'};
    $charge_level = $vars->{'charge_level'};
    $charge_status = $vars->{'charge_status'};
    $time_stamp = $vars->{'time_stamp'};

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
    

    $sql_add_status = 
    "INSERT INTO devices_statuses
        (device_id,
        location_id,
        time_stamp,
        latitude,
        longitude,
        charge_level,
        charge_status)
    VALUES
        ('{$device_id}',
        '{$location_id}',
        '{$time_stamp}',
        '{$latitude}',
        '{$longitude}',
        '{$charge_level}',
        '{$charge_status}');";

    if(mysqli_query($con, $sql_add_status))
    {
        echo "The JSON is successfully uploaded\n";
    } else {
        echo "SQL add query error\n";
    }
    
?>
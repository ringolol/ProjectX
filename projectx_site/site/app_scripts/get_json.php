<?php

    /* Takes JSON from the request */
    $json = $_POST['json'];

    /* get inputs from JSON */
    $vars = json_decode($json);
    $android_id = $vars->{'android_id'};
    $latitude = $vars->{'latitude'};
    $longitude = $vars->{'longitude'};
    $charge_level = $vars->{'charge_level'};
    $charge_status = $vars->{'charge_status'};
    $time_stamp = $vars->{'time_stamp'};

    /* Include config file */
    require_once "../config.php";

    /* check android_id and get device_id and location_id */
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
    
    /* Insert statuses from JSON into DB -- table devices_statuses */
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

    // Close connection
    mysqli_close($con);
    
?>
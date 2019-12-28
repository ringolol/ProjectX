<?php

    /* check android_id and get device_id and location_id */
    $sql_get_deviceID_locationID =
    "SELECT device_id, location_id
    FROM devices
    JOIN devices_locations USING (device_id)
    WHERE android_id = '{$android_id}';";

    if(!($result_get = mysqli_query($con, $sql_get_deviceID_locationID)))
    {
        echo "SQL check android_id query error\n";
        // Close connection
        mysqli_close($con);
        exit();
    }

    if ($row = $result_get->fetch_assoc())
    {
        $device_id = $row['device_id'];
        $location_id = $row['location_id'];
    } else {
        echo "Device is not linked to any location\n";
        // Close connection
        mysqli_close($con);
        exit();
    }

?>
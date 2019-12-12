<?php
    session_start();
    // if user not logged in redirect him to login page
    require 'is_not_logged_in.php';

    $device_id = $_GET['devId'];
    $location_id = $_GET['locId'];
    $user_id = $_SESSION['user_id'];

    $url = "../device.php?locId=$location_id";

    ob_start(); // ensures anything dumped out will be caught

    // clear out the output buffer
    while (ob_get_status()) 
    {
        ob_end_clean();
    }

    // Connect db 
    require_once "../config_db.php";

    // todo check location & device_id bound
    $sql_check = "
    SELECT user_id, location_id, device_id
    FROM locations
    JOIN devices_locations
    USING (location_id)
    WHERE location_id = '$location_id' AND user_id = '$user_id' AND device_id = '$device_id'";

    $result_check = $con->query($sql_check);

    if(!($row_check = $result_check->fetch_assoc())) {
        echo "Access error: wrong combination of user_id = '$user_id', location_id = '$location_id' and device_id ='$device_id'";
        mysqli_close($con);

        // no redirect
        header( "Location: $url" );
        exit;
    }

    $sql_get_status = 
    "SELECT dummy
    FROM devices
    WHERE device_id = {$device_id}";

    $result_get = $con->query($sql_get_status);

    $dummy = 0;
    if($row_get = $result_get->fetch_assoc()) {
        $dummy = $row_get['dummy'];
    }
    $dummy = $dummy!=1?1:0;

    $sql_shoot =
    "UPDATE devices
    SET dummy = '$dummy'
    WHERE device_id = {$device_id}";

    $result_get = $con->query($sql_shoot);

    // Close connection
    mysqli_close($con);

    // no redirect
    header( "Location: $url" );
?>
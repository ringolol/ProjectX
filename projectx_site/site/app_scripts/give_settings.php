<?php

$android_id = $_POST['android_id'];

/* Include config file */
require_once "../config.php";

/* check android_id and... */
require_once "../check_id_get_data.php";

$sql_get_camera_par = 
"SELECT 
    flash,
    front,
    quality,
    res_width,
    res_height
 FROM devices
 WHERE android_id = '{$android_id}'";

if($result_get = mysqli_query($con, $sql_get_camera_par))
{
    if ($row_get = $result_get->fetch_assoc())
    {
        echo json_encode($row_get);
    }
} else {
    echo "SQL add query error\n";
}

// Close connection
mysqli_close($con);

?>
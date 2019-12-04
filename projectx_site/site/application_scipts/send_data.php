<?php
    // database "constants"
    $servername = "localhost";
    $username = "root";
    $password = "12344321aAcCc";
    $dbname = "projectx_db";

    $device_id = 7;
    $location_id = 2;

    // connect to db
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $image = '../temp/Rosa_smilyface.png';
    $contents = addslashes(file_get_contents($image));

    $sql_insert_image = "INSERT INTO files (device_id,location_id,image) VALUES(7,2,'{$contents}');";

    
    // send file to db
    $res_temp = $conn->query($sql_insert_image);

    //get file from db
    $sql_get_image = "SELECT image
                      FROM files
                      WHERE device_id = {$device_id} AND location_id = {$location_id}
                      ORDER BY file_id DESC
                      LIMIT 1;";


    // send file to db
    $result_image = mysqli_query($conn, $sql_get_image);

    $row_image = mysqli_fetch_array($result_image);

    header("Content-Type: image/png");
    echo $row_image["image"];

    $conn->close();

?>
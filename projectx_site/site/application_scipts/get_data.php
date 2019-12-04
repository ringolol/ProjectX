<?php
    // database "constants"
    $servername = "localhost";
    $username = "root";
    $password = "12344321aAcCc";
    $dbname = "projectx_db";

    $device_id = $_GET["device_id"];
    // Create connection
    $con=mysqli_connect("localhost","root","12344321aAcCc","projectx_db");
    
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $sql_get_data = "SELECT * 
                     FROM devices 
                     WHERE android_id = '{$device_id}';";

    // Confirm there are results
    if ($result = mysqli_query($con, $sql_get_data))
    {

        // We have results, create an array to hold the results
        // and an array to hold the data
        $resultArray = array();
        $tempArray = array();
    
        // Loop through each result
        while($row = $result->fetch_object())
        {
            // Add each result into the results array
            $tempArray = $row;
            array_push($resultArray, $tempArray);
        }
    
        // Encode the array to JSON and output the results
        echo json_encode($resultArray);
    }
?>
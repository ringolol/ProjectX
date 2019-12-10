<?php 

    // Get session user_id
    $user_id = $_SESSION["user_id"];

    // Connect db 
    require_once "./config_db.php";

    // Get location name and id by user id
    $sql_locations =   "
    SELECT name, location_id
        FROM locations
        WHERE user_id = '{$user_id}'";
        
    $result_loc = $con->query($sql_locations);

    $i = 0;
    // for each location user has
    while($row_loc = $result_loc->fetch_assoc()) {
        // create html element (like button)
        // customize it's name and link
        $cont_num = $i % 3 + 1;
        echo "
        <a href='./device.php?locId={$row_loc['location_id']}'>
            <div class='wrap wrap--1'>
                <div class='container container--{$cont_num}'>
                    <p>{$row_loc['name']}</p>
                </div>
            </div>
        </a>";
        $i++;
    }

    // Close connection
    mysqli_close($con);

?>
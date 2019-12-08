<?php

    // Initialize the session
    session_start();
    
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Personal office</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="personal-office/personal-office__header/personal-office__header.css">
    <link rel="stylesheet" href="photo-gallery/photo-gallery.css">
<body>
    <header class="header">
        <nav class="nav-panel header__nav-panel">
            <ul class="nav-panel__ul">
                <li class="nav-panel__li">
                    <a href="index.php" class="items nav-panel__items">Locations</a>
                </li>
                <li class="logo nav-panel__li">
                  <a href="#" class="nav-panel__logo-link"><img src="personal-office/personal-office__header/logo.svg" alt="" class="logo nav-panel__logo white-logo"><img src="personal-office/personal-office__header/logo.svg" alt="" class="logo nav-panel__logo black-logo"></a>
                </li>
                <li class="nav-panel__li">
                    <a href="logout.php" class="items nav-panel__items">Logout</a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="main-body">
     
        <h1 class="title">Location
            <?php
            
                $location_id = $_GET['loc'];
                echo "#{$location_id}"
            
            ?>
        </h1>

        <div class="container">
            <?php

                $user_id = $_SESSION["user_id"];
                

                // Include config file
                require_once "config.php";

                $sql_get_devices = "
                SELECT device_id
                FROM devices_locations
                WHERE location_id = '{$location_id}'";

                $result_devs = $con->query($sql_get_devices);

                while($row_devs = $result_devs->fetch_assoc()) {
                    $device_id = $row_devs['device_id'];

                    $sql_get_last_photo = "
                    SELECT image_path
                    FROM files
                    WHERE 
                        device_id = '{$device_id}' 
                        AND location_id = '{$location_id}'
                    ORDER BY file_id DESC
                    LIMIT 1";

                    $result_photo = $con->query($sql_get_last_photo);

                    echo "<div class='overlay-image'>";
                    if($row_photo = $result_photo->fetch_assoc()) {
                        $image_path = $row_photo['image_path'];
                        echo "<img src='{$image_path}' class='image'>";
                    }

                    $sql_get_device_name = "
                    SELECT name
                    FROM devices
                    WHERE device_id = '{$device_id}'";

                    $result_name = $con->query($sql_get_device_name);

                    if($row_name = $result_name->fetch_assoc()) {
                        echo "<div class='text'>{$row_name['name']}";
                    }

                    $sql_get_status = "
                    SELECT *
                    FROM devices_statuses
                    WHERE device_id = '{$device_id}' AND location_id = '{$location_id}'
                    ORDER BY status_id DESC
                    LIMIT 1";

                    $result_status = $con->query($sql_get_status);

                    if($row_status = $result_status->fetch_assoc()) {
                        $pos_str = sprintf('%0.3f/%0.3f', $row_status['latitude'], $row_status['longitude']);
                        echo "<div><font  size='3''>Position: {$pos_str};
                        Charge: {$row_status['charge_level']}% is {$row_status['charge_status']}</font></div>";
                    }

                    
                    echo "</div></div>";
                }

                // Close connection
                mysqli_close($con);

            ?>
        </div>
      
    </main>
    <footer></footer>
</body>
</html>
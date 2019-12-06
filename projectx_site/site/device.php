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
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="personal-office/personal-office__header/personal-office__header.css">
    <link rel="stylesheet" href="photo-gallery/photo-gallery.css">
    <link rel="stylesheet" href="personal-office/personal-office__background.css">
<body class="body">
    <header class="header">
        <nav class="nav-panel header__nav-panel">
            <ul class="header__nav-ul">
                <li>
                    <a href="index.php" class="nav-item header__nav-item">Locations</a>
                </li>
                <li>
                    <a href="logout.php" class="nav-item header__nav-item">Logout</a>
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

                    while($row_photo = $result_photo->fetch_assoc()) {
                        $image_path = $row_photo['image_path'];
                        echo "<img src='{$image_path}'>";
                    }
                }

                // Close connection
                mysqli_close($con);

            ?>
        </div>
      
    </main>
    <footer></footer>
</body>
</html>
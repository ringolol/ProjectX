<?php

    // if user not logged in redirect him to login page
    require 'web_scripts/is_not_logged_in.php';

    $device_id = $_GET['devId'];
    $location_id = $_GET['locId'];

    // todo check location & device_id bound

    // Connect db 
    require_once "config_db.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $fl = !$_POST['useFlash']?0:1;
        $fr = !$_POST['useFront']?0:1;

        $sql_upd_status =
        "UPDATE devices
        SET flash = {$fl}, front = {$fr}
        WHERE device_id = {$device_id}";

        $result_get = $con->query($sql_upd_status);
    }
        
    $sql_get_status = 
    "SELECT flash, front
    FROM devices
    WHERE device_id = {$device_id}";

    $result_get = $con->query($sql_get_status);

    $flash = false;
    $front = false;

    if($row_get = $result_get->fetch_assoc()) {
        $flash = boolval($row_get['flash']);
        $front = boolval($row_get['front']);
    }

    // Close connection
    mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Settings</title>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" >
        <link rel="stylesheet" 
            href="personal-office/personal-office__header/personal-office__header.css">

        <style>
            .form-settings {
                align-items: center;
                
            }
        </style>
        <!--<link rel="stylesheet" 
            href="photo-gallery/photo-gallery.css">-->
        <!-- Connect jquery from google -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <header class="header">
            <nav class="nav-panel header__nav-panel">
                <ul class="nav-panel__ul">
                    <li class="nav-panel__li">
                        <a href="device.php?locId=<?php echo $_GET['locId'];?>" 
                            class="items nav-panel__items">Devices</a>
                    </li>
                    <li class="nav-panel__li">
                        <a href="index.php" class="items nav-panel__items">Locations</a>
                    </li>
                    <li class="logo nav-panel__li">
                        <a href="#" class="nav-panel__logo-link">
                            <img src="personal-office/personal-office__header/logo.svg" 
                                class="nav-panel__logo white-logo">
                            <img src="personal-office/personal-office__header/logo.svg" 
                                class="nav-panel__logo black-logo">
                        </a>
                    </li>
                    <li class="nav-panel__li">
                        <a href="web_scripts/logout.php" class="items nav-panel__items">Logout</a>
                    </li>
                    <li class="nav-panel__li">
                        
                    </li>
                </ul>
            </nav>
        </header>
            <form class="form-settings" action="<?php echo basename($_SERVER['REQUEST_URI']); ?>" method="post">
                <h1 class="">Settings</h1>
                Flash <input class="" type="checkbox" name="useFlash"
                    <?php if($flash) echo 'checked'; ?>><br>
                Front camera <input class="t" type="checkbox" name="useFront"
                    <?php if($front) echo 'checked'; ?>><br>
                <input class="" type="submit" value="Apply">
            </form>
    </body>
</html>
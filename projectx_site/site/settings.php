<?php
    session_start();
    // if user not logged in redirect him to login page
    require 'web_scripts/is_not_logged_in.php';

    $device_id = $_GET['devId'];
    $location_id = $_GET['locId'];
    $user_id = $_SESSION['user_id'];

    // Connect db 
    require_once "config_db.php";

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
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $fl = !$_POST['useFlash']?0:1;
        $fr = !$_POST['useFront']?0:1;
        $hq = !$_POST['highQuality']?0:1;
        $rw = intval($_POST['res_width']);
        $rh = intval($_POST['res_height']);
        $ui = intval($_POST['uInter'])*1000;
        

        $sql_upd_status =
        "UPDATE devices
        SET 
            flash = {$fl},
            front = {$fr},
            quality = {$hq},
            upd_interval = '{$ui}'
        WHERE device_id = {$device_id}";

        /*res_width = '{$rw}',
        res_height = '{$rh}',*/

        $result_get = $con->query($sql_upd_status);

        // Close connection
        mysqli_close($con);

        $url = "device.php?locId=$location_id";
        header( "Location: $url" );
        echo "upd_interval = $ui";
    } else {
        $sql_get_status = 
        "SELECT 
            flash, 
            front, 
            res_width, 
            res_height, 
            quality,
            upd_interval
        FROM devices
        WHERE device_id = {$device_id}";

        $result_get = $con->query($sql_get_status);

        $flash = false;
        $front = false;
        $res_width = 0;
        $res_height = 0;
        $quality = 0;


        if($row_get = $result_get->fetch_assoc()) {
            $flash = boolval($row_get['flash']);
            $front = boolval($row_get['front']);
            $res_width = $row_get['res_width'];
            $res_height = $row_get['res_height'];
            $quality = boolval($row_get['quality']);
            $upd_interval = round($row_get['upd_interval']/1000);
        }
        // Close connection
        mysqli_close($con);
    } 

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
        <link rel="stylesheet" href="settings/settings.css">
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
            <div class="contaioner-settings">
                <form action="<?php echo basename($_SERVER['REQUEST_URI']); ?>" method="post">
                    <p class="title">Settings</p>
                    <div class="field">
                        <div class="text">Flash</div>
                        <input class="elem" type="checkbox" name="useFlash"
                            <?php if($flash) echo 'checked'; ?>>
                    </div>
                    <div class="field">
                        <div class="text">Front Camera</div>
                        <input class="elem" type="checkbox" name="useFront"
                            <?php if($front) echo 'checked'; ?>>
                    </div>
                    <!--<div class="field">
                        <div class="text">Camera Res.</div>
                        <div class="elem">
                            <input type="text" style="width: 35px" value="<?php echo $res_width ?>" name="res_width">
                            x
                            <input type="text" style="width: 35px" value="<?php echo $res_height ?>" name="res_height">
                        </div>
                    </div>-->
                    <div class="field">
                        <div class="text">Upd Interval (sec)</div>
                        <select name="uInter" class="elem">
                            <option value="<?php echo $upd_interval ?>" hidden selected>
                                <?php echo $upd_interval ?>
                            </option>
                            <option value="60">60</option>
                            <option value="30">30</option>
                            <option value="10">10</option>
                        </select>
                        <!--<input type="text" class="elem" style="width: 35px" value="<?php echo $upd_interval ?>" name="uInter">-->
                    </div>
                    <div class="field">
                        <div class="text">High Quality</div>
                        <input class="elem" type="checkbox" name="highQuality"
                            <?php if($quality) echo 'checked'; ?>>
                    </div>
                    <input class="btn" type="submit" value="Apply">
                </form>
            </div>
    </body>
</html>
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
            .contaioner-settings {
                text-align: center;
                display: flex;  
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                font-family: Fantasy;
            }
            .contaioner-settings form {
                /*width: 150px;*/
                background: beige;
                padding: 30px;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                position: absolute;
                border-radius: 1.6rem;
                
            }
            .contaioner-settings form .field {
                padding: 10px;
                height: 30px;
                /*width: 100%;*/
            }
            .contaioner-settings form .title {
                font-size: 40px;
                font-weight: 500;
                margin: 10px;
            }
            .contaioner-settings form .field .text {
                /*font-size: 15px;*/
                left: 10%;
                position: absolute;
            }
            .contaioner-settings form .field .elem {
                right: 10%;
                position: absolute;
            }
            .contaioner-settings form .field .btn {
                position: absolute;
                left: 50%;
                transform: translate(-50%, 0%);
                border-radius: 0.2rem;
                width: 80%;
                height: 10%;
                font-size: 18px;
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
            <div class="contaioner-settings">
                <form action="<?php echo basename($_SERVER['REQUEST_URI']); ?>" method="post">
                    <p class="title">Settings</p>
                    <div class="field">
                        <div class="text">Flash</div>
                        <input class="elem" type="checkbox" name="useFlash"
                            <?php if($flash) echo 'checked'; ?>>
                    </div>
                    <div class="field">
                        <div class="text">Front camera</div>
                        <input class="elem" type="checkbox" name="useFront"
                            <?php if($front) echo 'checked'; ?>>
                    </div>
                    <div class="field">
                        <input class="btn" type="submit" value="Apply">
                    </div>
                </form>
            </div>
    </body>
</html>
<?php

    // if user not logged in redirect him to log in page
    require 'web_scripts/is_not_logged_in.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Personal office</title>
        <link rel="stylesheet" href="css/index.css">
        <!-- Connect jquery from google -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Reload pictures every second -->
        <script>
            // load function
            function load_fragment() {
                $('#devices_php')
                    .load('web_scripts/device_fragment.php<?php echo $_SERVER['REQUEST_URI']; ?>');
            }
            // timer that triggers every second
            setInterval(function(){ load_fragment(); }, 1000);
        </script>
    </head>
    <body>
        <header class="header">
            <nav class="nav-panel header__nav-panel">
                <ul class="nav-panel__ul">
                    <li class="nav-panel__li">
                        <a href="index.php" class="items nav-panel__items">Locations</a>
                    </li>
                    <li class="logo nav-panel__li">
                        <a href="#" class="nav-panel__logo-link">
                            <img src="images_work/logo.svg" 
                                class="nav-panel__logo white-logo">
                            <img src="images_work/logo.svg" 
                                class="nav-panel__logo black-logo">
                        </a>
                    </li>
                    <li class="nav-panel__li">
                        <a href="web_scripts/logout.php" class="items nav-panel__items">Logout</a>
                    </li>
                </ul>
            </nav>
        </header>
        <main class="main-body">
            <div class="container" id="scores">
                <div id='devices_php'>
                    <!-- Photos are added here using jquery -->
                </div>
                <!-- Adding photos for the first time -->
                <script> load_fragment(); </script>
            </div>
        </main>
    </body>
</html>
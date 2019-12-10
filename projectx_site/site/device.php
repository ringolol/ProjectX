<?php

    // Initialize the session
    session_start();
    
    // Check if the user is logged in, if not redirect him to login page
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
        <!-- Connect jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Reload pictures every second -->
        <script>
            // load function
            function load_fragment() {
                $('#devices_php')
                    .load('device_fragment.php<?php echo $_SERVER['REQUEST_URI']; ?>');
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
                            <img src="personal-office/personal-office__header/logo.svg" 
                                class="nav-panel__logo white-logo">
                            <img src="personal-office/personal-office__header/logo.svg" 
                                class="nav-panel__logo black-logo">
                        </a>
                    </li>
                    <li class="nav-panel__li">
                        <a href="logout.php" class="items nav-panel__items">Logout</a>
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
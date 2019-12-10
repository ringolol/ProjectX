<?php

    // if user not logged in redirect him to login page
    require 'web_scripts/is_not_logged_in.php';

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
        <link rel="stylesheet" 
            href="photo-gallery/photo-gallery.css">
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
        <main class="main-body">
            <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h1 class="">Settings</h1>
                Flash <input class="" type="checkbox" name="username" placeholder="Username"><br>
                Front camera <input class="t" type="checkbox" name="password" placeholder="Password"><br>
                <input class="" type="submit" value="Apply">
            </form>
        </main>
    </body>
</html>
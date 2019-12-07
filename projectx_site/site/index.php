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
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="personal-office/background.css">
    <link rel="stylesheet" href="personal-office/personal-office__header/personal-office__header.css">
    <link rel="stylesheet" href="personal-office/personal-office__photo-section/personal-office__photo-section.css">
    <style>
      a:link, a:visited, a:hover, a:active {
        text-decoration: none;
      }
    </style>
<body class="body">
    <header class="header">
        <nav class="nav-panel header__nav-panel">
            <ul class="nav-panel__ul">
                <li class="nav-panel__li">
                    <a href="logout.php" class="items nav-panel__items">Logout</a>
                </li>
                <li class="logo nav-panel__li">
                  <a href="#" class="nav-panel__logo-link"><img src="personal-office/personal-office__header/logo.svg" alt="" class="logo nav-panel__logo white-logo"><img src="personal-office/personal-office__header/logo.svg" alt="" class="logo nav-panel__logo black-logo"></a>
                </li>
                <li class="nav-panel__li">
                    <a href="#" class="items nav-panel__items">About</a>
                </li>
            </ul>
            <a class="nav-panel__icon" href="javascript:void(0);"><span class="nav-panel__icon-span"></span><span class="nav-panel__icon-span"></span><span class="nav-panel__icon-span"></span></a>
        </nav>
    </header>
    <main class="main-body">
        <h1>Locations</h1>
        <section class="main">
        
          <?php 
            $user_id = $_SESSION["user_id"];

            // Include config file
            require_once "config.php";

            $sql_locations =   "
            SELECT name, location_id
              FROM locations
              WHERE user_id = '{$user_id}'";
                
            $result_loc = $con->query($sql_locations);

            while($row_loc = $result_loc->fetch_assoc()) {
              echo "
              <a href='device.php?loc={$row_loc['location_id']}'>
                <div class='wrap wrap--1'>
                  <div class='container container--1'>
                    <p>{$row_loc['name']}</p>
                  </div>
                </div>
              </a>";
            }

            // Close connection
            mysqli_close($con);

          ?>
        
        </section>
    </main>
    <footer></footer>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</body>
</html>
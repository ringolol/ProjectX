<?php

  // Initialize the session
  session_start();
  
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  if(isset($_POST['btn'])) { 
    list($loc_id,$loc_name) = explode('|', $_POST['btn']);
    $_SESSION['location_id']=$loc_id;
    $_SESSION['location_name']=$loc_name;
    header('Location: device.php');
  } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Personal office</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="personal-office/personal-office__header/personal-office__header.css">
  <link rel="stylesheet" href="personal-office/personal-office__photo-section/personal-office__photo-section.css">
  <style>
    a:link, a:visited, a:hover, a:active {
      text-decoration: none;
    }
  </style>
</head>
<body>
    <header class="header">
        <nav class="nav-panel header__nav-panel">
            <ul class="nav-panel__ul">
                <li class="nav-panel__li">
                  <a href="#" class="items nav-panel__items">About</a>
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
        <h1>Locations</h1>
        <main class="main">
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
              <a href='device.php?locId={$row_loc['location_id']}&locName={$row_loc['name']}'>
                <div class='wrap wrap--1'>
                  <div class='container container--1'>
                    <p>{$row_loc['name']}</p>
                  </div>
                </div>
              </a>";
              //echo "<input type='submit' name='button1' value='{$row_loc['name']}' class='wrap wrap--1 container container--1'/> ";
              /*echo "
              <div class='wrap'>
                <div class='container'>
                  <input type='submit' name='btn' value='{$row_loc['location_id']}|{$row_loc['name']}'/>
                </div>
              </div>";*/
            }

            // Close connection
            mysqli_close($con);

          ?>
        </main>
    <footer></footer>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</body>
</html>
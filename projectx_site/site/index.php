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
    <link rel="stylesheet" href="personal-office/personal-office__photo-section/personal-office__photo-section.css">
    <link rel="stylesheet" href="personal-office/personal-office__background.css">
    <style>
      a:link, a:visited, a:hover, a:active {
        text-decoration: none;
      }
    </style>
<body class="body">
    <header class="header">
        <nav class="nav-panel header__nav-panel">
            <ul class="header__nav-ul">
                <li>
                    <a href="logout.php" class="nav-item header__nav-item">Logout</a>
                </li>
            </ul>
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
            SELECT name
              FROM locations
              WHERE user_id = '{$user_id}'";
                
            $result_loc = $con->query($sql_locations);

            while($row_loc = $result_loc->fetch_assoc()) {
              echo "
              <a href='lol.php'>
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
</body>
</html>
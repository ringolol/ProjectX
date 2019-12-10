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
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" >
  <link rel="stylesheet" 
    href="personal-office/personal-office__header/personal-office__header.css">
  <link rel="stylesheet" 
    href="personal-office/personal-office__photo-section/personal-office__photo-section.css">
</head>
<body>
    <header class="header">
        <nav class="nav-panel header__nav-panel">
            <ul class="nav-panel__ul">
                <li class="nav-panel__li">
                  <a href="#" class="items nav-panel__items">About</a>
                </li>
                <li class="logo nav-panel__li">
                  <a href="#" class="nav-panel__logo-link">
                    <img src="personal-office/personal-office__header/logo.svg" class="logo nav-panel__logo white-logo">
                    <img src="personal-office/personal-office__header/logo.svg" class="logo nav-panel__logo black-logo">
                  </a>
                </li>
                <li class="nav-panel__li">
                    <a href="logout.php" class="items nav-panel__items">Logout</a>
                </li>
            </ul>
        </nav>
    </header>
        <h1>Locations</h1>
        <main class="main">
          <!-- Add locations here -->
          <?php require 'index_fragment.php'; ?>
        </main>
</body>
</html>
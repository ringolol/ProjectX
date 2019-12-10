<?php

    // if user not logged in redirect him to log in page
    require 'web_scripts/is_not_logged_in.php';

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
                  
                </li>
                <li class="logo nav-panel__li">
                  <a href="#" class="nav-panel__logo-link">
                    <img src="personal-office/personal-office__header/logo.svg" class="logo nav-panel__logo white-logo">
                    <img src="personal-office/personal-office__header/logo.svg" class="logo nav-panel__logo black-logo">
                  </a>
                </li>
                <li class="nav-panel__li">
                    <a href="web_scripts/logout.php" class="items nav-panel__items">Logout</a>
                </li>
            </ul>
        </nav>
    </header>
        <h1>Locations</h1>
        <main class="main">
          <!-- Add locations here -->
          <?php require 'web_scripts/index_fragment.php'; ?>
        </main>
</body>
</html>
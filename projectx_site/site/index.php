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
  <link rel="stylesheet" href="css/index.css">
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
                    <img src="images_work/logo.svg" class="logo nav-panel__logo white-logo">
                    <img src="images_work/logo.svg" class="logo nav-panel__logo black-logo">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>
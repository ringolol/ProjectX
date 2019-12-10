<?php

    /* Database credentials. */
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'projectx_db');
    
    /* Attempt to connect to MySQL database */
    $con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    /* Check connection */
    if(mysqli_connect_errno()){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

?>
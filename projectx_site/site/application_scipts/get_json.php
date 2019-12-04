<?php

    // Takes raw data from the request
    $json = file_get_contents('php://input');
    echo $json;

	$myfile = fopen("log.txt", "a");
	fwrite($myfile, "data:{$json}\n");
?>
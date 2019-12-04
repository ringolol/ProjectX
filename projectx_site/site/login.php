<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Locations</title>
</head>
<body>
    <form class="box">
        <?php
            // database constants
            $servername = "localhost";
            $username = "root";
            $password = "12344321aAcCc";
            $dbname = "projectx_db";
            // ftp constants
            $ftp_server = "localhost";
            $ftp_username = "root";
            $ftp_userpass = "12344321aAcCc";

            function login($servername, $username, $password, $dbname) {
                $error = NULL;
                // connect to db
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
                
                // get users password from db
                $sql_login =   "SELECT password
                                FROM users
                                WHERE name = '{$_POST['login_field']}';";


                $result_login = $conn->query($sql_login);


                if ($result_login->num_rows == 1) {
                    $row_login = $result_login->fetch_assoc();
                    // compare password from db and entered password
                    if($row_login['password'] == $_POST['password_field']) {
                        $logged = true;
                    } else {
                        $error = "Wrong password";
                    }
                } else if ($result_login->num_rows == 0) {
                    $error = "Wrong user name";
                } else {
                    $error = "Too many users with the same name.\nIf you cannot log in, please contact support.";
                }
                // disconnect from db
                $conn->close();

                return $error;
            }

            function show_data($servername, $username, $password, $dbname) {
                echo '<h1>Locations</h1>';

                // connect to db
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // sql query for locations
                $sql_locations =   "SELECT location_id, name
                                    FROM locations
                                    WHERE user_id IN
                                        (SELECT user_id FROM users WHERE name = '{$_POST['login_field']}')";
                
                $result_loc = $conn->query($sql_locations);

                while($row_loc = $result_loc->fetch_assoc()) {
                    echo "<h3>Location: " . $row_loc["name"] . "</h3>";

                    // sql query for devices on this location
                    $sql_devices = "SELECT *
                                    FROM devices
                                    WHERE device_id IN
                                        (SELECT device_id 
                                        FROM devices_locations
                                        WHERE location_id = '{$row_loc["location_id"]}');";

                    $result_dev = $conn->query($sql_devices);
                    echo "<h3>Devices:</h3>";
                    while($row_dev = $result_dev->fetch_assoc()) {
                        echo "ID: " . $row_dev['android_id'] . "<br>location: " . $row_dev['latitude'] 
                            . " / " . $row_dev['longitude'] . "<br>" . "charge_level: " . $row_dev['charge_level'] . "<br><br>";
                    }

                    echo "<h3><br></h3>";
                }
            }

            function ftp_get_image($ftp_server, $ftp_username, $ftp_userpass, $file_name) {
                // connect to FTP server
                $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
                // login to FTP server
                $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);


                $local_file = "temp/{$_POST['login_field']}_{$file_name}";

                // download server file
                if (ftp_get($ftp_conn, $local_file, $file_name, FTP_ASCII)) {
                    echo "Successfully written to $local_file";
                } else {
                    echo "Error downloading $file_name";
                }

                // close ftp connection
                ftp_close($ftp_conn); 
            }
            
            // login using data from forms
            $error = login($servername, $username, $password, $dbname);

            // if the user name or password is wrong
            if(isset($error)) {
                // print error message
                echo "<h2>$error</h2>";
            } else {
                // get images from ftp
                $file_name = 'smilyface.png';
                ftp_get_image($ftp_server, $ftp_username, $ftp_userpass, $file_name);
                // show image
                echo "<img src='temp/{$_POST['login_field']}_{$file_name}'>";
                // show data
                show_data($servername, $username, $password, $dbname);
            }

        ?>
    </form>
</body>
</html>
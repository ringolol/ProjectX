<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "projectx_db"; 

        $logged = false;

        // on submit button click on login page
        if(isset($_POST['button_submit'])) {
            // connect to db
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            
            // get users password from db
            $sql_login =   "SELECT password
                            FROM users
                            WHERE name = '" . $_POST['login_field']."';";

            $result_login = $conn->query($sql_login);

            if ($result_login->num_rows == 1) {
                $row_login = $result_login->fetch_assoc();
                // compare password from db and entered password
                if($row_login['password'] == $_POST['password_field']) {
                    $logged = true;
                } else {
                    $error = "Wrong password";
                }
            } else {
                $error = "Wrong user name";
            }
            // disconnect from db
            $conn->close();
        }

        // If user is logged
        if (!$logged) {
            // show LOGIN PAGE
            echo '<form class="box" action="" method="POST">
                    <h1>Login</h1>
                    <h2>'
                    . $error .
                    '</h2>
                    <input type="text" name="login_field" placeholder="Username" required>
                    <input type="password" name="password_field" placeholder="Password" required>
                    <input type="submit" name="button_submit" value="Login">
                  </form>';
            //require('templates/login_form.php');
        } else {
            // show LOCATIONS PAGE
            echo '<form class="box" action="" method="POST">';
            echo '<h1>Locations</h1>';

            // connect to db
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql_locations =   "SELECT location_id, name
                                FROM locations
                                WHERE user_id IN
                                    (SELECT user_id FROM users WHERE name = '". $_POST['login_field']."')";
            
            $result_loc = $conn->query($sql_locations);

            while($row_loc = $result_loc->fetch_assoc()) {
                echo "<h3>Location: " . $row_loc["name"] . "</h3>";

                $sql_devices = "SELECT *
                                FROM devices
                                WHERE device_id IN
                                    (SELECT device_id 
                                     FROM devices_locations
                                     WHERE location_id = '". $row_loc["location_id"] ."');";

                $result_dev = $conn->query($sql_devices);
                echo "<h3>Devices:</h3>";
                while($row_dev = $result_dev->fetch_assoc()) {
                    echo "ID: " . $row_dev['android_id'] . "<br>location: " . $row_dev['latitude'] 
                        . " / " . $row_dev['longitude'] . "<br>" . "charge_level: " . $row_dev['charge_level'] . "<br><br>";
                }

                echo "<h3><br></h3>";
            }

            echo '</form>';

            // disconnect from db
            $conn->close();
        }
    ?>
</body>
</html>
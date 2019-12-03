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

        if(isset($_POST['button_submit'])) {
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            
            $sql_login =   "SELECT password
                            FROM users
                            WHERE name = '" . $_POST['login_field']."';";
            $result = $conn->query($sql_login);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if($row['password'] == $_POST['password_field']) {
                    $logged = true;
                }
            }
        }

        if (!$logged) {
            require('templates/login_form.php');
        } else {
            echo '<form class="box" action="" method="POST">';
            echo '<h1>Locations</h1>';

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
        }
    ?>
</body>
</html>
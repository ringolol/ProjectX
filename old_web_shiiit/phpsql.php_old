$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectx_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT latitude, longitude,	charge_level, charge_status, temperature FROM devices WHERE android_id = 'krakoziabra111';";
        
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "latitude: " . $row["latitude"]. " - longitude: " . $row["longitude"]. " - charge_level: " . $row["charge_level"]. " - charge_status: " . $row["charge_status"]. " - temperature: " . $row["temperature"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();


$sql_device_data = "SELECT 
                        latitude, 
                        longitude,	
                        charge_level, 
                        charge_status, 
                        temperature 
                    FROM devices 
                    WHERE android_id = 'krakoziabra111';";
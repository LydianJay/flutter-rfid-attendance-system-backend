<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rfid_attendance_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);


// Check connection
if (mysqli_connect_error()) {
    echo "Error";
    die("Connection failed: " . $conn->connect_error);
}
$json_data = file_get_contents("php://input");
$data = json_decode($json_data);



if($data === null){
    echo json_last_error_msg();
}
else {
    
    $sql = "SELECT * FROM course WHERE name LIKE '%$data->value%' OR abbr LIKE '%$data->value%' LIMIT 3";
    $result = $conn->query($sql);
    echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));


}



$conn->close();
?>
<?php
require '../config/config.php';

$servername = "localhost";
$username = $_db_user;
$password = $_db_pass;
$database = $_db_name;
// Create connection
$conn = new mysqli($servername, $username, $password, $database);


// Check connection
if (mysqli_connect_error()) {
    echo "Error";
    die("Connection failed: " . $conn->connect_error);
}
$json_data = file_get_contents("php://input");
$data = json_decode($json_data);



if ($data === null) {
    echo json_last_error_msg();
} else {

    $sql = "SELECT course.id as id, course.name as name, course.abbr as abbr FROM course INNER JOIN students ON course.id = students.courseID WHERE students.rfid = '$data->value' LIMIT 1";
    $result = $conn->query($sql);
    echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
}



$conn->close();

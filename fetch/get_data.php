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
    die("Connection failed: " . $conn->connect_error);
}



$sql = "SELECT * FROM students ORDER BY lname ASC";

$result = $conn->query($sql);
echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));

// echo implode(",", mysqli_fetch_array($result));


// while ($row = $result->fetch_assoc()) {
//     echo "rfid: " . $row["rfid"] . " - Name: " . $row["fname"] . " " . $row["lname"] . "<br>";
// }
$conn->close();

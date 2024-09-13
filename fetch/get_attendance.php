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


$sql = "SELECT * FROM attendance ORDER BY 'year', 'month', 'day', 'time' ASC";

$result = $conn->query($sql);
echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));

$conn->close();

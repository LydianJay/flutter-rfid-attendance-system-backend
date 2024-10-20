<?php
require '../config/config.php';

$servername = "localhost";
$username = $_db_user;
$password = $_db_pass;
$database = $_db_name;
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM nstp_course LIMIT 5";
$result = $conn->query($sql);
echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));


$conn->close();

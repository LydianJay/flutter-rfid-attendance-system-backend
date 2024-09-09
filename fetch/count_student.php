<?php
require '../config/config.php';

$servername = "localhost";
$username = $_db_user;
$password = $_db_pass;
$database = $_db_name;

$conn = new mysqli($servername, $username, $password, $database);


if (mysqli_connect_error()) {
    echo "Error";
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql = "SELECT COUNT(gender) as num FROM students GROUP BY gender ORDER BY gender DESC";
    $result = $conn->query($sql);
    echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
}



$conn->close();

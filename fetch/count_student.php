<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rfid_attendance_system";

$conn = new mysqli($servername, $username, $password, $database);


if (mysqli_connect_error()) {
    echo "Error";
    die("Connection failed: " . $conn->connect_error);
}
else {
    $sql = "SELECT COUNT(gender) as num FROM students GROUP BY gender ORDER BY gender DESC";
    $result = $conn->query($sql);
    echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
}



$conn->close();
?>
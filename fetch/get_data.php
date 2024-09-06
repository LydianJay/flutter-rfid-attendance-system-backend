<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "rfid_attendance_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);


// Check connection
if (mysqli_connect_error()) {
    die("Connection failed: " . $conn->connect_error);
}



$sql = "SELECT * FROM students";

$result = $conn->query($sql);
echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));

// echo implode(",", mysqli_fetch_array($result));


// while ($row = $result->fetch_assoc()) {
//     echo "rfid: " . $row["rfid"] . " - Name: " . $row["fname"] . " " . $row["lname"] . "<br>";
// }
$conn->close();

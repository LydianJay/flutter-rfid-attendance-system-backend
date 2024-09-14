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


$json_data = file_get_contents("php://input");
$data = json_decode($json_data);



if ($data === null) {
    echo json_last_error_msg();
} else {

    $sql = "SELECT attendance.rfid AS rfid, attendance.day AS day, attendance.time AS time, attendance.type AS type, students.fname AS fname, students.lname AS lname, students.mname AS mname, students.gender AS gender, nstp_course.abbr AS nstp, course.name AS course_name FROM attendance JOIN students ON students.rfid = attendance.rfid JOIN nstp_course ON nstp_course.id = students.nstpID JOIN course ON course.id = students.courseID 
    WHERE month = '$data->month' AND day >= '$data->min' AND day <= '$data->max' AND year = '$data->year' ORDER BY fname, year, month, day";
    $result = $conn->query($sql);
    echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
}


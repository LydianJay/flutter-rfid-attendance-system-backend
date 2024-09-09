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
}
$json_data = file_get_contents("php://input");
$data = json_decode($json_data);



if ($data === null) {
    echo json_last_error_msg();
} else {
    $sql = "
    REPLACE INTO students (rfid, fname, mname, lname, bday, bmonth, byear, gender, courseID) 
    VALUES ('$data->rfid', '$data->fname', '$data->mname', '$data->lname', '$data->bday', '$data->bmonth', '$data->byear', '$data->gender', '$data->courseID')
    ";
    if ($conn->query($sql) === TRUE) {
        echo "Modify Success!";
    } else {
        echo "Modify Error!";
    }
}



$conn->close();

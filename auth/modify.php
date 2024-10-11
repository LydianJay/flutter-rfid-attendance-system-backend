<?php


require '../config/config.php';

$servername = "localhost";
$username = $_db_user;
$password = $_db_pass;
$database = $_db_name;

$conn = new mysqli($servername, $username, $password, $database);

$json_data = file_get_contents("php://input");
$data = json_decode($json_data);

if (mysqli_connect_error()) {
    echo "Error";
    die("Connection failed: " . $conn->connect_error);
} else {

    if ($data === null) {
        echo $json_data;
    } else {
        $sql    = "UPDATE admin SET uname = '$data->newname', pass = '$data->newpass' WHERE uname = '$data->oldname' AND pass = '$data->oldpass'";
        $conn->query($sql);
    }
}



$conn->close();

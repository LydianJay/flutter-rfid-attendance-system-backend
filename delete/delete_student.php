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
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data);

    $sql = "DELETE FROM students WHERE rfid = '$data->value' ";
    $sql2 = "DELETE FROM attendance WHERE rfid = '$data->value'";
    $result = $conn->query($sql);
    $res2 = $conn->query($sql2);
    echo "success";
}

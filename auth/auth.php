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
        $sql    = "SELECT COUNT(id) as n FROM admin WHERE uname = '$data->uname' AND pass = '$data->pass'";

        $result = $conn->query($sql);
        $auth   = $result->fetch_assoc();

        if ($auth['n'] > 0) {
            echo 'ok';
        } else {
            echo $data->pass;
        }
    }
}



$conn->close();

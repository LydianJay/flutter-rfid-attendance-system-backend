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

date_default_timezone_set("Asia/Singapore");




if ($data === null) {
    echo json_last_error_msg();
} else {

    $date   = date('m-d-Y');
    $splite = explode('-', $date);
    $time   = date('H:i');

    $month  = $splite[0];
    $day    = $splite[1];
    $year   = $splite[2];


    // count how if already has sign in and out for the day

    $q2     = "SELECT COUNT(rfid) as n FROM attendance WHERE rfid = '$data->rfid' AND day = '$day' AND month = '$month' AND year = '$year' ";
    $q2res  = $conn->query($q2);
    $q2as   = $q2res->fetch_assoc();
    // ================================================
    
    if($q2as['n'] < 2){
        $find = "SELECT COUNT(rfid) AS n FROM attendance WHERE rfid = '$data->rfid' AND day = '$day' AND month = '$month' AND year = '$year' AND type = 1 ";
        $fRes = $conn->query($find);
        $fjson = $fRes->fetch_assoc();


        $type = $fjson['n'] >= 1 ? 0 : 1;
    
        
        $sql = "
        INSERT INTO attendance (rfid, day, month, year, time, type) 
        VALUES ('$data->rfid', '$day', '$month', '$year', '$time', '$type')
        ";
        $conn->query($sql);
    }
    
    
   
}



$conn->close();

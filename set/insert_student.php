<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rfid_attendance_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);


// Check connection
if (mysqli_connect_error()) {
    echo "Error";
    die("Connection failed: " . $conn->connect_error);
}
$json_data = file_get_contents("php://input");
$data = json_decode($json_data);



if($data === null){
    echo json_last_error_msg();
}
else {
    $sql = "
    INSERT IGNORE INTO students (rfid, fname, mname, lname, bday, bmonth, byear, gender, courseID) 
    VALUES ('$data->rfid', '$data->fname', '$data->mname', '$data->lname', '$data->bday', '$data->bmonth', '$data->byear', '$data->gender', '$data->courseID')
    ";
    if($conn->query($sql) === TRUE){
        echo "Insert Success!";
    }
    else {
        echo "Insert Error!";
    }

}



$conn->close();
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "hospital_db";

$conn = mysqli_connect ($servername, $username, $password, $database);

if(!$conn){
    die("connection failed:" . mysqli_connect_error());
} else {
    echo "connection was successfull. <br>";
}

$sql = "CREATE TABLE appointments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        address VARCHAR(255) NOT NULL,
        doctor VARCHAR(100) NOT NULL,
        age INT NOT NULL,
        reason TEXT,
        appointment_date DATE,
        appointment_time VARCHAR(20),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     )";

     if(mysqli_query($conn, $sql)){
        echo "table was created successfull";
     } else {
        echo "Error creating table: " . mysqli_error($conn);
     }
        
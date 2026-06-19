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

$sql = "CREATE TABLE IF NOT EXISTS appointments (
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
        
/* Admin Table */

$sql2 = "CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if(mysqli_query($conn, $sql2)){
    echo "Admins table created successfully.<br>";
}else{
    echo "Error creating admins table: " . mysqli_error($conn) . "<br>";
}


/* Default Admin Insert */

$checkAdmin = mysqli_query($conn, "SELECT * FROM admins WHERE username='admin'");

if(mysqli_num_rows($checkAdmin) == 0){

    $username = "admin";
    $password = password_hash("admin123", PASSWORD_DEFAULT);

    $insertAdmin = "INSERT INTO admins(username,password)
                    VALUES('$username','$password')";

    if(mysqli_query($conn, $insertAdmin)){
        echo "Default admin created successfully.<br>";
        echo "Username: admin <br>";
        echo "Password: admin123 <br>";
    }
}

mysqli_close($conn);

?>     
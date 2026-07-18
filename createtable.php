<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "hospital_db";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}else{
    echo "Database connected successfully.<br><br>";
}

/* ===========================
   APPOINTMENTS TABLE
=========================== */

$sql = "CREATE TABLE IF NOT EXISTS appointments(
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

if(mysqli_query($conn,$sql)){
    echo "Appointments table created successfully.<br>";
}else{
    echo "Error: ".mysqli_error($conn)."<br>";
}


/* ===========================
   ADD STATUS COLUMN
=========================== */

$checkColumn = mysqli_query($conn,
"SHOW COLUMNS FROM appointments LIKE 'status'");

if(mysqli_num_rows($checkColumn)==0){

    $sqlStatus = "ALTER TABLE appointments
                  ADD status VARCHAR(20)
                  DEFAULT 'Pending'";

    if(mysqli_query($conn,$sqlStatus)){
        echo "Status column added successfully.<br>";
    }else{
        echo mysqli_error($conn)."<br>";
    }

}


/* ===========================
   ADMINS TABLE
=========================== */

$sql2 = "CREATE TABLE IF NOT EXISTS admins(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if(mysqli_query($conn,$sql2)){
    echo "Admins table created successfully.<br>";
}else{
    echo mysqli_error($conn)."<br>";
}

/* ===========================
   ADD doctor_id COLUMN
=========================== */

$checkDoctorId = mysqli_query(
$conn,
"SHOW COLUMNS FROM appointments LIKE 'doctor_id'"
);

if(mysqli_num_rows($checkDoctorId)==0){

    $sqlDoctorId = "ALTER TABLE appointments
                    ADD doctor_id INT NULL AFTER address";

    if(mysqli_query($conn,$sqlDoctorId)){
        echo "doctor_id column added successfully.<br>";
    }else{
        echo mysqli_error($conn)."<br>";
    }

}


/* ===========================
   DOCTORS TABLE
=========================== */

$sql3 = "CREATE TABLE IF NOT EXISTS doctors(

    id INT AUTO_INCREMENT PRIMARY KEY,

    doctor_name VARCHAR(100) NOT NULL,

    specialization VARCHAR(100) NOT NULL,

    experience INT NOT NULL,

    fees DECIMAL(10,2) NOT NULL,

    phone VARCHAR(20) NOT NULL UNIQUE,

    email VARCHAR(100) NOT NULL UNIQUE,

    status ENUM('Active','Inactive')
    DEFAULT 'Active',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

)";

if(mysqli_query($conn,$sql3)){
    echo "Doctors table created successfully.<br>";
}else{
    echo mysqli_error($conn)."<br>";
}

/* ===========================
   DOCTOR SCHEDULE TABLE
=========================== */

$sql4 = "CREATE TABLE IF NOT EXISTS doctor_schedule(

    id INT AUTO_INCREMENT PRIMARY KEY,

    doctor_id INT NOT NULL,

    day ENUM(
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday'
    ) NOT NULL,

    start_time TIME NOT NULL,

    end_time TIME NOT NULL,

    slot_duration INT NOT NULL DEFAULT 30,

    status ENUM('Active','Inactive')
    DEFAULT 'Active',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (doctor_id)
    REFERENCES doctors(id)
    ON DELETE CASCADE

)";

if(mysqli_query($conn,$sql4)){

    echo "Doctor Schedule table created successfully.<br>";

}else{

    echo "Error creating Doctor Schedule table : "
    . mysqli_error($conn) . "<br>";

}

/* ===========================
   DEFAULT ADMIN
=========================== */

$checkAdmin = mysqli_query($conn,
"SELECT * FROM admins WHERE username='admin'");

if(mysqli_num_rows($checkAdmin)==0){

    $username="admin";
    $password=password_hash("admin123",PASSWORD_DEFAULT);

    $insert="INSERT INTO admins(username,password)
             VALUES('$username','$password')";

    if(mysqli_query($conn,$insert)){
        echo "Default Admin Created Successfully.<br>";
        echo "Username : admin <br>";
        echo "Password : admin123 <br>";
    }

}

mysqli_close($conn);

?>
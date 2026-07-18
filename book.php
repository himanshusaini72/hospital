<?php

include 'config.php';

//check if form submitted 
if($_SERVER["REQUEST_METHOD"] == "POST"){

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$doctor_id = (int)$_POST['doctor_id'];

$getDoctor = mysqli_query(
$conn,
"SELECT * FROM doctors
WHERE id='$doctor_id'
AND status='Active'"
);

if(mysqli_num_rows($getDoctor)==0){

    die("Invalid Doctor Selected.");

}

$doctorData = mysqli_fetch_assoc($getDoctor);

$doctor = $doctorData['doctor_name'];
$age = $_POST['age'];
$reason = $_POST['reason'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];

$sql = "INSERT INTO appointments
        (name, email, phone, address, doctor_id, doctor, age, reason, appointment_date, appointment_time)
        VALUES ('$name', '$email', '$phone', '$address', '$doctor_id', '$doctor', '$age', '$reason', '$appointment_date', '$appointment_time')";

        if(mysqli_query($conn, $sql)){

    $appointment_id = mysqli_insert_id($conn);

    header("Location: success.php?status=success&id=".$appointment_id);
    exit();

}else{

    header("Location: success.php?status=error");
    exit();

}
}   

?>
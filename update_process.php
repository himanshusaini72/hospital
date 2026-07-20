<?php

include 'config.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$doctor = $_POST['doctor_id'];
$age = $_POST['age'];
$reason = $_POST['reason'];
$date = $_POST['appointment_date'];
$time = $_POST['appointment_time'];

/* get doctor name*/

$getDoctor = mysqli_query(
$conn,
"SELECT doctor_name 
 FROM doctors 
 WHERE id='$doctor'"
);


$doctorData = mysqli_fetch_assoc($getDoctor);


$doctorName = $doctorData['doctor_name'];


$sql = "UPDATE appointments
SET
name='$name',
email='$email',
phone='$phone',
address='$address',
doctor_id='$doctor_id',
doctor='$doctorName',   
age='$age',
reason='$reason',
appointment_date='$date',
appointment_time='$time'
WHERE id='$id'";

if(mysqli_query($conn,$sql)){

    header("Location: view_my_appointment.html");

}else{

    echo "Update Failed";

}

?>
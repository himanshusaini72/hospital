<?php

include 'config.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$doctor = $_POST['doctor'];
$age = $_POST['age'];
$reason = $_POST['reason'];
$date = $_POST['appointment_date'];
$time = $_POST['appointment_time'];

$sql = "UPDATE appointments
SET
name='$name',
email='$email',
phone='$phone',
address='$address',
doctor='$doctor',
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
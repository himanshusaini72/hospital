<?php
include 'config.php';

$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE appointments
        SET status='$status'
        WHERE id='$id'";

if(mysqli_query($conn,$sql)){
    header("Location: admin_dashboard.php");
}
else{
    echo "Error";
}
?>
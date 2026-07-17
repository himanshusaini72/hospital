<?php
session_start();
include 'config.php';

/* ===========================
   SESSION CHECK
=========================== */

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

/* ===========================
   CHECK ID
=========================== */

if(!isset($_GET['id']) || $_GET['id']==""){
    header("Location: manage_doctors.php");
    exit();
}

$id = (int)$_GET['id'];

/* ===========================
   CHECK DOCTOR EXISTS
=========================== */

$check = mysqli_query($conn,
"SELECT * FROM doctors WHERE id='$id'");

if(mysqli_num_rows($check)==0){

    header("Location: manage_doctors.php?error=notfound");
    exit();

}

/* ===========================
   DELETE DOCTOR
=========================== */

$delete = mysqli_query($conn,
"DELETE FROM doctors WHERE id='$id'");

if($delete){

    header("Location: manage_doctors.php?deleted=1");
    exit();

}else{

    header("Location: manage_doctors.php?error=deletefailed");
    exit();

}

?>
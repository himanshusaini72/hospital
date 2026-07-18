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
    header("Location: manage_schedule.php");
    exit();
}

$id = (int)$_GET['id'];

/* ===========================
   CHECK RECORD EXISTS
=========================== */

$check = mysqli_query($conn,
"SELECT * FROM doctor_schedule WHERE id='$id'");

if(mysqli_num_rows($check)==0){

    header("Location: manage_schedule.php");
    exit();

}

/* ===========================
   DELETE SCHEDULE
=========================== */

$delete = mysqli_query($conn,
"DELETE FROM doctor_schedule WHERE id='$id'");

if($delete){

    echo "<script>

        alert('Schedule Deleted Successfully');

        window.location='manage_schedule.php';

    </script>";

}else{

    echo "<script>

        alert('".mysqli_error($conn)."');

        window.location='manage_schedule.php';

    </script>";

}
?>
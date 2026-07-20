<?php

include 'config.php';


if(isset($_GET['id'])){


$id = $_GET['id'];


$sql = "UPDATE appointments 
        SET status='Cancelled'
        WHERE id='$id'";


if(mysqli_query($conn,$sql)){


    header("Location:view_my_appointment.php");
    exit();


}else{


    echo "Error : ".mysqli_error($conn);


}


}else{


echo "Invalid Appointment ID";


}


?>
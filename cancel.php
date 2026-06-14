<?php

include 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM appointments WHERE id = '$id'";

if(mysqli_query($conn, $sql)){
    header("Location: index.html?msg=cancelled");
    exit();
}else{
    echo "Error: " . mysqli_error($conn);
}

?>
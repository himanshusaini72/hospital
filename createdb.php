<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("connection failed:" . mysqli_connect_error());
} else {
    echo "connection was successfull.";
}
                         
$sql = "CREATE DATABASE hospital_db";

$result = mysqli_query($conn, $sql);
if($result) {
    echo "database create successfull.";
} else {
    echo "database can not created:" . mysqli_connect($conn);
}
?>
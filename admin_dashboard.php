<?php
session_start();
include 'config.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

$where = "";

if(isset($_GET['search']) && $_GET['search'] != ""){
    $search = mysqli_real_escape_string($conn,$_GET['search']);

    $where = "WHERE id LIKE '%$search%'
              OR name LIKE '%$search%'";
}

if(isset($_GET['doctor']) && $_GET['doctor'] != ""){

    $doctor = mysqli_real_escape_string($conn,$_GET['doctor']);

    if($where == ""){
        $where = "WHERE doctor='$doctor'";
    }else{
        $where .= " AND doctor='$doctor'";
    }
}

$sql = "SELECT * FROM appointments
        $where
        ORDER BY created_at DESC";

$result = mysqli_query($conn,$sql);





?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:Arial,sans-serif;
    }

    body{
        background:#f4f6f9;
        padding:30px;
    }

    .header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    }

    h1{
        color:#333;
    }

    .logout-btn{
        background:red;
        color:white;
        padding:10px 20px;
        text-decoration:none;
        border-radius:5px;
    }

    table{
        width:100%;
        border-collapse:collapse;
        background:white;
        box-shadow:0 2px 10px rgba(0,0,0,0.1);
    }

    th{
        background:#0ea5e9;
        color:white;
        padding:12px;
    }

    td{
        padding:10px;
        text-align:center;
        border-bottom:1px solid #ddd;
    }

    tr:hover{
        background:#f1f1f1;
    }

    .edit{
        background:green;
        color:white;
        padding:6px 12px;
        text-decoration:none;
        border-radius:4px;
    }

    .delete{
        background:red;
        color:white;
        padding:6px 12px;
        text-decoration:none;
        border-radius:4px;
    }

    </style>

</head>
<body>

<div class="header">
    <h1>Admin Dashboard</h1>

    <a href="admin_logout.php" class="logout-btn">
        Logout
    </a>
</div>



<form method="GET" style="margin-bottom:20px; display:flex; gap:10px;">

<input type="text"
name="search"
placeholder="Search by ID or Name">

<select name="doctor">

<option value="">All Doctors</option>
<option value="dr-sharma">Dr Sharma</option>
<option value="dr-patel">Dr Patel</option>
<option value="dr-saini">Dr Saini</option>

</select>

<button type="submit">Search</button>

</form>

<table>

<tr>
    <th>ID</th>
    <th>Patient Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Doctor</th>
    <th>Age</th>
    <th>Reason</th>
    <th>Date</th>
    <th>Time</th>
    <th>Action</th>
</tr>

<?php

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

        echo "<tr>

        <td>".$row['id']."</td>
        <td>".$row['name']."</td>
        <td>".$row['email']."</td>
        <td>".$row['phone']."</td>
        <td>".$row['doctor']."</td>
        <td>".$row['age']."</td>
        <td>".$row['reason']."</td>
        <td>".$row['appointment_date']."</td>
        <td>".$row['appointment_time']."</td>
        

        <td>

            <a class='edit' href='update_appointment.php?id=".$row['id']."'> Edit </a> 
            <a class='delete' href='cancle.php?id=".$row['id']."'onclick='return confirm(\"Are you sure?\")'>Delete</a>

        </td>

        </tr>";
    }
                                                                                                               
}else{

    echo "<tr>
            <td colspan='9'>No Appointments Found</td>
          </tr>";
}

?>

</table>
</body>
</html>


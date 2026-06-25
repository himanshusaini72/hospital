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

$total_query = mysqli_query($conn,"SELECT COUNT(*) as total FROM appointments");
$total = mysqli_fetch_assoc($total_query)['total'];

$pending_query = mysqli_query($conn,"SELECT COUNT(*) as total FROM appointments WHERE status='Pending'");
$pending = mysqli_fetch_assoc($pending_query)['total'];

$approved_query = mysqli_query($conn,"SELECT COUNT(*) as total FROM appointments WHERE status='Approved'");
$approved = mysqli_fetch_assoc($approved_query)['total'];

$rejected_query = mysqli_query($conn,"SELECT COUNT(*) as total FROM appointments WHERE status='Rejected'");
$rejected = mysqli_fetch_assoc($rejected_query)['total'];

$limit = 5; // ek page me kitni records dikhani hain

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1){
$page = 1;
}

$offset = ($page - 1) * $limit;

$total_records_query = mysqli_query($conn,
"SELECT COUNT(*) as total FROM appointments $where");

$total_records = mysqli_fetch_assoc($total_records_query)['total'];

$total_pages = ceil($total_records / $limit);


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

    .cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:30px;
}

.card{
    background:#fff;
    padding:25px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

.card h2{
    font-size:35px;
    margin-bottom:10px;
}

.card p{
    color:#666;
    font-size:16px;
}

.total{border-left:5px solid #0ea5e9;}
.pending{border-left:5px solid orange;}
.approved{border-left:5px solid green;}
.rejected{border-left:5px solid red;}

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

    .approve{
    background:green;
    color:white;
    padding:6px 12px;
    border-radius:4px;
    text-decoration:none;
}

.reject{
    background:#dc2626;
    color:white;
    padding:6px 12px;
    border-radius:4px;
    text-decoration:none;
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

<div class="cards">

    <div class="card total">
        <h2><?php echo $total; ?></h2>
        <p>Total Appointments</p>
    </div>

    <div class="card pending">
        <h2><?php echo $pending; ?></h2>
        <p>Pending</p>
    </div>

    <div class="card approved">
        <h2><?php echo $approved; ?></h2>
        <p>Approved</p>
    </div>

    <div class="card rejected">
        <h2><?php echo $rejected; ?></h2>
        <p>Rejected</p>
    </div>

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
    <th>Status</th>
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
        <td>".$row['status']."</td>
       

        <td>

            <a class='edit' href='update_appointment.php?id=".$row['id']."'> Edit </a> 
            <a class='delete' href='cancle.php?id=".$row['id']."'onclick='return confirm(\"Are you sure?\")'>Delete</a>
            <a class='approve' href='change_status.php?id=".$row['id']."&status=Approved'>Approve</a>
            <a class='reject' href='change_status.php?id=".$row['id']."&status=Rejected'>Reject</a>
        </td>

        </tr>";
    }
                                                                                                               
}else{

    echo "<tr>
            <td colspan='11'>No Appointments Found</td>
          </tr>";
}

?>

</table>
</body>
</html>


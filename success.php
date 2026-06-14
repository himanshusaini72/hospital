<?php
$status = isset($_GET['status']) ? $_GET['status'] : 'success';
$appointment_id = isset($_GET['id']) ? $_GET['id'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Appointment Status</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0ea5e9,#0f172a);
}

.card{
    width:450px;
    background:#fff;
    padding:40px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 15px 40px rgba(0,0,0,.2);
}

.icon{
    width:100px;
    height:100px;
    margin:auto;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:45px;
    color:white;
}

.success{
    background:#22c55e;
}

.error{
    background:#ef4444;
}

.cancel{
    background:#f59e0b;
}

h1{
    margin-top:20px;
    color:#0f172a;
}

p{
    margin-top:15px;
    color:#64748b;
    line-height:1.7;
}

.btn{
    display:inline-block;
    margin-top:25px;
    padding:14px 30px;
    background:#0ea5e9;
    color:white;
    text-decoration:none;
    border-radius:50px;
    font-weight:600;
}

.btn:hover{
    opacity:.9;
}

</style>
</head>

<body>

<div class="card">

<?php if($status == "success"){ ?>

    <div class="icon success">✓</div>

    <h1>Appointment Booked</h1>

    <h2 style="margin-top:20px;color:#0ea5e9;">
            Appointment ID: APT-<?php echo 1000 + $appointment_id; ?>
            <p style = "color: red; font-size: 20px">NOTE: Please remember your appointment id. </p>
    </h2>

<?php } elseif($status == "cancelled"){ ?>

    <div class="icon cancel">!</div>

    <h1>Appointment Cancelled</h1>

    <p>
        Your appointment has been cancelled successfully.
    </p>

<?php } else { ?>

    <div class="icon error">✕</div>

    <h1>No Appointment Found</h1>

    <p>
        Sorry, we could not find any appointment details.
    </p>

<?php } ?>

    <a href="index.html" class="btn">
        Back To Home
    </a>

    <a href="view_my_appointment.html" class="btn">
        View Appointment
    </a>

</div>

</body>
</html>
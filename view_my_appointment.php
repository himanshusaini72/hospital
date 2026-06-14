<?php

$conn = mysqli_connect("localhost","root","","hospital_db");

$phone = $_POST['phone'];

$sql = "SELECT * FROM appointments WHERE phone='$phone' ORDER BY id DESC";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Appointment</title>

    <style>

        *{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:linear-gradient(135deg,#e0f2fe,#f8fafc);
    min-height:100vh;
    padding:40px 20px;
}

.container{
    max-width:1000px;
    margin:auto;
}

h2{
    text-align:center;
    margin-bottom:35px;
    color:#0f172a;
    font-size:38px;
    font-weight:700;
}

.card{
    background:#fff;
    border-radius:20px;
    padding:30px;
    margin-bottom:25px;
    box-shadow:0 15px 35px rgba(0,0,0,.08);
    transition:.3s;
    border-left:6px solid #0ea5e9;
}

.card:hover{
    transform:translateY(-5px);
    box-shadow:0 20px 45px rgba(0,0,0,.12);
}

.card p{
    margin-bottom:12px;
    font-size:16px;
    color:#475569;
    line-height:1.7;
}

.card strong{
    color:#0f172a;
    min-width:120px;
    display:inline-block;
}

.btn-group{
    display:flex;
    gap:15px;
    margin-top:20px;
    flex-wrap:wrap;
}

.update-btn{
    display:inline-block;
    text-decoration:none;
    background:#0ea5e9;
    color:#fff;
    padding:12px 20px;
    border-radius:10px;
    font-weight:600;
    transition:.3s;
}

.update-btn:hover{
    background:#0284c7;
}

.cancel-btn{
    display:inline-block;
    text-decoration:none;
    background:#ef4444;
    color:#fff;
    padding:12px 20px;
    border-radius:10px;
    font-weight:600;
    transition:.3s;
}

.cancel-btn:hover{
    background:#dc2626;
}

.no-data{
    text-align:center;
    background:white;
    padding:30px;
    border-radius:15px;
    color:#ef4444;
    font-size:22px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

@media(max-width:768px){

    h2{
        font-size:28px;
    }

    .card{
        padding:20px;
    }

    .card strong{
        display:block;
        margin-bottom:4px;
    }

    .btn-group{
        flex-direction:column;
    }

    .update-btn,
    .cancel-btn{
        text-align:center;
    }
}

    </style>

</head>
<body>

<div class="container">

<h2>My Appointments</h2>

<?php

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

?>

<div class="card">

    <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
    
    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>

    <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>   
    
    <p><strong>Address:</strong> <?php echo $row['address']; ?></p> 

    <p><strong>Doctor:</strong> <?php echo $row['doctor']; ?></p>

    <p><strong>Age:</strong> <?php echo $row['age']; ?></p> 

    <p><strong>Date:</strong> <?php echo $row['appointment_date']; ?></p>

    <p><strong>Time:</strong> <?php echo $row['appointment_time']; ?></p>

    <p><strong>Reason:</strong> <?php echo $row['reason']; ?></p>

    <a href="update_appointment.php?id=<?php echo $row['id']; ?>">
    <button style="
        background:#007bff;
        color:white;
        border:none;
        padding:10px 15px;
        border-radius:5px;
        cursor:pointer;">
        Update Appointment
    </button>
    <a href="cancel.php?id=<?php echo $row['id']; ?>"
   onclick="return confirm('Are you sure you want to cancel this appointment?');"
   class="cancel-btn">
   Cancel Appointment
</a>
</a>

</div>



<?php

    }

}else{

    echo "<h3 style='text-align:center;color:red;'>No Appointment Found</h3>";

}

?>

</div>

</body>
</html>
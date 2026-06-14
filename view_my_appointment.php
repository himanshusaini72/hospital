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

        body{
            font-family:Arial;
            background:#f4f6f9;
            padding:40px;
        }

        .container{
            max-width:800px;
            margin:auto;
        }

        .card{
            background:white;
            padding:20px;
            margin-bottom:20px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

        h2{
            text-align:center;
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
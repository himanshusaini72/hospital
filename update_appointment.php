<?php

include 'config.php';
if(!isset($_GET['id'])){

    die("Invalid Appointment ID");

}

$id = intval($_GET['id']);
$sql = "SELECT * FROM appointments WHERE id='$id'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)==0){

    die("Appointment Not Found");

}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Appointment</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
            padding:30px;
        }

        .container{
            width:100%;
            max-width:750px;
            background:#fff;
            padding:40px;
            border-radius:25px;
            box-shadow:0 20px 50px rgba(0,0,0,.25);
        }

        h2{
            text-align:center;
            margin-bottom:30px;
            color:#0f172a;
            font-size:32px;
            font-weight:700;
        }

        .form-group{
            margin-bottom:20px;
        }

        label{
            display:block;
            margin-bottom:8px;
            font-weight:600;
            color:#334155;
        }

        input{
            width:100%;
            padding:14px;
            border:2px solid #e2e8f0;
            border-radius:12px;
            outline:none;
            font-size:15px;
            transition:.3s;
        }

        input:focus{
            border-color:#0ea5e9;
            box-shadow:0 0 10px rgba(14,165,233,.25);
        }

        .update-btn{
            width:100%;
            padding:15px;
            border:none;
            border-radius:12px;
            background:#0ea5e9;
            color:white;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:.3s;
            margin-top:10px;
        }

        .update-btn:hover{
            background:#0284c7;
            transform:translateY(-2px);
        }

        .back-btn{
            display:block;
            width:100%;
            text-align:center;
            text-decoration:none;
            margin-top:15px;
            padding:15px;
            border-radius:12px;
            background:#0f172a;
            color:white;
            font-weight:600;
            transition:.3s;
        }

        .back-btn:hover{
            background:#1e293b;
        }

        @media(max-width:768px){

            .container{
                padding:25px;
            }

            h2{
                font-size:26px;
            }

        }

    </style>

</head>

<body>

    <div class="container">

        <h2>Update Appointment</h2>

        <form action="update_process.php" method="POST">

            <input type="hidden"
                   name="id"
                   value="<?php echo $row['id']; ?>">

            <div class="form-group">
                <label>Name</label>
                <input type="text"
                       name="name"
                       value="<?php echo $row['name']; ?>"
                       required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email"
                       name="email"
                       value="<?php echo $row['email']; ?>"
                       required>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text"
                       name="phone"
                       value="<?php echo $row['phone']; ?>"
                       required>
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text"
                       name="address"
                       value="<?php echo $row['address']; ?>"
                       required>
            </div>

            <?php
            
            $doctorName = "";
            
            if(!empty($row['doctor_id'])){
                $getDoctor = mysqli_query(
                    $conn,
                    "SELECT doctor_name FROM doctors WHERE id='".$row['doctor_id']."'");
                    
                    
                    if(mysqli_num_rows($getDoctor)>0){
                        $doctorData = mysqli_fetch_assoc($getDoctor);
                        $doctorName = $doctorData['doctor_name'];
                    }
                        
                    }else{
                            
                    // old appointments ke liye

                    $doctorName = $row['doctor'];
                    }
                ?>
                    
                <div class="form-group">
                    <label>Doctor</label>
                        
                    <input type="text" value="<?php echo $doctorName; ?>" readonly>
                    <input type="hidden" name="doctor_id" value="<?php echo $row['doctor_id']; ?>">
                </div>


            <div class="form-group">
                <label>Age</label>
                <input type="number"
                       name="age"
                       value="<?php echo $row['age']; ?>"
                       required>
            </div>

            <div class="form-group">
                <label>Appointment Date</label>
                <input type="date"
                       name="appointment_date"
                       value="<?php echo $row['appointment_date']; ?>"
                       required>
            </div>

            <div class="form-group">
                <label>Appointment Time</label>
                <input type="text"
                       name="appointment_time"
                       value="<?php echo $row['appointment_time']; ?>"
                       required>
            </div>

            <div class="form-group">
                <label>Reason</label>
                <input type="text"
                       name="reason"
                       value="<?php echo $row['reason']; ?>"
                       required>
            </div>

            <button type="submit" class="update-btn">
                Update Appointment
            </button>

        </form>

        <a href="view_my_appointment.html" class="back-btn">
            Back
        </a>

    </div>

</body>
</html>
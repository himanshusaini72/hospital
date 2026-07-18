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
   FETCH SCHEDULE
=========================== */

$getSchedule = mysqli_query($conn,
"SELECT * FROM doctor_schedule WHERE id='$id'");

if(mysqli_num_rows($getSchedule)==0){

    header("Location: manage_schedule.php");
    exit();

}

$schedule = mysqli_fetch_assoc($getSchedule);

/* ===========================
   FETCH ACTIVE DOCTORS
=========================== */

$doctorQuery = mysqli_query($conn,
"SELECT * FROM doctors
 WHERE status='Active'
 ORDER BY doctor_name ASC");

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Edit Schedule</title>

<link rel="stylesheet" href="admin_style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<div class="container">

<div class="header">

<h1>

<i class="fa-solid fa-pen-to-square"></i>

Edit Doctor Schedule

</h1>

<div>

<a href="manage_schedule.php"
class="back-btn">

<i class="fa-solid fa-arrow-left"></i>

Back

</a>

</div>

</div>

<div class="form-container">

<form method="POST">

<div class="form-group">

<label>Select Doctor</label>

<select name="doctor_id" required>

<?php

while($doctor = mysqli_fetch_assoc($doctorQuery)){

?>

<option
value="<?php echo $doctor['id']; ?>"

<?php

if($doctor['id']==$schedule['doctor_id']){

echo "selected";

}

?>

>

<?php echo $doctor['doctor_name']; ?>

</option>

<?php

}

?>

</select>

</div>

<div class="form-group">

<label>Day</label>

<select name="day" required>

<?php

$days = [
"Monday",
"Tuesday",
"Wednesday",
"Thursday",
"Friday",
"Saturday",
"Sunday"
];

foreach($days as $day){

?>

<option
value="<?php echo $day; ?>"

<?php

if($schedule['day']==$day){

echo "selected";

}

?>

>

<?php echo $day; ?>

</option>

<?php

}

?>

</select>

</div>

<div class="form-group">

<label>Start Time</label>

<input
type="time"
name="start_time"
value="<?php echo $schedule['start_time']; ?>"
required>

</div>

<div class="form-group">

<label>End Time</label>

<input
type="time"
name="end_time"
value="<?php echo $schedule['end_time']; ?>"
required>

</div>

<div class="form-group">

<label>Slot Duration</label>

<select name="slot_duration">

<?php

$slots = [15,20,30,45,60];

foreach($slots as $slot){

?>

<option
value="<?php echo $slot; ?>"

<?php

if($schedule['slot_duration']==$slot){

echo "selected";

}

?>

>

<?php echo $slot; ?> Minutes

</option>

<?php

}

?>

</select>

</div>

<div class="form-group">

<label>Status</label>

<select name="status">

<option
value="Active"

<?php

if($schedule['status']=="Active"){

echo "selected";

}

?>

>

Active

</option>

<option
value="Inactive"

<?php

if($schedule['status']=="Inactive"){

echo "selected";

}

?>

>

Inactive

</option>

</select>

</div>

<div class="form-group">

<button
type="submit"
name="update_schedule"
class="add-btn">

<i class="fa-solid fa-floppy-disk"></i>

Update Schedule

</button>

</div>

<?php

if(isset($_POST['update_schedule'])){

    $doctor_id = mysqli_real_escape_string($conn,$_POST['doctor_id']);
    $day = mysqli_real_escape_string($conn,$_POST['day']);
    $start_time = mysqli_real_escape_string($conn,$_POST['start_time']);
    $end_time = mysqli_real_escape_string($conn,$_POST['end_time']);
    $slot_duration = mysqli_real_escape_string($conn,$_POST['slot_duration']);
    $status = mysqli_real_escape_string($conn,$_POST['status']);

    /* ===========================
       VALIDATION
    =========================== */

    if($start_time >= $end_time){

        echo "<script>
                alert('End Time must be greater than Start Time');
              </script>";

    }else{

        /* Duplicate Schedule Check */

        $check = mysqli_query($conn,

        "SELECT * FROM doctor_schedule

        WHERE doctor_id='$doctor_id'

        AND day='$day'

        AND id!='$id'");

        if(mysqli_num_rows($check) > 0){

            echo "<script>

                    alert('Schedule already exists for this doctor on $day');

                  </script>";

        }else{

            $update = "UPDATE doctor_schedule SET

                doctor_id='$doctor_id',

                day='$day',

                start_time='$start_time',

                end_time='$end_time',

                slot_duration='$slot_duration',

                status='$status'

                WHERE id='$id'";

            if(mysqli_query($conn,$update)){

                echo "<script>

                        alert('Schedule Updated Successfully');

                        window.location='manage_schedule.php';

                      </script>";

            }else{

                echo "<script>

                        alert('".mysqli_error($conn)."');

                      </script>";

            }

        }

    }

}

?>

</form>

</div>

</div>

</body>

</html>
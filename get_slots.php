<?php

include 'config.php';

/* ===========================
   CHECK REQUEST
=========================== */

if(
    !isset($_GET['doctor_id']) ||
    !isset($_GET['appointment_date'])
){
    exit();
}

$doctor_id = (int)$_GET['doctor_id'];

$appointment_date = mysqli_real_escape_string(
$conn,
$_GET['appointment_date']
);

/* ===========================
   GET DAY NAME
=========================== */

$day = date(
"l",
strtotime($appointment_date)
);

/* ===========================
   FETCH DOCTOR SCHEDULE
=========================== */

$scheduleQuery = mysqli_query(

$conn,

"SELECT *

FROM doctor_schedule

WHERE doctor_id='$doctor_id'

AND day='$day'

AND status='Active'"

);

if(mysqli_num_rows($scheduleQuery)==0){

    echo "<option value=''>No Schedule Available</option>";

    exit();

}

$schedule = mysqli_fetch_assoc($scheduleQuery);

$start_time = $schedule['start_time'];

$end_time = $schedule['end_time'];

$slot_duration = $schedule['slot_duration'];

/* ===========================
   FETCH BOOKED SLOTS
=========================== */

$bookedSlots = [];

$getBooked = mysqli_query(

$conn,

"SELECT appointment_time

FROM appointments

WHERE doctor_id='$doctor_id'

AND appointment_date='$appointment_date'

"

);

while($row = mysqli_fetch_assoc($getBooked)){

    $bookedSlots[] = $row['appointment_time'];

}

/* ===========================
   GENERATE TIME SLOTS
=========================== */

echo "<option value=''>Select Time Slot</option>";

$start = strtotime($start_time);
$end = strtotime($end_time);

while($start < $end){

    $slot = date("H:i", $start);

    if(in_array($slot, $bookedSlots)){

        echo "<option value='$slot' disabled>";

        echo date("h:i A", strtotime($slot));

        echo " (Booked)</option>";

    }else{

        echo "<option value='$slot'>";

        echo date("h:i A", strtotime($slot));

        echo "</option>";

    }

    $start = strtotime("+$slot_duration minutes", $start);

}

?>
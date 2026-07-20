<?php
session_start();
include 'config.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Doctor Schedule</title>
        <link rel="stylesheet" href="admin_style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>
                    <i class="fa-solid fa-calendar-plus"></i>
                    Add Doctor Schedule
                </h1>
                <div>
                    <a href="manage_schedule.php" class="back-btn">
                        Manage Schedule
                    </a>
                </div>
            </div>
            <div class="form-container">
                <form method="POST">
                    <div class="form-group">
                        <label>Select Doctor:</label>
                        <select name="doctor_id" required>
                            <option value="">Choose Doctor</option>
                            <?php
                            while($doctor = mysqli_fetch_assoc($doctorQuery)){
                                ?>
                                <option value="<?php echo $doctor['id']; ?>">
                                    <?php echo $doctor['doctor_name']; ?>
                                </option>
                                <?php
                                }
                                ?>
                                </select>
                            </div> <br>
                            
                            <div class="form-group">
                                <label>Day:</label> 
                                <select name="day" required>
                                    <option value="">Select Day</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div><br>

                            <div class="form-group">
                                <label>Start Time:</label>
                                <input type="time" name="start_time" required> 
                            </div> <br>

                            <div class="form-group">
                                <label>End Time:</label>
                                <input type="time" name="end_time" required>
                            </div> <br>

                            <div class="form-group">
                                <label>Slot Duration (Minutes)</label>
                                <select name="slot_duration" required>
                                    <option value="15">15 Minutes</option>
                                    <option value="20">20 Minutes</option>
                                    <option value="30" selected>30 Minutes</option>
                                    <option value="45">45 Minutes</option>
                                    <option value="60">60 Minutes</option>
                                </select>
                            </div> <br>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div> <br>

                            <div class="form-group">
                                <button type="submit" name="save_schedule" class="add-btn">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    Save Schedule
                                </button>
                            </div>

                            <?php
                            if(isset($_POST['save_schedule'])){
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
                                        
                                    /* Check Duplicate Schedule */
                                    
                                    $check = mysqli_query($conn,
                                    "SELECT * FROM doctor_schedule WHERE doctor_id='$doctor_id' AND day='$day'");
                                    
                                    if(mysqli_num_rows($check) > 0){
                                        echo "<script>
                                        alert('Schedule already exists for this doctor on $day');
                                        </script>";
                                        }else{
                                            $insert = "INSERT INTO doctor_schedule
                                            (doctor_id,day,start_time,end_time,slot_duration,status)
                                            
                                            VALUES ('$doctor_id', '$day', '$start_time', '$end_time', '$slot_duration', '$status')";
                                            
                                            if(mysqli_query($conn,$insert)){
                                                echo "<script>
                                                alert('Schedule Added Successfully');
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
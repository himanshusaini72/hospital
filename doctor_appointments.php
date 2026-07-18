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
   CHECK DOCTOR ID
=========================== */

if(!isset($_GET['id']) || $_GET['id']==""){
    header("Location: manage_doctors.php");
    exit();
}

$id = (int)$_GET['id'];

/* ===========================
   FETCH DOCTOR
=========================== */

$getDoctor = mysqli_query(
$conn,
"SELECT * FROM doctors WHERE id='$id'"
);

if(mysqli_num_rows($getDoctor)==0){

    header("Location: manage_doctors.php");
    exit();

}

$doctor = mysqli_fetch_assoc($getDoctor);

$doctorName = $doctor['doctor_name'];

/* ===========================
   TOTAL APPOINTMENTS
=========================== */

$totalQuery = mysqli_query(
$conn,
"SELECT COUNT(*) AS total
 FROM appointments
 WHERE doctor='$doctorName'"
);

$totalAppointments = mysqli_fetch_assoc($totalQuery)['total'];

/* ===========================
   FETCH APPOINTMENTS
=========================== */

$result = mysqli_query(
$conn,
"SELECT * FROM appointments
 WHERE doctor='$doctorName'
 ORDER BY appointment_date DESC,
 appointment_time ASC"
);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Doctor Appointments</title>
        <link rel="stylesheet" href="admin_style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>
                    <i class="fa-solid fa-calendar-check"></i>
                    Doctor Appointments
                </h1>
                <div>
                    <a href="manage_doctors.php"
                    class="back-btn">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back
                </a>
            </div>
        </div>
        <div class="cards">
            <div class="card total">
                <h2><?php echo $totalAppointments; ?></h2>
                <p>Total Appointments</p>
            </div>
            <div class="card active">
                <h2><?php echo $doctorName; ?></h2>
                <p>Doctor Name</p>
            </div>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Phone</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>         
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['appointment_date']; ?></td>
                <td><?php echo $row['appointment_time']; ?></td>
                <td>
                    <?php
                    if($row['status']=="Pending"){
                        echo "<span class='status pending-status'>Pending</span>";
                        }elseif($row['status']=="Approved"){
                            echo "<span class='status active-status'>Approved</span>";
                            }else{
                                echo "<span class='status inactive-status'>Rejected</span>";
                                }
                    ?>
                    </td>
                    <td>
                        <a href="update_appointment.php?id=<?php echo $row['id']; ?>" class="edit-btn">
                            <i class="fa-solid fa-pen"></i>
                            Edit
                        </a>
                        <a href="cancle.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this appointment?');">
                            <i class="fa-solid fa-trash"></i>
                            Delete
                        </a>
                    </td>
            </tr>
                <?php
                    }}else{
                ?>
                <tr>
                    <td colspan="7">
                        No Appointments Found For This Doctor
                    </td>
                </tr>
                <?php
                }
                ?>
        </table>
    </div>
</body>
</html>
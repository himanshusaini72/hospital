<?php
session_start();
include 'config.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

/* ===========================
   GET DOCTOR ID
=========================== */

if(!isset($_GET['id']) || $_GET['id']==""){
    header("Location: manage_doctors.php");
    exit();
}

$id = (int)$_GET['id'];

/* ===========================
   FETCH DOCTOR
=========================== */

$getDoctor = mysqli_query($conn,
"SELECT * FROM doctors WHERE id='$id'");

if(mysqli_num_rows($getDoctor)==0){

    header("Location: manage_doctors.php");
    exit();

}

$row = mysqli_fetch_assoc($getDoctor);

$message = "";

/* ===========================
   UPDATE DOCTOR
=========================== */

if(isset($_POST['update_doctor'])){

    $doctor_name   = mysqli_real_escape_string($conn,trim($_POST['doctor_name']));
    $specialization = mysqli_real_escape_string($conn,trim($_POST['specialization']));
    $experience    = mysqli_real_escape_string($conn,trim($_POST['experience']));
    $fees          = mysqli_real_escape_string($conn,trim($_POST['fees']));
    $phone         = mysqli_real_escape_string($conn,trim($_POST['phone']));
    $email         = mysqli_real_escape_string($conn,trim($_POST['email']));
    $status        = mysqli_real_escape_string($conn,$_POST['status']);

    if(
        $doctor_name=="" ||
        $specialization=="" ||
        $experience=="" ||
        $fees=="" ||
        $phone=="" ||
        $email==""
    ){

        $message = "<div class='error'>
                    Please fill all fields.
                    </div>";

    }else{

        $check = mysqli_query($conn,
        "SELECT * FROM doctors
         WHERE (email='$email' OR phone='$phone')
         AND id!='$id'");

        if(mysqli_num_rows($check)>0){

            $message = "<div class='error'>
                        Email or Phone already exists.
                        </div>";

        }else{

            $sql = "UPDATE doctors SET

                    doctor_name='$doctor_name',
                    specialization='$specialization',
                    experience='$experience',
                    fees='$fees',
                    phone='$phone',
                    email='$email',
                    status='$status'

                    WHERE id='$id'";

            if(mysqli_query($conn,$sql)){

                header("Location: manage_doctors.php?updated=1");
                exit();

            }else{

                $message = "<div class='error'>".
                           mysqli_error($conn).
                           "</div>";

            }

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Doctor</title>
        <link rel="stylesheet" href="admin_style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>
                    <i class="fa-solid fa-user-pen"></i>
                    Edit Doctor
                </h1>
                <div>
                    <a href="manage_doctors.php" class="back-btn">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <?php echo $message; ?>
            <div class="form-box">
                <form method="POST">
                    <div class="row">
                        <div class="input-group">
                            <label>Doctor Name</label>
                            <input type="text" name="doctor_name" value="<?php echo $row['doctor_name']; ?>" required>
                        </div>
                        <div class="input-group"> 
                            <label>Specialization</label>
                            <input type="text" name="specialization" value="<?php echo $row['specialization']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label>Experience</label>
                            <input type="number" name="experience" value="<?php echo $row['experience']; ?>" required>
                        </div>
                        <div class="input-group">
                            <label>Consultation Fees</label>
                            <input type="number" name="fees" value="<?php echo $row['fees']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>
                        </div>
                        <div class="input-group">
                            <label>Email Address</label>
                            <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label>Status</label>
                            <select name="status" required>
                                <option value="Active"
                                <?php
                                if($row['status']=="Active"){
                                    echo "selected";
                                    }
                                    ?>>
                                    Active
                                </option>
                                <option value="Inactive"
                                <?php
                                if($row['status']=="Inactive"){
                                    echo "selected";
                                    }
                                    ?>>
                                    Inactive
                                </option>
                            </select>
                        </div>
                        <div class="input-group">

                        </div>
                    </div>
                    <div class="button-group">
                        <button type="submit" name="update_doctor" class="save-btn">
                            <i class="fa-solid fa-floppy-disk"></i>
                                Update Doctor
                        </button>
                        <a href="manage_doctors.php" class="cancel-btn">
                            <i class="fa-solid fa-arrow-left"></i>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
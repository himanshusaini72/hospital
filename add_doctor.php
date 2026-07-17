<?php
session_start();
include 'config.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

$message = "";

if(isset($_POST['save_doctor'])){

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

    }
    else{

        $check = mysqli_query($conn,
        "SELECT * FROM doctors
         WHERE email='$email'
         OR phone='$phone'");

        if(mysqli_num_rows($check)>0){

            $message = "<div class='error'>
                            Doctor already exists.
                        </div>";

        }else{

            $sql = "INSERT INTO doctors
            (
                doctor_name,
                specialization,
                experience,
                fees,
                phone,
                email,
                status
            )

            VALUES
            (
                '$doctor_name',
                '$specialization',
                '$experience',
                '$fees',
                '$phone',
                '$email',
                '$status'
            )";

            if(mysqli_query($conn,$sql)){

                header("Location: manage_doctors.php?success=1");
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
            <title>Add Doctor</title>
            <link rel="stylesheet" href="admin_style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>
                        <i class="fa-solid fa-user-doctor"></i>
                        Add Doctor
                    </h1>
                    <div>
                        <a href="manage_doctors.php" class="back-btn">
                            <i class="fa-solid fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <?php
                echo $message;
                ?>
                <div class="form-box">
                    <form method="POST">
                        <div class="row">
                            <div class="input-group">
                                <label>Doctor Name</label>
                                <input type="text" name="doctor_name" placeholder="Enter Doctor Name" required>
                            </div>
                            <div class="input-group">
                                <label>Specialization</label>
                                <input type="text" name="specialization" placeholder="Enter Specialization" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group">
                                <label>Experience (Years)</label>
                                <input type="number" name="experience" placeholder="Experience" required>
                            </div>
                            <div class="input-group">
                                <label>Consultation Fees</label>
                                <input type="number" name="fees" placeholder="Fees" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone" placeholder="Enter Phone Number" required>
                            </div>
                            <div class="input-group">
                                <label>Email Address</label>
                                <input type="email" name="email" placeholder="Enter Email Address" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group">
                                <label>Status</label>
                                <select name="status" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="input-group">
                                
                            </div>
                        </div>
                        <div class="button-group">
                            <button type="submit" name="save_doctor" class="save-btn">
                                <i class="fa-solid fa-floppy-disk"></i>
                                Save Doctor
                            </button>
                            <a href="manage_doctors.php" class="cancel-btn">
                                <i class="fa-solid fa-xmark"></i>
                                cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </body>
    </html>
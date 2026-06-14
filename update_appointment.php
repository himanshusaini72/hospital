<?php

include 'config.php';

$id = $_GET['id'];

$sql = "SELECT * FROM appointments WHERE id=$id";

$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
<title>Update Appointment</title>
</head>
<body>

<h2>Update Appointment</h2>

<form action="update_process.php" method="POST">

<input type="hidden" name="id"
value="<?php echo $row['id']; ?>">

<label>Name</label>
<input type="text" name="name"
value="<?php echo $row['name']; ?>" required>

<br><br>

<label>Email</label>
<input type="text" name="email"
value="<?php echo $row['email']; ?>" required>

<br><br>

<label>Phone</label>
<input type="text" name="phone"
value="<?php echo $row['phone']; ?>" required>

<br><br>

<label>Address</label>
<input type="text" name="address"
value="<?php echo $row['address']; ?>" required>

<br><br>

<label>Doctor</label>
<input type="text" name="doctor"
value="<?php echo $row['doctor']; ?>" required>

<br><br>

<label>Age</label>
<input type="number" name="age"
value="<?php echo $row['age']; ?>" required>

<br><br>

<label>Date</label>
<input type="date"
name="appointment_date"
value="<?php echo $row['appointment_date']; ?>" required>

<br><br>

<label>Time</label>
<input type="text"
name="appointment_time"
value="<?php echo $row['appointment_time']; ?>" required>

<br><br>

<label>Reason</label>
<input type="text" name="reason"
value="<?php echo $row['reason']; ?>" required>

<br><br>

<button type="submit">Update Appointment</button>

</form>

</body>
</html>
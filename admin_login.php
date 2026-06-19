<?php
session_start();

if(isset($_SESSION['admin'])){
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0ea5e9,#1e293b);
}

.login-box{
    width:400px;
    background:#fff;
    padding:35px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.login-box h2{
    text-align:center;
    margin-bottom:25px;
    color:#0f172a;
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
}

.form-group input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
}

.btn{
    width:100%;
    padding:12px;
    border:none;
    background:#0ea5e9;
    color:white;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
}

.btn:hover{
    background:#0284c7;
}

.error{
    color:red;
    text-align:center;
    margin-bottom:15px;
}

</style>

</head>
<body>

<div class="login-box">

<h2>Admin Login</h2>

<?php
if(isset($_GET['error'])){
    echo "<p class='error'>Invalid Username or Password</p>";
}
?>

<form action="admin_login_process.php" method="POST">

<div class="form-group">
<label>Username</label>
<input type="text" name="username" required>
</div>

<div class="form-group">
<label>Password</label>
<input type="password" name="password" required>
</div>

<button type="submit" class="btn">
Login
</button>

</form>

</div>

</body>
</html>
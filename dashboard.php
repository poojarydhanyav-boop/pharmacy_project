<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<style>
body {
    margin: 0;
    font-family: Arial;
}

.sidebar {
    width: 220px;
    height: 100vh;
    background: #6a0dad; /* purple */
    position: fixed;
}

.sidebar h2 {
    color: white;
    text-align: center;
    padding: 15px;
}

.sidebar a {
    display: block;
    color: white;
    padding: 12px;
    text-decoration: none;
}

.sidebar a:hover {
    background: #4b0082;
}
.main {
    margin-left: 220px;
    padding: 20px;
    height: 100vh;

    background-image: url('image/w3.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.topbar {
    background: #f2f2f2;
    padding: 10px;
    border-radius: 5px;
}
</style>

</head>

<body>

<div class="sidebar">
   <div style="text-align:center; padding: 15px;">
    <img src="image/logo.png" width="80" style="border-radius:50%;">
    <h3 style="color:white;">Pharmacy</h3>
</div>
    <a href="dashboard.php">Dashboard</a>
    <a href="medicine.php">Medicine Management</a>
       <a href="sales.php">Sales & Billing</a>
    <a href="report.php">Reports</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">
    <div class="topbar">
        <h1 style="font-size:28px; font-weight:bold; color:#333;">
    Welcome <?php echo $_SESSION['user']; ?>
</h1>
    </div>

    <h2>Dashboard</h2>
    <p>A digital solution developed to simplify pharmacy operations by <br>
providing tools for inventory control,sales managemt,billing,analytical reporting</p>
</div>

</body>
</html>
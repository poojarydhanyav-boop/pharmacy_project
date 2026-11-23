<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pharmacy_db");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM medicines WHERE id=$id");
$row = $result->fetch_assoc();

if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = $_POST['quantity'];

    $conn->query("UPDATE medicines 
                  SET name='$name', price='$price', quantity='$qty' 
                  WHERE id=$id");

    header("Location: medicine.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Medicine</title>

<style>
body {
    margin: 0;
    font-family: Arial;
    background: url('image/w3.jpg') no-repeat center center fixed;
    background-size: cover;
}

body::before {
    content: "";
    position: fixed;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.8);
    top: 0;
    left: 0;
    z-index: -1;
}

/* Sidebar */
.sidebar {
    width: 220px;
    height: 100vh;
    background: #6a0dad;
    position: fixed;
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

/* Main */
.main {
    margin-left: 220px;
    padding: 30px;
}

/* Card */
.edit-card {
    background: white;
    width: 450px;
    margin: 60px auto;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0px 0px 12px rgba(0,0,0,0.2);
}

.edit-card h2 {
    text-align: center;
    color: purple;
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    display: block;
    margin-top: 10px;
}

input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 12px;
    background: purple;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
}

button:hover {
    background: #4b0082;
}

.back-btn {
    display: block;
    text-align: center;
    margin-top: 15px;
    text-decoration: none;
    color: purple;
    font-weight: bold;
}
</style>

</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <div style="text-align:center; padding:15px;">
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

<div class="edit-card">

<h2>Edit Medicine</h2>

<form method="POST">

    <label>Medicine Name:</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

    <label>Price:</label>
    <input type="number" name="price" value="<?php echo $row['price']; ?>" required>

    <label>Quantity:</label>
    <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" required>

    <button type="submit" name="update">Update Medicine</button>

</form>

<a href="medicine.php" class="back-btn">← Back to Medicine Page</a>

</div>

</div>

</body>
</html>
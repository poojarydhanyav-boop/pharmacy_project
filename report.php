<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pharmacy_db");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

/* ===== TOTAL SALES ===== */
$total_sales = 0;
$sales_result = $conn->query("SELECT SUM(total) AS grand_total FROM sales");
if($sales_result->num_rows > 0) {
    $sales_row = $sales_result->fetch_assoc();
    $total_sales = $sales_row['grand_total'];
}

/* ===== TOTAL MEDICINES ===== */
$total_medicines = 0;
$med_result = $conn->query("SELECT COUNT(*) AS total_meds FROM medicines");
$med_row = $med_result->fetch_assoc();
$total_medicines = $med_row['total_meds'];

/* ===== LOW STOCK ===== */
$low_stock = $conn->query("SELECT * FROM medicines WHERE quantity < 10");

/* ===== EXPIRED MEDICINES ===== */
$expired = $conn->query("SELECT * FROM medicines WHERE expiry_date < CURDATE()");
?>

<!DOCTYPE html>
<html>
<head>
<title>Reports</title>

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

/* Main */
.main {
    margin-left: 220px;
    padding: 20px;
}

/* Cards */
.card-container {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.card {
    background: white;
    padding: 20px;
    width: 250px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
    text-align: center;
}

.card h3 {
    color: purple;
}

/* Table */
.report-box {
    background: white;
    padding: 20px;
    margin-top: 25px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: purple;
    color: white;
    padding: 10px;
}

td {
    padding: 10px;
    text-align: center;
}

tr:nth-child(even) {
    background: #f2f2f2;
}

.print-btn {
    margin-top: 20px;
    padding: 10px 20px;
    background: purple;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.print-btn:hover {
    background: #4b0082;
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
<h1 style="color:purple;">Pharmacy Reports</h1>
<div class="card-container">

    <div class="card">
        <h3>Total Sales</h3>
        <h2>₹<?php echo $total_sales ? $total_sales : 0; ?></h2>
    </div>

    <div class="card">
        <h3>Total Medicines</h3>
        <h2><?php echo $total_medicines; ?></h2>
    </div>

    <div class="card">
        <h3>Low Stock Medicines</h3>
        <h2><?php echo $low_stock->num_rows; ?></h2>
    </div>

    <div class="card">
        <h3>Expired Medicines</h3>
        <h2><?php echo $expired->num_rows; ?></h2>
    </div>

</div>
<div class="report-box">
<h2 style="color:purple;">Low Stock Medicines (Below 10)</h2>
<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Quantity</th>
</tr>

<?php
$low_stock = $conn->query("SELECT * FROM medicines WHERE quantity < 10");

while($row = $low_stock->fetch_assoc()) {
    echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['name']."</td>
            <td>".$row['quantity']."</td>
          </tr>";
}
?>
</table>
</div>
<div class="report-box">
<h2 style="color:purple;">Expired Medicines</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Expiry Date</th>
</tr>

<?php
$expired = $conn->query("SELECT * FROM medicines WHERE expiry_date < CURDATE()");

while($row = $expired->fetch_assoc()) {
    echo "<tr style='background:red; color:white;'>
            <td>".$row['id']."</td>
            <td>".$row['name']."</td>
            <td>".$row['expiry_date']."</td>
          </tr>";
}
?>
</table>
</div>
<div class="report-box">
<h2 style="color:purple;">Sales History</h2>

<table border="1">
<tr>
    <th>Bill ID</th>
    <th>Medicine Name</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
</tr>

<?php
$sales = $conn->query("SELECT * FROM sales ORDER BY id DESC");

while($row = $sales->fetch_assoc()) {
    echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['medicine_name']."</td>
            <td>₹".$row['price']."</td>
            <td>".$row['quantity']."</td>
            <td>₹".$row['total']."</td>
          </tr>";
}
?>
</table>

<button class="print-btn" onclick="window.print()">🖨️ Print Report</button>

</div>

</div>

</body>
</html>
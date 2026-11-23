<?php
session_start();

$conn = new mysqli("localhost", "root", "", "pharmacy_db");

if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    if(isset($_POST['name'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $manufacture_date = $_POST['manufacture_date'];
        $expiry_date = $_POST['expiry_date'];

$conn->query("INSERT INTO medicines (name, price, quantity, manufacture_date, expiry_date)
              VALUES ('$name', '$price', '$quantity', '$manufacture_date', '$expiry_date')");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Medicine</title>

<style>
body {
    font-family: Arial;
    background: #f4f6f9;
}
.card {
    background: white;
    padding: 20px;
    margin: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}
table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #6a0dad;
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

.edit-btn {
    background: blue;
    color: white;
    padding: 5px;
    text-decoration: none;
    border-radius: 5px;
}

.delete-btn {
    background: red;
    color: white;
    padding: 5px;
    text-decoration: none;
    border-radius: 5px;
}
</style>

</head>

<body>

<div class="card">
<h2>Medicine Management</h2>

<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>

<form method="POST">
    <input type="text" name="name" placeholder="Medicine Name" required><br><br>
    <input type="number" name="price" placeholder="Price" required><br><br>
    <input type="number" name="quantity" placeholder="Quantity" required><br><br>
    Enter manufacture date:
    <input type="date" name="manufacture_date" placeholder="Manufacture Date" required><br><br>
   Enter Expiry date:
<input type="date" name="expiry_date" placeholder="Expiry Date" required><br><br>
    <button type="submit">Add Medicine</button>
</form>

<?php } ?>

</div>

<div class="card">

<h3>Medicine List</h3>
<form method="GET" style="margin-bottom:15px;">
    <input type="text" name="search" placeholder="Search Medicine"
    value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>">
    <button type="submit">Search</button>
</form>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Manufacture Date</th>
    <th>Expiry Date</th>
<th>Action</th>
</tr>

<?php
if(isset($_GET['search'])) {
    $search = $_GET['search'];
    $result = $conn->query("SELECT * FROM medicines WHERE name LIKE '%$search%'");
} else {
    $result = $conn->query("SELECT * FROM medicines");
}
while($row = $result->fetch_assoc()) {

    if($row['expiry_date'] < date('Y-m-d')) {
        echo "<tr style='background:red; color:white;'>";
    } else {
        echo "<tr>";
    }

    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['price']."</td>";
    echo "<td>".$row['quantity']."</td>";
    echo "<td>".$row['manufacture_date']."</td>";
    echo "<td>".$row['expiry_date']."</td>";

    echo "<td>";

    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        echo "<a href='edit.php?id=".$row['id']."' class='edit-btn'>Edit</a> ";
        echo "<a href='delete.php?id=".$row['id']."' class='delete-btn'>Delete</a>";
    }

    echo "</td></tr>";
}
?>

</table>

</div>

</body>
</html>
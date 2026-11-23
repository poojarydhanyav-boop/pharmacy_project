<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pharmacy_db");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$message = "";
$bill_id = "";

if(isset($_POST['sell'])) {

    $medicine_id = $_POST['medicine'];
    $qty = $_POST['quantity'];

    if($qty <= 0) {
        $message = "❌ Enter valid quantity!";
    } else {

        $res = $conn->query("SELECT * FROM medicines WHERE id='$medicine_id'");
        $row = $res->fetch_assoc();

        $name = $row['name'];
        $price = $row['price'];
        $stock = $row['quantity'];
        $expiry_date = $row['expiry_date'];

        if($expiry_date < date('Y-m-d')) {
            $message = "❌ Medicine is expired!";
        }
        else if($qty > $stock) {
            $message = "❌ Not enough stock!";
        }
        else {
            $total = $price * $qty;

            $conn->query("INSERT INTO sales(medicine_name, price, quantity, total)
                          VALUES('$name', '$price', '$qty', '$total')");

            $bill_id = $conn->insert_id;

            $new_stock = $stock - $qty;
            $conn->query("UPDATE medicines SET quantity='$new_stock' WHERE id='$medicine_id'");

            $message = "✅ Bill Generated!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Sales & Billing</title>

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
    background: rgba(255,255,255,0.7);
    top: 0;
    left: 0;
    z-index: -1;
}

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

.main {
    margin-left: 220px;
    padding: 20px;
}

.billing-card {
    background: white;
    padding: 25px;
    border-radius: 10px;
    width: 500px;
    margin: 50px auto;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}

input, select {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
}

button {
    width: 100%;
    padding: 10px;
    background: purple;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background: #6a0dad;
}

.invoice {
    margin-top: 20px;
    border: 1px solid #ccc;
    padding: 15px;
    border-radius: 10px;
    background: #fafafa;
}

.msg {
    text-align: center;
    font-weight: bold;
    margin-top: 10px;
}
</style>

<script>
function printBill() {
    var billContent = document.querySelector('.invoice').innerHTML;

    var printWindow = window.open('', '', 'width=800,height=600');

    printWindow.document.write(`
        <html>
        <head>
            <title>Pharmacy Bill</title>
            <style>
                body {
                    font-family: Arial;
                    padding: 30px;
                }
                .invoice {
                    border: 2px solid purple;
                    padding: 20px;
                    border-radius: 10px;
                    width: 350px;
                    margin: auto;
                }
                h3 {
                    text-align: center;
                    color: purple;
                }
                p {
                    font-size: 18px;
                }
                button {
                    display: none;
                }
            </style>
        </head>
        <body>
            <div class="invoice">
                ${billContent}
            </div>
        </body>
        </html>
    `);

    printWindow.document.close();
    printWindow.print();
}
</script>

</head>

<body>
<div class="sidebar">
    <h2 style="color:white; text-align:center;">Pharmacy</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="medicine.php">Medicine Management</a>
        <a href="sales.php">Sales & Billing</a>
    <a href="report.php">Reports</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">

<div class="billing-card">

<form method="POST">

<select name="medicine" required>
    <option value="">-- Select Medicine --</option>
    <?php
    $meds = $conn->query("SELECT * FROM medicines");
    while($m = $meds->fetch_assoc()) {
        echo "<option value='".$m['id']."'>".$m['name']."</option>";
    }
    ?>
</select>

<input type="number" name="quantity" placeholder="Enter Quantity" required>

<button type="submit" name="sell">Generate Bill</button>

</form>

<div class="msg"><?php echo $message; ?></div>

<?php if(isset($name) && $message == "✅ Bill Generated!") { ?>

<div class="invoice">
<h3>🧾 Pharmacy Bill</h3>

<p><b>Bill ID:</b> <?php echo $bill_id; ?></p>
<p><b>Medicine:</b> <?php echo $name; ?></p>
<p><b>Price:</b> ₹<?php echo $price; ?></p>
<p><b>Quantity:</b> <?php echo $qty; ?></p>
<p><b>Total:</b> ₹<?php echo $total; ?></p>
<p><b>Date:</b> <?php echo date('Y-m-d'); ?></p>

<button onclick="printBill()">🖨️ Print Bill</button>

</div>

<?php } ?>

</div>

</div>

</body>
</html>
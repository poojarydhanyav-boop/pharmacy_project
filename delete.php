<?php
$conn = new mysqli("localhost", "root", "", "pharmacy_db");

$id = $_GET['id'];

$conn->query("DELETE FROM medicines WHERE id=$id");

header("Location: medicine.php");
?>
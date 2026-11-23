<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pharmacy_db");

if ($conn->connect_error) {
    die("Connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION['user'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        header("Location: dashboard.php");
        exit();

    } else {
        $_SESSION['error'] = "Invalid Username or Password!";
        header("Location: login.php");
        exit();
    }
}
?>
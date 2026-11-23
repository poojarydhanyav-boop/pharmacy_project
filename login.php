<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="image/logo.png">
<title>Login</title>

<style>
body {
    margin: 0;
    font-family: Arial;

       background: url('image/w2.jpg') no-repeat center center fixed;
       background-size:cover;
}

body::before {
    content: "";
    position: fixed;
    width: 100%;
    height: 100%;
        top: 0;
    left: 0;
}

.login-box {
    position: relative;
    width: 320px;
    margin: 120px auto;
    background: #d6f0ff;
    padding: 30px;
    border-radius: 12px;
    text-align: center;
    z-index: 1;
}

.login-box h2 {
    color: purple;
}

input, select {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background: purple;
    color: white;
    border: none;
    border-radius: 5px;
}

button:hover {
    background: #6a0dad;
}
</style>

</head>
<body>

<div class="login-box">
<h2>Pharmacy Login</h2>

<form action="authenticate.php" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    
    <input type="password" name="password" placeholder="Password" required>

    <select name="role">
        <option value="admin">Admin</option>
        <option value="pharmacist">Pharmacist</option>
    </select>

    <button type="submit">Login</button>
</form>
<p style="color:red; text-align:center;">
<?php
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}
?>
</p>
</div>


</body>
</html>
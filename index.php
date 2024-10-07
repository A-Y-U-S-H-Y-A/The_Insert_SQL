<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to the Web App</title>
</head>
<body>
    <h1>Welcome to the Web Application</h1>
    <p>Please choose an option below:</p>
    
    <a href="login.php">Login</a><br>
    <a href="register.php">Register</a>
</body>
</html>

<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$query = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$query->execute([$_SESSION['user_id']]);
$user = $query->fetch();

echo "<h1>Welcome, " . htmlspecialchars($user['username']) . "</h1>";
echo "<p>Name: " . htmlspecialchars($user['name']) . "</p>";
echo "<p>Bio: " . htmlspecialchars($user['bio']) . "</p>";

if ($_SESSION['role'] == 'admin') {
    echo "<a href='admin.php'>Admin Panel</a><br/>";
}
echo "<a href='view_users.php'>View Other Users</a> <br/>";
echo "<a href='logout.php'>Logout</a><br/>";
?>

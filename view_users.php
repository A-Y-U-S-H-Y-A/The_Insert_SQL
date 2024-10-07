<?php
require 'db.php';
session_start();

$query = $pdo->query("SELECT username, name, bio FROM users");
$users = $query->fetchAll();

foreach ($users as $user) {
    echo "<h3>" . htmlspecialchars($user['username']) . "</h3>";
    echo "<p>Name: " . htmlspecialchars($user['name']) . "</p>";
    echo "<p>Bio: " . htmlspecialchars($user['bio']) . "</p>";
    echo "<hr>";
}
?>

<?php
require 'db.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: profile.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $userId = $_POST['user_id'];
        $query = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $query->execute([$userId]);
        echo "User deleted.";
    } elseif (isset($_POST['edit'])) {
        $userId = $_POST['user_id'];
        $name = $_POST['name'];
        $bio = $_POST['bio'];

        $query = $pdo->prepare("UPDATE users SET name = ?, bio = ? WHERE id = ?");
        $query->execute([$name, $bio, $userId]);
        echo "User details updated.";
    }
}

$query = $pdo->query("SELECT * FROM users");
$users = $query->fetchAll();

foreach ($users as $user) {
    echo "<form method='POST'>
        <h3>" . htmlspecialchars($user['username']) . "</h3>
        <input type='hidden' name='user_id' value='" . htmlspecialchars($user['id']) . "'>
        Name: <input type='text' name='name' value='" . htmlspecialchars($user['name']) . "'><br>
        Bio: <textarea name='bio'>" . htmlspecialchars($user['bio']) . "</textarea><br>
        <button type='submit' name='edit'>Edit</button>
        <button type='submit' name='delete'>Delete</button>
        <hr>
    </form>";
}
?>

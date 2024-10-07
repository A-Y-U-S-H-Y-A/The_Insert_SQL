<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $name = $_POST['name'];
    $bio = $_POST['bio'];

    $userCheck = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $userCheck->execute([$username]);

    if ($userCheck->rowCount() == 0) {
        $uniqueId = uniqid(); // Assign a unique ID to the user
        $query = "INSERT INTO users (id, username, password, name, bio, role) VALUES ('$uniqueId', '$username', '$password', '$name', '$bio', 'user')";
        $pdo->exec($query);
        echo "User registered successfully.";
    } else {
        echo "Username already exists.";
    }
}
?>

<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Name: <input type="text" name="name" required><br>
    Bio: <textarea name="bio" required></textarea><br>
    <button type="submit">Register</button>
</form>

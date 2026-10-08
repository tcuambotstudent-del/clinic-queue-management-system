<?php
require_once 'database.php';

// Plain password to use
$plain_password = '123';
$hashed_password = password_hash($plain_password, PASSWORD_BCRYPT);

// Delete old admin and insert new clean record
$conn->query("DELETE FROM users WHERE username = 'admin'");

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_password);
$username = 'admin';

if ($stmt->execute()) {
    echo "<h1>SUCCESS!</h1>";
    echo "<p>User <b>admin</b> has been created/reset with password: <b>123</b></p>";
    echo "<a href='login.php'>Click here to go to Login Page</a>";
} else {
    echo "Error: " . $conn->error;
}
?>
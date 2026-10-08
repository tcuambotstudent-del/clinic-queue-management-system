<?php
require_once 'database.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Securely hash the password before saving
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            $message = "Staff account created successfully! You can now log in at login.php";
        } else {
            $message = "Error: Username might already exist.";
        }
    } else {
        $message = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Staff Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div style="max-width: 400px; margin: 80px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
        <h2>Create Staff Admin Account</h2>
        <?php if (!empty($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form action="create_admin.php" method="POST">
            <div style="margin-bottom: 15px;">
                <label>Staff Username:</label><br>
                <input type="text" name="username" required style="width: 100%; padding: 8px; margin-top: 5px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label>Password:</label><br>
                <input type="password" name="password" required style="width: 100%; padding: 8px; margin-top: 5px;">
            </div>
            <button type="submit" style="padding: 10px 20px; cursor: pointer;">Register Staff</button>
        </form>
    </div>
</body>
</html>
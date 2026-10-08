<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<header>
    <div class="logo">🏥 Clinic Queue</div>


    <nav>
        <a href="index.php">Waiting Display</a>
        <a href="register.php" class="active">Register</a>
        <a href="queue.php">Staff Queue</a>
        <a href="history.php">History</a>
    </nav>
</header>


<main class="container">


    <div class="page-header">
        <h1>Patient Registration</h1>
        <p>Register a walk-in patient.</p>
    </div>


    <div class="form-card">


        <form id="registerForm">


            <label for="name">Patient Name</label>
            <input
                type="text"
                id="name"
                placeholder="Enter patient name"
                required
            >


            <label for="age">Age</label>
            <input
                type="number"
                id="age"
                min="0"
                placeholder="Enter age"
                required
            >


            <label for="contact">Contact Number</label>
            <input
                type="tel"
                id="contact"
                placeholder="Enter contact number"
                required
            >


            <label for="priority">Priority</label>


            <select id="priority">
                <option value="regular">Regular</option>
                <option value="senior">Senior Citizen</option>
                <option value="pwd">PWD</option>
                <option value="emergency">Emergency</option>
            </select>


            <button type="submit" class="primary-btn">
                Register Patient
            </button>


        </form>


        <div id="registrationResult" class="result-box hidden"></div>


    </div>


</main>


<footer>
    <p>Clinic Queue Management System © 2026</p>
</footer>


<script src="script.js"></script>
</body>
</html>



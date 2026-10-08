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
    <title>Staff Queue</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<header>
    <div class="logo">🏥 Clinic Queue</div>


    <nav>
    <a href="queue.php" class="active">Staff Queue</a>
    <a href="register.php">Register Patient</a>
    <a href="history.php">History</a>
    <a href="logout.php">Logout</a>
</nav>
</header>


<main class="container">


    <div class="page-header">
        <h1>Staff Queue Management</h1>
        <p>Manage the patients currently waiting.</p>
    </div>


    <div class="staff-controls">


        <div class="current-serving">
            <h3>Currently Serving</h3>
            <div id="staffCurrent">---</div>
        </div>


        <button onclick="callNext()" class="primary-btn">
            📢 Call Next
        </button>


    </div>


    <div class="table-container">


        <table>
            <thead>
                <tr>
                    <th>Queue No.</th>
                    <th>Patient</th>
                    <th>Age</th>
                    <th>Priority</th>
                    <th>Waiting Time</th>
                    <th>Action</th>
                </tr>
            </thead>


            <tbody id="queueTable">
            </tbody>


        </table>


    </div>


</main>


<footer>
    <p>Clinic Queue Management System © 2026</p>
</footer>


<script src="script.js"></script>
</body>
</html>

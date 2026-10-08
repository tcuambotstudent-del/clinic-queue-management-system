<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient History</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<header>
    <div class="logo">🏥 Clinic Queue</div>


    <nav>
        <a href="index.php">Waiting Display</a>
        <a href="register.php">Register</a>
        <a href="queue.php">Staff Queue</a>
        <a href="history.php" class="active">History</a>
    </nav>
</header>


<main class="container">


    <div class="page-header">
        <h1>Patient History</h1>
        <p>Completed and cancelled patients.</p>
    </div>


    <div class="table-container">




    
    Patient History

        <table>
            <thead>
                <tr>
                    <th>Queue No.</th>
                    <th>Patient</th>
                    <th>Age</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>


            <tbody id="historyTable">
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




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Queue Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<header>
    <div class="logo">
        🏥 Clinic Queue
    </div>


    <nav>
        <a href="index.php" class="active">Waiting Display</a>
        <a href="register.php">Register</a>
        <a href="queue.php">Staff Queue</a>
        <a href="history.php">History</a>
    </nav>
</header>


<main class="container">


    <section class="welcome">
        <h1>Clinic Queue Management System</h1>
        <p>Welcome! Please wait for your queue number to be called.</p>
    </section>


    <section class="serving-card">
        <p>NOW SERVING</p>
        <h2 id="nowServing">---</h2>
        <div id="servingName">Please wait...</div>
    </section>


    <section>
        <h2 class="section-title">Next Patients</h2>


        <div class="next-patients" id="nextPatients">
            <div class="patient-card">
                <span>---</span>
                <p>Waiting...</p>
            </div>


            <div class="patient-card">
                <span>---</span>
                <p>Waiting...</p>
            </div>


            <div class="patient-card">
                <span>---</span>
                <p>Waiting...</p>
            </div>
        </div>
    </section>


    <section class="info-panel">
        <h2>Clinic Information</h2>
        <p>🕐 Please stay inside the waiting area while waiting for your number.</p>
        <p>🔊 Listen for your queue number to be called.</p>
    </section>


</main>


<footer>
    <p>Clinic Queue Management System © 2026</p>
</footer>


<script src="script.js"></script>
</body>
</html>



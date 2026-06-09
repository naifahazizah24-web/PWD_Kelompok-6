<?php

session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>

    <div class="logo">
        RHYTHM NATION
    </div>

    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="waiting-room.php">Queue</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

</nav>

<?php if(isset($_SESSION['success'])): ?>

<div class="success-box">
    <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
    ?>
</div>

<?php endif; ?>

<div class="dashboard-container">

    <div class="welcome-card">

        <h1>
            Welcome,
            <?php echo $_SESSION["user"]; ?>
        </h1>

        <p>
            Ready for Rhythm Nation Festival 2026 🎵
        </p>

    </div>

    <div class="dashboard-grid">

        <div class="info-card">
            <h2>🎫 Ticket Status</h2>
            <p>Not Purchased Yet</p>
        </div>

        <div class="info-card">
            <h2>👤 Account Status</h2>
            <p>Active User</p>
        </div>

        <div class="info-card">
            <h2>🎵 Event Type</h2>
            <p>Music Festival</p>
        </div>

        <div class="info-card">
            <h2>📍 Venue</h2>
            <p>Gelora Bung Karno</p>
        </div>

    </div>

    <div class="festival-banner">

        <h2>RHYTHM NATION FESTIVAL 2026</h2>

        <p>
            Experience The Biggest Music Festival In Indonesia
        </p>

        <a href="waiting-room.php">
            <button>
                Join Queue
            </button>
        </a>

    </div>

</div>

</body>
</html>
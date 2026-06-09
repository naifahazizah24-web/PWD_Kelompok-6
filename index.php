<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rhythm Nation Festival 2026</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <div class="logo">RHYTHM NATION 2026</div>

    <ul>
        <li><a href="index.php">Home</a></li>

        <?php if(isset($_SESSION['user'])): ?>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>

<!-- HERO -->
<section class="hero">

    <div class="hero-content">
        <h1>RHYTHM NATION FESTIVAL 2026</h1>

        <p>
            The Biggest Music Experience in Indonesia
        </p>

        <a href="#about">
            <button>Explore Festival</button>
        </a>
    </div>

</section>

<!-- ABOUT -->
<section id="about" class="about-section">

    <h2>About The Festival</h2>

    <p>
        Rhythm Nation Festival 2026 adalah festival musik terbesar yang menghadirkan
        artis nasional dan internasional dalam satu panggung spektakuler.
        Sebagai festival musik berskala besar di Indonesia, kami berkomitmen untuk menciptakan 
        ruang di mana setiap detak jantung penonton berpadu selaras dengan dentuman beat di panggung.
    </p>

</section>

<!-- COUNTDOWN -->
<section class="countdown">

    <h2>Festival Countdown</h2>

    <div id="timer"></div>

</section>

<!-- EVENT INFORMATION -->
<section class="info-section">

    <h2>Festival Information</h2>

    <div class="info-grid">

        <div class="info-card">
            <h3>📅 Date</h3>
            <p>12 Desember 2026</p>
        </div>

        <div class="info-card">
            <h3>📍 Location</h3>
            <p>Gelora Bung Karno, Jakarta</p>
        </div>

        <div class="info-card">
            <h3>🎤 Artists</h3>
            <p>30+ Local & International Artists</p>
        </div>

        <div class="info-card">
            <h3>🎫 Categories</h3>
            <p>VIP, Festival, CAT 1</p>
        </div>

    </div>

</section>

<!-- LINEUP -->
<section class="lineup">

    <h2>Festival Line Up</h2>

    <div class="artist-list">

        <div class="artist-pill">🎧 Reality Club</div>
        <div class="artist-pill">🎤 Hindia</div>
        <div class="artist-pill">🎵 Tulus</div>
        <div class="artist-pill">🎸 Pamungkas</div>
        <div class="artist-pill">🎹 Tenxi</div>
        <div class="artist-pill">🎤 Raisa</div>

    </div>

</section>

<!-- FEATURED ARTISTS -->
<section class="artists">

    <h2>International Artists</h2>

    <div class="cards">

        <div class="card">
            <img src="https://storage.googleapis.com/storage-ajaib-prd-coin-wp-artifact/2022/12/niki-zefanya.webp" alt="">
            <h3>NIKI</h3>
            <p>Pop</p>
        </div>

        <div class="card">
            <img src="https://i.scdn.co/image/ab6761610000e5eb4567279fac84a0375c3d819b" alt="">
            <h3>The Chainsmokers</h3>
            <p>Dance Music</p>
        </div>

        <div class="card">
            <img src="https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_640/v1598330104/aqqb9pbovjrjjedrnzlg.jpg" alt="">
            <h3>Rich Brian</h3>
            <p>Hip Hop</p>
        </div>

    </div>

</section>

<!-- SCHEDULE -->
<section class="schedule">

    <h2>Event Schedule</h2>

    <table>

        <tr>
            <th>Time</th>
            <th>Activity</th>
        </tr>

        <tr>
            <td>13:00</td>
            <td>Gate Open</td>
        </tr>

        <tr>
            <td>15:00</td>
            <td>Opening Performance</td>
        </tr>

        <tr>
            <td>18:00</td>
            <td>Main Stage Performance</td>
        </tr>

        <tr>
            <td>22:00</td>
            <td>Closing Ceremony</td>
        </tr>

    </table>

</section>

<footer>
    © 2026 Rhythm Nation Festival
</footer>

<script>

const targetDate = new Date("January 1, 2026 00:00:00");

setInterval(() => {

    const now = new Date();
    const difference = targetDate - now;

    const days = Math.floor(difference / (1000 * 60 * 60 * 24));

    const hours = Math.floor(
        (difference % (1000 * 60 * 60 * 24))
        / (1000 * 60 * 60)
    );

    const minutes = Math.floor(
        (difference % (1000 * 60 * 60))
        / (1000 * 60)
    );

    const seconds = Math.floor(
        (difference % (1000 * 60))
        / 1000
    );

    document.getElementById("timer").innerHTML =
        days + " Days : " +
        hours + " Hours : " +
        minutes + " Minutes : " +
        seconds + " Seconds";

}, 1000);

</script>

</body>
</html>
<?php
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = "Angelica";
}

$user = $_SESSION['user'];

$totalTickets = 2;
$queueNumber = 124;
$paymentStatus = "Success";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard - Rhythm Nation Festival 2026</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial, sans-serif;
}

body{
background:#f5f5f5;
}

nav{
background:#b91c1c;
color:white;
padding:15px 30px;
display:flex;
justify-content:space-between;
align-items:center;
}

nav ul{
display:flex;
list-style:none;
gap:20px;
}

nav a{
color:white;
text-decoration:none;
}

.container{
padding:30px;
}

.welcome-card{
background:white;
padding:25px;
border-radius:15px;
margin-bottom:20px;
box-shadow:0 2px 10px rgba(0,0,0,.1);
}

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
}

.card{
background:white;
padding:20px;
border-radius:15px;
box-shadow:0 2px 10px rgba(0,0,0,.1);
}

.card h3{
margin-bottom:10px;
color:#b91c1c;
}

.number{
font-size:35px;
font-weight:bold;
}

.btn{
display:inline-block;
padding:12px 20px;
background:#b91c1c;
color:white;
text-decoration:none;
border-radius:8px;
margin-top:15px;
}

.booking-table{
width:100%;
margin-top:25px;
background:white;
border-collapse:collapse;
}

.booking-table th,
.booking-table td{
padding:15px;
border:1px solid #ddd;
text-align:center;
}

.booking-table th{
background:#b91c1c;
color:white;
}

.status-success{
color:green;
font-weight:bold;
}

footer{
text-align:center;
padding:20px;
margin-top:30px;
}

</style>
</head>

<body>

<nav>
<div>
🎵 RHYTHM NATION FESTIVAL 2026
</div>

<ul>
<li><a href="dashboard.php">Dashboard</a></li>
<li><a href="waiting-room.php">Waiting Room</a></li>
<li><a href="mytickets.php">My Tickets</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</nav>

<div class="container">

<div class="welcome-card">
<h1>Selamat Datang, <?php echo $user; ?> 👋</h1>
<p>Kelola tiket dan transaksi festival Anda di sini.</p>
</div>

<div class="grid">

<div class="card">
<h3>Total Tiket</h3>
<div class="number">
<?php echo $totalTickets; ?>
</div>
</div>

<div class="card">
<h3>Nomor Antrean</h3>
<div class="number">
#<?php echo $queueNumber; ?>
</div>
</div>

<div class="card">
<h3>Status Pembayaran</h3>
<div class="number" style="font-size:24px;">
<?php echo $paymentStatus; ?>
</div>
</div>

</div>

<a href="waiting-room.php" class="btn">
Masuk Waiting Room
</a>

<a href="mytickets.php" class="btn">
Lihat Tiket Saya
</a>

<table class="booking-table">

<tr>
<th>ID Booking</th>
<th>Kategori</th>
<th>Jumlah</th>
<th>Status</th>
</tr>

<tr>
<td>BK2026001</td>
<td>VIP</td>
<td>1</td>
<td class="status-success">Success</td>
</tr>

<tr>
<td>BK2026002</td>
<td>Festival</td>
<td>1</td>
<td class="status-success">Success</td>
</tr>

</table>

</div>

<footer>
© 2026 Rhythm Nation Festival
</footer>

</body>
</html>

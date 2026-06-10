<?php
// Memasukkan berkas config untuk memanfaatkan fungsi pembantu bawaan kelompok
require_once 'config.php';

// Proteksi halaman: Jika user belum login, dikembalikan ke halaman login
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?php echo NAMA_EVENT; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <div class="logo">
        RHYTHM NATION
    </div>

    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="checkout.php">Checkout</a></li>
        <li><a href="my-tickets.php">My Tickets</a></li>
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
            Welcome, <?php echo getUserName(); ?>
        </h1>
        <p>
            Ready for <?php echo NAMA_EVENT; ?> 🎵
        </p>
    </div>

    <div class="dashboard-grid">

        <div class="info-card" style="display: flex; flex-direction: column; justify-content: space-between; min-height: 180px;">
            <div>
                <h2>🎫 Ticket Status</h2>
                <?php if (isset($_SESSION['purchased_tickets']) && !empty($_SESSION['purchased_tickets'])): ?>
                    <p style="color: #1f5132; font-weight: bold; margin-bottom: 15px;">🎉 Tiket Berhasil Dibeli!</p>
                <?php else: ?>
                    <p style="color: #777; margin-bottom: 15px;">Belum ada tiket dipesan</p>
                <?php endif; ?>
            </div>
            
            <?php if (isset($_SESSION['purchased_tickets']) && !empty($_SESSION['purchased_tickets'])): ?>
                <a href="my-tickets.php" style="text-decoration: none;">
                    <button style="background: var(--sage); color: #222; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer; border-radius: 5px; width: 100%; font-family: Perpetua, serif; font-weight: bold;">
                        Lihat E-Ticket QR
                    </button>
                </a>
            <?php else: ?>
                <a href="checkout.php" style="text-decoration: none;">
                    <button style="background: var(--red); color: white; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer; border-radius: 5px; width: 100%; font-family: Perpetua, serif; font-weight: bold;">
                        Beli Tiket Sekarang
                    </button>
                </a>
            <?php endif; ?>
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
        <h2><?php echo NAMA_EVENT; ?></h2>
        <p>
            Experience The Biggest Music Festival In Indonesia
        </p>
        <a href="checkout.php">
            <button style="background: var(--red); color: white; border: none; padding: 12px 30px; border-radius: 50px; font-size: 18px; cursor: pointer; font-weight: bold; margin-top: 15px;">
                Mulai Pemesanan Tiket
                </button>
        </a>
    </div>

</div>

<footer>
    © <?php echo TAHUN_EVENT; ?> Rhythm Nation Festival
</footer>

</body>
</html>
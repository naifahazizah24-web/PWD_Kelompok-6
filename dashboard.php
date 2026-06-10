<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['mulai_antrean'])) {
    $_SESSION["sedang_mengantre"] = true;
    $_SESSION["nomor_antrean"] = 120;
    $_SESSION["persen_progress"] = 25;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Rhythm Nation</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
       
        .modal-queue { background: white; padding: 40px 30px; border-radius: 24px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.05); border: 1px solid #f0eae1; margin-top: 30px; }
        .queue-big-number { font-size: 80px; font-weight: bold; color: #b32e2e; margin: 15px 0; }
        .bar-wadah { width: 100%; background: #eee; height: 16px; border-radius: 20px; overflow: hidden; margin: 20px 0; }
        .bar-isi { height: 100%; background: #b32e2e; transition: width 0.5s ease-in-out; }

        .ticket-card {
            background: linear-gradient(135deg, #ffffff 0%, #fffbf5 100%);
            border: 2px dashed #b32e2e;
            border-radius: 20px;
            padding: 30px;
            margin-top: 35px;
            box-shadow: 0 8px 30px rgba(179, 46, 46, 0.08);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
        }
        .ticket-details { flex: 1; min-width: 280px; }
        .ticket-details h3 { margin: 0 0 10px 0; color: #b32e2e; font-size: 24px; }
        .ticket-details p { margin: 5px 0; color: #555; font-size: 16px; }
        .qr-section {
            text-align: center;
            padding: 15px;
            background: white;
            border: 1px solid #f0eae1;
            border-radius: 12px;
            margin-left: 20px;
        }
        .qr-section img { width: 150px; height: 150px; }
        .badge-success {
            background: #2e7d32; color: white; padding: 4px 12px; border-radius: 50px; font-size: 14px; font-weight: bold;
        }
    </style>
</head>
<body>

<nav>
    <div class="logo">RHYTHM NATION</div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<div class="dashboard-container">

    <?php if(isset($_SESSION['success'])): ?>
        <div class="success-box" style="background: #e8f5e9; color: #2e7d32; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c8e6c9; font-weight: bold;">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION["sedang_mengantre"]) && $_SESSION["sedang_mengantre"] === true): ?>
        
        <div class="modal-queue">
            <h2>🎵 RHYTHM NATION FESTIVAL 2026</h2>
            <p style="color: #666;">Mohon jangan tutup halaman, antrean Anda sedang melaju...</p>
            <div class="queue-big-number" id="live-queue">#<?php echo $_SESSION["nomor_antrean"]; ?></div>
            <p style="font-weight: bold; color: #333;">Posisi Antrean Tiket Anda</p>
            <div class="bar-wadah"><div class="bar-isi" id="live-bar" style="width: <?php echo $_SESSION["persen_progress"]; ?>%"></div></div>
            <p style="color: #555;"><span id="live-text-progress"><?php echo $_SESSION["persen_progress"]; ?></span>% Menuju Slot Pembelian</p>
            <div style="margin-top: 25px; background: #fdfbf7; padding: 15px; border-radius: 12px;">
                <p style="margin: 0 0 5px 0; color: #777;">Estimasi Waktu Tunggu</p>
                <h3 id="live-time" style="font-size: 24px; margin: 0; color: #222;">10 Menit</h3>
            </div>
            <a href="booking.php" id="btn-ke-pembelian" style="display: none; text-decoration: none;">
                <button style="background: #b32e2e; color: white; border: none; padding: 14px; border-radius: 50px; font-size: 18px; cursor: pointer; font-weight: bold; width: 100%; margin-top: 20px;">
                    Masuk ke Pembelian Tiket Sekarang!
                </button>
            </a>
        </div>

        <script>
        let sisaAntrean = <?php echo $_SESSION["nomor_antrean"]; ?>;
        let majuProgress = <?php echo $_SESSION["persen_progress"]; ?>;
        const liveQueue = document.getElementById('live-queue');
        const liveBar = document.getElementById('live-bar');
        const liveTextProgress = document.getElementById('live-text-progress');
        const liveTime = document.getElementById('live-time');
        const btnKePembelian = document.getElementById('btn-ke-pembelian');

        const intervalAntrean = setInterval(() => {
            if (sisaAntrean > 1) {
                sisaAntrean -= Math.floor(Math.random() * 4) + 3;
                majuProgress += Math.floor(Math.random() * 4) + 2;
                if (sisaAntrean < 1) sisaAntrean = 1;
                if (majuProgress > 100) majuProgress = 100;

                liveQueue.innerText = "#" + sisaAntrean;
                liveBar.style.width = majuProgress + "%";
                liveTextProgress.innerText = majuProgress;

                if (sisaAntrean > 50) { liveTime.innerText = "5 Menit"; } 
                else { liveTime.innerText = "1 Menit (Hampir Sampai)"; }
            } else {
                clearInterval(intervalAntrean);
                liveQueue.innerText = "Giliran Anda!";
                liveTime.innerText = "Silakan Masuk!";
                liveTime.style.color = "green";
                btnKePembelian.style.display = "block";
            }
        }, 1000);
        </script>

    <?php else: ?>

        <div class="welcome-card">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION["user"]); ?></h1>
            <p>Ready for Rhythm Nation Festival 2026 🎵</p>
        </div>

        <div class="dashboard-grid">
            <div class="info-card">
                <h2>🎫 Ticket Status</h2>
                <?php if (isset($_SESSION['purchased_tickets'])): ?>
                    <p style="color: #2e7d32; font-weight: bold;">🟢 Sukses Dipesan</p>
                <?php else: ?>
                    <p style="color: #777;">Belum ada tiket dipesan</p>
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

        <?php if (isset($_SESSION['purchased_tickets'])): ?>
            <?php $tkt = $_SESSION['purchased_tickets']; ?>
            <div class="ticket-card">
                <div class="ticket-details">
                    <h3>RHYTHM NATION E-TICKET <span class="badge-success">CONFIRMED</span></h3>
                    <p><strong>Kode Booking:</strong> <span style="font-family: monospace; font-size: 18px; color: #b32e2e;"><?php echo $tkt['booking_code']; ?></span></p>
                    <p><strong>Nama Pemilik:</strong> <?php echo htmlspecialchars($_SESSION["user"]); ?></p>
                    <p><strong>Kategori:</strong> <?php echo $tkt['category_name']; ?></p>
                    <p><strong>Jumlah:</strong> <?php echo $tkt['quantity']; ?> Lembar</p>
                    <p><strong>Waktu Transaksi:</strong> <?php echo $tkt['booking_time']; ?></p>
                </div>
                <div class="qr-section">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo urlencode($tkt['booking_code'] . " | " . $_SESSION['user'] . " | " . $tkt['category_name']); ?>" alt="Ticket QR Code">
                    <p style="margin: 5px 0 0 0; font-size: 12px; color: #888;">Scan saat di Gate</p>
                </div>
            </div>
        <?php else: ?>
            <div class="festival-banner">
                <h2>RHYTHM NATION FESTIVAL 2026</h2>
                <p>Experience The Biggest Music Festival In Indonesia</p>
                <form action="dashboard.php" method="POST">
                    <button type="submit" name="mulai_antrean" style="background: #b32e2e; color: white; border: none; padding: 12px 30px; border-radius: 50px; font-size: 18px; cursor: pointer; font-weight: bold; margin-top: 15px;">
                        Mulai Pemesanan Tiket
                    </button>
                </form>
            </div>
        <?php endif; ?>

    <?php endif; ?>

</div>

</body>
</html>

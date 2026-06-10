<?php
session_start();

// Proteksi halaman: Jika user belum login, tendang ke halaman login
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Data Dummy Tiket untuk simulasi tampilan di HP (bisa dihubungkan ke database nanti)
$myTickets = [
    [
        'id' => 'RN26-VIP-0982',
        'name' => 'VIP Ticket',
        'date' => '12 Desember 2026',
        'holder' => $_SESSION["user"]
    ],
    [
        'id' => 'RN26-FES-4412',
        'name' => 'Festival Ticket',
        'date' => '12 Desember 2026',
        'holder' => $_SESSION["user"]
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tickets - Rhythm Nation Festival 2026</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Desain khusus halaman tiket agar rapi saat dibuka di HP */
        .tickets-container {
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 25px;
        }
        .ticket-card-box {
            background: white;
            border: 2px dashed var(--red);
            border-radius: 15px;
            width: 100%;
            max-width: 450px;
            padding: 25px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.05);
        }
        .ticket-header {
            border-bottom: 2px solid var(--cream);
            padding-bottom: 15px;
            margin-bottom: 15px;
            text-align: center;
        }
        .ticket-body p {
            margin-bottom: 8px;
            font-size: 16px;
        }
        .qr-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
            padding: 15px;
            background: var(--cream);
            border-radius: 10px;
        }
        .qr-code {
            padding: 10px;
            background: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<nav>
    <div class="logo">RHYTHM NATION 2026</div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<div class="tickets-container">
    <h1 style="color: var(--red); text-align: center; font-size: 32px; font-family: 'Cinzel', serif;">🎫 Tiket Saya</h1>
    <p style="text-align: center; margin-bottom: 20px;">Tunjukkan QR Code di bawah ini kepada petugas di gerbang masuk.</p>

    <?php foreach ($myTickets as $ticket): ?>
        <div class="ticket-card-box">
            <div class="ticket-header">
                <h2 style="color: var(--red); font-size: 22px; font-weight: bold;"><?php echo $ticket['name']; ?></h2>
                <span style="font-size: 14px; color: #777;">Rhythm Nation Festival 2026</span>
            </div>
            
            <div class="ticket-body">
                <p><strong>Nama Pemilik:</strong> <?php echo $ticket['holder']; ?></p>
                <p><strong>Tanggal Event:</strong> <?php echo $ticket['date']; ?></p>
                <p><strong>Lokasi:</strong> Gelora Bung Karno, Jakarta</p>
                <p><strong>Kode Unik:</strong> <span style="font-family: monospace; color: var(--red); font-weight: bold;"><?php echo $ticket['id']; ?></span></p>
                
                <div class="qr-area">
                    <div class="qr-code" data-token="<?php echo $ticket['id']; ?>"></div>
                    <span style="font-size: 12px; color: #555; margin-top: 8px;">Pindai Layar HP untuk Masuk</span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<footer>
    © 2026 Rhythm Nation Festival
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Cari semua elemen HTML yang memiliki class 'qr-code'
    const qrElements = document.querySelectorAll('.qr-code');
    
    qrElements.forEach(function(element) {
        // Ambil string ID tiket dari atribut 'data-token'
        const tokenData = element.getAttribute('data-token');
        
        // Buat QR Code secara instan di dalam elemen tersebut
        new QRCode(element, {
            text: tokenData,
            width: 150,       // Ukuran lebar QR Code di HP
            height: 150,      // Ukuran tinggi QR Code di HP
            colorDark: "#222222",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.M
        });
    });
});
</script>

</body>
</html>
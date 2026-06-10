<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$ticketCategories = [
    [
        'id' => 'VIP01',
        'name' => 'VIP Class',
        'price' => 2500000,
        'stock' => 100,
        'desc' => 'Dapatkan kursi baris depan, merchandise eksklusif, dan akses lounge.'
    ],
    [
        'id' => 'FES01',
        'name' => 'Festival (Standing)',
        'price' => 1000000,
        'stock' => 500,
        'desc' => 'Area berdiri tepat di depan panggung utama. Rasakan energinya!'
    ],
    [
        'id' => 'CAT01',
        'name' => 'CAT 1 (Seated)',
        'price' => 750000,
        'stock' => 300,
        'desc' => 'Kursi bernomor di tribun barat dengan pandangan menyeluruh.'
    ]
];

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['proses_pembelian'])) {
    $selectedCategoryId = $_POST['ticket_category'] ?? '';
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    $chosenCategory = null;
    foreach ($ticketCategories as $category) {
        if ($category['id'] === $selectedCategoryId) {
            $chosenCategory = $category;
            break;
        }
    }

    if ($chosenCategory && $quantity > 0 && $quantity <= 4) {
        $totalBayar = $chosenCategory['price'] * $quantity;
        $kodeBooking = "RNF-" . strtoupper(substr(md5(time()), 0, 8));

        $_SESSION['purchased_tickets'] = [
            'booking_code' => $kodeBooking,
            'category_name' => $chosenCategory['name'],
            'quantity' => $quantity,
            'total_price' => $totalBayar,
            'booking_time' => date('d M Y, H:i') . " WIB"
        ];

        $_SESSION['success'] = "🎉 Pembelian tiket berhasil terkonfirmasi!";
        
        unset($_SESSION["sedang_mengantre"]);

        header("Location: dashboard.php");
        exit();
    } else {
        $message = "Jumlah tiket tidak valid atau melebihi batas (Maksimal 4 tiket per akun).";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Tickets - Rhythm Nation</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: #fdfbf7;
            font-family: 'Perpetua', serif, Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        nav {
            background: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f0eae1;
        }
        nav .logo {
            font-weight: bold;
            font-size: 20px;
            letter-spacing: 1px;
        }
        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            margin-left: 20px;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        .booking-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .ticket-box {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.02);
            border: 1px solid #f0eae1;
        }
        .ticket-option {
            border: 2px solid #f0eae1;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.2s ease;
        }
        .ticket-option:hover {
            border-color: #b32e2e;
            background: #fffdfa;
        }
        .ticket-option input[type="radio"] {
            transform: scale(1.3);
            margin-right: 15px;
            accent-color: #b32e2e;
        }
        .ticket-info {
            flex-grow: 1;
            padding-left: 10px;
        }
        .ticket-info h3 {
            margin: 0 0 5px 0;
            color: #222;
        }
        .ticket-info p {
            margin: 0;
            color: #777;
            font-size: 14px;
            line-height: 1.4;
        }
        .ticket-price {
            font-size: 20px;
            font-weight: bold;
            color: #b32e2e;
            white-space: nowrap;
        }
        .calc-box {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #f0eae1;
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        .form-group select {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
            font-family: inherit;
        }
        .btn-pay {
            background: #b32e2e;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 50px;
            font-size: 18px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            margin-top: 15px;
            transition: background 0.2s;
            font-family: inherit;
        }
        .btn-pay:hover {
            background: #912323;
        }
        .total-summary {
            display: flex;
            justify-content: space-between;
            font-size: 22px;
            font-weight: bold;
            border-top: 2px dashed #f0eae1;
            padding-top: 15px;
            margin-top: 15px;
            color: #222;
        }
        .error-msg {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

<nav>
    <div class="logo">RHYTHM NATION</div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<div class="booking-container">
    
    <div class="ticket-box">
        <h2>🎫 Pilih Kategori Tiket Anda</h2>
        <p style="color: #666; margin-bottom: 25px;">Silakan pilih salah satu kelas tiket di bawah ini untuk Rhythm Nation Festival 2026.</p>

        <?php if(!empty($message)): ?>
            <div class="error-msg">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" id="bookingForm">
            
            <?php foreach ($ticketCategories as $index => $ticket): ?>
                <label class="ticket-option">
                    <input type="radio" name="ticket_category" value="<?php echo $ticket['id']; ?>" data-price="<?php echo $ticket['price']; ?>" <?php echo $index === 1 ? 'checked' : ''; ?>>
                    <div class="ticket-info">
                        <h3><?php echo $ticket['name']; ?></h3>
                        <p><?php echo $ticket['desc']; ?></p>
                        <p style="color: #a1783f; font-weight: bold; margin-top: 5px;">Sisa Stok: <?php echo $ticket['stock']; ?> Lembar</p>
                    </div>
                    <div class="ticket-price">
                        Rp <?php echo number_format($ticket['price'], 0, ',', '.'); ?>
                    </div>
                </label>
            <?php endforeach; ?>

            <div class="calc-box">
                <div class="form-group">
                    <label for="quantity">Jumlah Tiket (Maksimal 4)</label>
                    <select name="quantity" id="quantity">
                        <option value="1">1 Lembar Tiket</option>
                        <option value="2">2 Lembar Tiket</option>
                        <option value="3">3 Lembar Tiket</option>
                        <option value="4">4 Lembar Tiket</option>
                    </select>
                </div>

                <div class="total-summary">
                    <span>Total Pembayaran:</span>
                    <span id="totalDisplay">Rp 1.000.000</span>
                </div>

                <button type="submit" name="proses_pembelian" class="btn-pay">
                    Konfirmasi & Bayar Sekarang
                </button>
            </div>

        </form>
    </div>

</div>

<script>
const form = document.getElementById('bookingForm');
const totalDisplay = document.getElementById('totalDisplay');
const quantitySelect = document.getElementById('quantity');

function hitungTotal() {
    const selectedRadio = document.querySelector('input[name="ticket_category"]:checked');
    if (selectedRadio) {
        const harga = parseInt(selectedRadio.getAttribute('data-price'));
        const jumlah = parseInt(quantitySelect.value);
        const total = harga * jumlah;
        totalDisplay.innerText = "Rp " + total.toLocaleString('id-ID');
    }
}

form.addEventListener('change', hitungTotal);
hitungTotal();
</script>

</body>
</html>

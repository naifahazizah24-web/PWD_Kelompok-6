<?php

require_once 'config.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
    
    foreach ($ticketCategories as $category) {
        $_SESSION['cart'][] = [
            'id'    => $category['id'],
            'name'  => $category['name'],
            'qty'   => 1, // Kita set default beli 1 tiket per kategori untuk simulasi checkout
            'price' => $category['price']
        ];
    }
}

$cartItems = $_SESSION['cart'];
$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - <?php echo NAMA_EVENT; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .checkout-box {
            background: white;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            margin-top: 20px;
        }
        .checkout-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .checkout-table th {
            background: var(--sage);
            color: #222;
            padding: 12px;
            text-align: left;
        }
        .checkout-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        .btn-bayar {
            background: var(--red);
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            font-family: Perpetua, serif;
            transition: 0.3s;
        }
        .btn-bayar:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<nav>
    <div class="logo"><?php echo NAMA_EVENT; ?></div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="my-tickets.php">My Tickets</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<div class="dashboard-container" style="max-width: 800px; margin: 0 auto; padding: 20px;">
    
    <div class="timer-box">
        <h3>Selesaikan Pembayaran Anda Sebelum Waktu Habis!</h3>
        <div id="checkout-timer">10:00</div>
    </div>

    <div class="checkout-box">
        <h2 style="color: var(--red); margin-bottom: 20px; font-family: 'Cinzel', serif;">🛒 Ringkasan Pemesanan</h2>
        
        <?php if (!empty($cartItems)): ?>
            <table class="checkout-table">
                <thead>
                    <tr>
                        <th>Kategori Tiket</th>
                        <th style="text-align: center;">Jumlah</th>
                        <th style="text-align: right;">Harga Satuan</th>
                        <th style="text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): 
                        $subtotal = $item['price'] * $item['qty'];
                        $totalPrice += $subtotal;
                    ?>
                        <tr>
                            <td><strong><?php echo $item['name']; ?></strong></td>
                            <td style="text-align: center;"><?php echo $item['qty']; ?></td>
                            <td style="text-align: right;">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                            <td style="text-align: right;">Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr style="font-weight: bold; font-size: 20px; background: #f9f9f9;">
                        <td colspan="3" style="text-align: right; padding: 15px;">Total Pembayaran:</td>
                        <td style="text-align: right; padding: 15px; color: var(--red);">Rp <?php echo number_format($totalPrice, 0, ',', '.'); ?></td>
                    </tr>
                </tbody>
            </table>

            <form action="my-tickets.php" method="POST" style="text-align: right;">
                <input type="hidden" name="checkout_success" value="1">
                <button type="submit" class="btn-bayar">Bayar Sekarang</button>
            </form>
        <?php else: ?>
            <p style="text-align: center; font-size: 20px;">Keranjang belanja Anda kosong atau waktu checkout telah habis.</p>
        <?php endif; ?>
    </div>
</div>

<footer>
    © <?php echo TAHUN_EVENT; ?> Rhythm Nation Festival
</footer>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const MINUTES_LIMIT = 10;
    const DURATION = MINUTES_LIMIT * 60; 
    
    let expiryTime = sessionStorage.getItem("checkout_expiry");

    if (!expiryTime) {
        expiryTime = Date.now() + DURATION * 1000;
        sessionStorage.setItem("checkout_expiry", expiryTime);
    }

    function updateTimer() {
        let currentTime = Date.now();
        let timeLeft = Math.floor((expiryTime - currentTime) / 1000);
        const timerDisplay = document.getElementById("checkout-timer");

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            sessionStorage.removeItem("checkout_expiry");
            alert("Waktu checkout Anda (10 menit) telah habis! Keranjang belanja otomatis dikosongkan.");
            window.location.href = "clear_cart.php";
        } else {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            if (timerDisplay) {
                timerDisplay.innerHTML = minutes + ":" + seconds;
            }
        }
    }

    updateTimer();
    const timerInterval = setInterval(updateTimer, 1000);
});
</script>

</body>
</html>

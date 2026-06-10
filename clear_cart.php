<?php
require_once 'config.php';

// Hapus data keranjang belanja di session
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

// Redirect otomatis ke halaman awal
header("Location: index.php");
exit();
?>
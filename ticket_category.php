<?php

session_start();

$tickets = [

    [
        "name" => "VIP",
        "price" => 2500000,
        "stock" => 50
    ],

    [
        "name" => "Festival",
        "price" => 1200000,
        "stock" => 200
    ],

    [
        "name" => "CAT 1",
        "price" => 1800000,
        "stock" => 100
    ]
];

?>

<!DOCTYPE html>
<html>
<head>

<title>Kategori Tiket</title>

<link rel="stylesheet" href="CSS/style.css">

</head>

<body>

<div class="dashboard-container">

<h1>Kategori Tiket</h1>

<div class="dashboard-grid">

<?php foreach($tickets as $ticket): ?>

<div class="info-card">

<h3>
<?php echo $ticket["name"]; ?>
</h3>

<p>
Rp <?php echo number_format($ticket["price"]); ?>
</p>

<p>
Stok :
<?php echo $ticket["stock"]; ?>
</p>

<a href="booking.php?ticket=<?php echo $ticket["name"]; ?>">

<button>

Beli Sekarang

</button>

</a>

</div>

<?php endforeach; ?>

</div>

</div>

</body>
</html>

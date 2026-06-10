<?php

session_start();

if(!isset($_SESSION["expired_at"]))
{
    header("Location: dashboard.php");
    exit();
}

$remaining =
$_SESSION["expired_at"] - time();

if($remaining <= 0)
{
    session_unset();

    echo "
    <h1>
    Booking Expired
    </h1>
    ";

    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Booking Lock</title>

<link rel="stylesheet" href="CSS/style.css">

</head>

<body>

<div class="waiting">

<h1>
🎟 Ticket Locked
</h1>

<h3>

<?php

echo $_SESSION["ticket"];

?>

</h3>

<h2 id="countdown">

</h2>

<p>

Selesaikan pembayaran dalam 10 menit.

</p>

</div>

<script>

let timeLeft =
<?php echo $remaining; ?>;

const countdown =
document.getElementById(
"countdown"
);

setInterval(function(){

let minutes =
Math.floor(timeLeft / 60);

let seconds =
timeLeft % 60;

countdown.innerHTML =
minutes + ":" +
(seconds < 10 ? "0" : "") +
seconds;

if(timeLeft <= 0)
{
    window.location =
    "dashboard.php";
}

timeLeft--;

},1000);

</script>

</body>

</html>
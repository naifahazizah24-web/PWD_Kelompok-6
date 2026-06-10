<?php

session_start();

if(!isset($_SESSION["user"]))
{
    header("Location: login.php");
    exit();
}

if(isset($_GET["ticket"]))
{
    $_SESSION["ticket"] = $_GET["ticket"];
}

$_SESSION["booking_time"] = time();

$_SESSION["expired_at"] =
time() + (10 * 60);

header("Location: waiting_room.php");

exit();
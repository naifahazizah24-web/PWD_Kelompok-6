<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('NAMA_EVENT', 'Rhythm Nation Festival 2026');
define('TAHUN_EVENT', '2026');

$ticketCategories = [
    [
        'id' => 'VIP01',
        'name' => 'VIP',
        'price' => 2500000,
        'stock' => 100
    ],
    [
        'id' => 'FES01',
        'name' => 'Festival',
        'price' => 1000000,
        'stock' => 500
    ],
    [
        'id' => 'CAT01',
        'name' => 'CAT 1',
        'price' => 750000,
        'stock' => 300
    ]
];

function isLoggedIn(): bool
{
    return isset($_SESSION['user']);
}

function getUserName(): string
{
    return $_SESSION['user'] ?? 'Guest';
}

$redis = null;

if (class_exists('Redis')) {
    try {
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
    } catch (Exception $e) {
        $redis = null; 
    }
} else {
    
    error_log("Ekstensi Redis belum aktif di php.ini server Anda.");
}

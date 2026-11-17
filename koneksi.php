<?php
// Konfigurasi koneksi database MySQL untuk XAMPP.
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'latihan1';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die('Koneksi ke database gagal: ' . htmlspecialchars(mysqli_connect_error(), ENT_QUOTES, 'UTF-8'));
}

mysqli_set_charset($conn, 'utf8mb4');

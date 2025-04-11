<?php
$host = 'db';           // Nama layanan database di docker-compose.yml
$user = 'hrd';         // Username dari docker-compose.yml
$pass = 'hrd';     // Password dari docker-compose.yml
$db = 'hrd';            // Nama database dari docker-compose.yml
$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
?>
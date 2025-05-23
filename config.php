<?php
// Konfigurasi koneksi database
$host = "localhost";            // Host database 
$user = "root";                 // Username 
$password = "1234";             // Password 
$database = "catatan_keuangan"; // Nama database

// Membuat koneksi 
$conn = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

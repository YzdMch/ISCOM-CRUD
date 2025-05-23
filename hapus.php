<?php
include 'config.php';

$id = $_GET['id'];

// Hapus data dari database
$query = "DELETE FROM transaksi WHERE id = $id";
mysqli_query($conn, $query);

// Kembali ke halaman utama
header("Location: index.php");
exit;
?>

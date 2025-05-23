<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal   = $_POST['tanggal'];
    $kategori  = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $jumlah    = $_POST['jumlah'];

    $query = "INSERT INTO transaksi (tanggal, kategori, deskripsi, jumlah) 
            VALUES ('$tanggal', '$kategori', '$deskripsi', '$jumlah')";
    mysqli_query($conn, $query);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
</head>
<body>
    <h2>Tambah Transaksi</h2>

    <form method="post">
        <label>Tanggal:</label><br>
        <input type="date" name="tanggal" required><br><br>

        <label>Kategori:</label><br>
        <select name="kategori" required>
            <option value="">-- Pilih --</option>
            <option value="Pemasukan">Pemasukan</option>
            <option value="Pengeluaran">Pengeluaran</option>
        </select><br><br>

        <label>Deskripsi:</label><br>
        <input type="text" name="deskripsi" required><br><br>

        <label>Jumlah (Rp):</label><br>
        <input type="number" name="jumlah" required><br><br>

        <input type="submit" value="Simpan">
        <a href="index.php">Batal</a>
    </form>
</body>
</html>

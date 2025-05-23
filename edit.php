<?php
include 'config.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal   = $_POST['tanggal'];
    $kategori  = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $jumlah    = $_POST['jumlah'];

    $update = "UPDATE transaksi 
            SET tanggal='$tanggal', kategori='$kategori', deskripsi='$deskripsi', jumlah='$jumlah' 
            WHERE id=$id";
    mysqli_query($conn, $update);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaksi</title>
</head>
<body>
    <h2>Edit Transaksi</h2>

    <form method="post">
        <label>Tanggal:</label><br>
        <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" required><br><br>

        <label>Kategori:</label><br>
        <select name="kategori" required>
            <option value="Pemasukan" <?= $data['kategori'] == 'Pemasukan' ? 'selected' : '' ?>>Pemasukan</option>
            <option value="Pengeluaran" <?= $data['kategori'] == 'Pengeluaran' ? 'selected' : '' ?>>Pengeluaran</option>
        </select><br><br>

        <label>Deskripsi:</label><br>
        <input type="text" name="deskripsi" value="<?= $data['deskripsi'] ?>" required><br><br>

        <label>Jumlah (Rp):</label><br>
        <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" required><br><br>

        <input type="submit" value="Update">
        <a href="index.php">Batal</a>
    </form>
</body>
</html>

<?php
include 'config.php';

// Ambil bulan dan tahun dari filter (jika ada), default: bulan & tahun sekarang
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

// Query total pemasukan
$q1 = mysqli_query($conn, "SELECT SUM(jumlah) as total FROM transaksi 
        WHERE kategori='Pemasukan' AND MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun'");
$pemasukan = mysqli_fetch_assoc($q1)['total'] ?? 0;

// Query total pengeluaran
$q2 = mysqli_query($conn, "SELECT SUM(jumlah) as total FROM transaksi 
        WHERE kategori='Pengeluaran' AND MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun'");
$pengeluaran = mysqli_fetch_assoc($q2)['total'] ?? 0;

$saldo = $pemasukan - $pengeluaran;

// Ambil data transaksi
$data = mysqli_query($conn, "SELECT * FROM transaksi 
        WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Catatan Keuangan</title>
</head>
<body>
    <h2>Catatan Keuangan Bulanan</h2>

    <!-- Filter -->
    <form method="get">
        Bulan:
        <select name="bulan">
            <?php for ($i=1; $i<=12; $i++): 
                $bln = str_pad($i, 2, "0", STR_PAD_LEFT); ?>
                <option value="<?= $bln ?>" <?= ($bln==$bulan) ? 'selected' : '' ?>>
                    <?= date('F', mktime(0,0,0,$i,10)) ?>
                </option>
            <?php endfor; ?>
        </select>

        Tahun:
        <select name="tahun">
            <?php for ($t=2020; $t<=date('Y'); $t++): ?>
                <option value="<?= $t ?>" <?= ($t==$tahun) ? 'selected' : '' ?>><?= $t ?></option>
            <?php endfor; ?>
        </select>

        <input type="submit" value="Filter">
    </form>

    <br>

    <!-- Info Ringkasan -->
    <div>
        <strong>Total Pemasukan:</strong> Rp <?= number_format($pemasukan,0,",",".") ?><br>
        <strong>Total Pengeluaran:</strong> Rp <?= number_format($pengeluaran,0,",",".") ?><br>
        <strong>Saldo:</strong> Rp <?= number_format($saldo,0,",",".") ?>
    </div>

    <br>

    <!-- Tombol tambah -->
    <a href="tambah.php">+ Tambah Transaksi</a>

    <br><br>

    <!-- Tabel Data -->
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Tanggal</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Jumlah (Rp)</th>
            <th>Aksi</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($data)): ?>
        <tr>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['kategori'] ?></td>
            <td><?= $row['deskripsi'] ?></td>
            <td><?= number_format($row['jumlah'],0,",",".") ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

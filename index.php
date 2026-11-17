<?php
require_once 'koneksi.php';
require_once 'functions.php';

$sql = 'SELECT * FROM data_barang ORDER BY id_barang ASC';
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Gagal mengambil data barang. Periksa tabel data_barang.');
}
$jumlah = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang | Lab8Web</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="topbar">
    <div class="brand"><span class="brand-mark">LB</span><span>Lab8Web <small>Inventory</small></span></div>
    <span class="top-note">Praktikum 8 · PHP &amp; MySQL</span>
</header>
<main class="container">
    <section class="page-heading">
        <div>
            <p class="eyebrow">DASHBOARD INVENTARIS</p>
            <h1>Data Barang</h1>
            <p class="muted">Kelola daftar barang, harga, dan stok dengan mudah.</p>
        </div>
        <a class="button primary" href="tambah.php">＋ Tambah Barang</a>
    </section>

    <section class="summary-card">
        <div class="summary-icon">▦</div>
        <div><span class="muted">Total jenis barang</span><strong><?= $jumlah; ?> <small>item</small></strong></div>
    </section>

    <section class="panel">
        <div class="panel-heading"><div><h2>Daftar Inventaris</h2><p class="muted">Data tersimpan pada database latihan1.</p></div></div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Barang</th><th>Kategori</th><th>Harga Beli</th><th>Harga Jual</th><th>Stok</th><th class="action-head">Aksi</th></tr></thead>
                <tbody>
                <?php if ($jumlah > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><div class="product-cell"><img class="product-thumb" src="gambar/<?= e($row['gambar'] ?: 'placeholder.svg'); ?>" alt="<?= e($row['nama']); ?>"><div><strong><?= e($row['nama']); ?></strong><small>ID #<?= (int)$row['id_barang']; ?></small></div></div></td>
                        <td><span class="tag"><?= e($row['kategori']); ?></span></td>
                        <td><?= rupiah($row['harga_beli']); ?></td>
                        <td class="price-strong"><?= rupiah($row['harga_jual']); ?></td>
                        <td><span class="stock-pill"><?= (int)$row['stok']; ?> unit</span></td>
                        <td><div class="actions"><a class="button small light" href="ubah.php?id=<?= (int)$row['id_barang']; ?>">Ubah</a><a class="button small danger" href="hapus.php?id=<?= (int)$row['id_barang']; ?>" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a></div></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td class="empty" colspan="6">Belum ada data barang. Klik Tambah Barang untuk mulai mengisi.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
    <p class="footer-note">Lab8Web · Aplikasi CRUD sederhana berbasis PHP dan MySQL</p>
</main>
</body>
</html>

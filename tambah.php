<?php
require_once 'koneksi.php';
require_once 'functions.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $harga_jual = (float)($_POST['harga_jual'] ?? 0);
    $harga_beli = (float)($_POST['harga_beli'] ?? 0);
    $stok = (int)($_POST['stok'] ?? 0);
    $gambar = upload_gambar();

    if ($nama === '' || $kategori === '' || $harga_jual < 0 || $harga_beli < 0 || $stok < 0) {
        $error = 'Lengkapi data dengan benar. Harga dan stok tidak boleh negatif.';
    } elseif ($gambar === false) {
        $error = 'Gambar tidak valid. Gunakan JPG, PNG, atau WEBP maksimal 2 MB.';
    } else {
        $stmt = mysqli_prepare($conn, 'INSERT INTO data_barang (kategori, nama, gambar, harga_beli, harga_jual, stok) VALUES (?, ?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'sssddi', $kategori, $nama, $gambar, $harga_beli, $harga_jual, $stok);
        if (mysqli_stmt_execute($stmt)) {
            header('Location: index.php?status=tambah');
            exit;
        }
        $error = 'Data gagal disimpan. Silakan periksa kembali.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Tambah Barang | Lab8Web</title><link rel="stylesheet" href="style.css"></head>
<body>
<header class="topbar"><div class="brand"><span class="brand-mark">LB</span><span>Lab8Web <small>Inventory</small></span></div><a class="back-link" href="index.php">← Kembali ke daftar</a></header>
<main class="container form-container">
    <p class="eyebrow">CREATE · DATA BARANG</p><h1>Tambah Barang</h1><p class="muted intro">Isi informasi barang yang akan dimasukkan ke inventaris.</p>
    <?php if ($error !== ''): ?><div class="alert error"><?= e($error); ?></div><?php endif; ?>
    <section class="panel form-panel">
        <form method="post" action="tambah.php" enctype="multipart/form-data">
            <div class="form-grid">
                <label>Nama Barang<input type="text" name="nama" placeholder="Contoh: HP Samsung Android" value="<?= e($_POST['nama'] ?? ''); ?>" required></label>
                <label>Kategori<select name="kategori" required><option value="">Pilih kategori</option><option>Komputer</option><option>Elektronik</option><option>Hand Phone</option></select></label>
                <label>Harga Jual<input type="number" name="harga_jual" min="0" placeholder="2400000" value="<?= e($_POST['harga_jual'] ?? ''); ?>" required></label>
                <label>Harga Beli<input type="number" name="harga_beli" min="0" placeholder="2000000" value="<?= e($_POST['harga_beli'] ?? ''); ?>" required></label>
                <label>Stok<input type="number" name="stok" min="0" placeholder="5" value="<?= e($_POST['stok'] ?? ''); ?>" required></label>
                <label class="file-label">File Gambar<span class="file-help">JPG, PNG, atau WEBP · Maks. 2 MB</span><input type="file" name="file_gambar" accept="image/jpeg,image/png,image/webp"></label>
            </div>
            <div class="form-actions"><a class="button light" href="index.php">Batal</a><button class="button primary" type="submit">Simpan Barang</button></div>
        </form>
    </section>
</main>
</body>
</html>

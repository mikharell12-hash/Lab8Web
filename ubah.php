<?php
require_once 'koneksi.php';
require_once 'functions.php';

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$stmt = mysqli_prepare($conn, 'SELECT * FROM data_barang WHERE id_barang = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$data) {
    http_response_code(404);
    die('Data barang tidak ditemukan. <a href="index.php">Kembali</a>');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $harga_jual = (float)($_POST['harga_jual'] ?? 0);
    $harga_beli = (float)($_POST['harga_beli'] ?? 0);
    $stok = (int)($_POST['stok'] ?? 0);
    $gambar_baru = upload_gambar();

    if ($nama === '' || $kategori === '' || $harga_jual < 0 || $harga_beli < 0 || $stok < 0) {
        $error = 'Lengkapi data dengan benar. Harga dan stok tidak boleh negatif.';
    } elseif ($gambar_baru === false) {
        $error = 'Gambar tidak valid. Gunakan JPG, PNG, atau WEBP maksimal 2 MB.';
    } else {
        $gambar = $gambar_baru ?? $data['gambar'];
        $update = mysqli_prepare($conn, 'UPDATE data_barang SET nama = ?, kategori = ?, harga_jual = ?, harga_beli = ?, stok = ?, gambar = ? WHERE id_barang = ?');
        mysqli_stmt_bind_param($update, 'ssddisi', $nama, $kategori, $harga_jual, $harga_beli, $stok, $gambar, $id);
        if (mysqli_stmt_execute($update)) {
            header('Location: index.php?status=ubah');
            exit;
        }
        $error = 'Data gagal diperbarui. Silakan coba lagi.';
    }
}

function is_selected(string $value, string $selected): string
{
    return $value === $selected ? 'selected' : '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Ubah Barang | Lab8Web</title><link rel="stylesheet" href="style.css"></head>
<body>
<header class="topbar"><div class="brand"><span class="brand-mark">LB</span><span>Lab8Web <small>Inventory</small></span></div><a class="back-link" href="index.php">← Kembali ke daftar</a></header>
<main class="container form-container">
    <p class="eyebrow">UPDATE · DATA BARANG #<?= (int)$data['id_barang']; ?></p><h1>Ubah Barang</h1><p class="muted intro">Perbarui informasi barang, lalu simpan perubahan.</p>
    <?php if ($error !== ''): ?><div class="alert error"><?= e($error); ?></div><?php endif; ?>
    <section class="panel form-panel">
        <form method="post" action="ubah.php?id=<?= (int)$id; ?>" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= (int)$id; ?>">
            <div class="form-grid">
                <label>Nama Barang<input type="text" name="nama" value="<?= e($_POST['nama'] ?? $data['nama']); ?>" required></label>
                <label>Kategori<select name="kategori" required><option value="Komputer" <?= is_selected('Komputer', $data['kategori']); ?>>Komputer</option><option value="Elektronik" <?= is_selected('Elektronik', $data['kategori']); ?>>Elektronik</option><option value="Hand Phone" <?= is_selected('Hand Phone', $data['kategori']); ?>>Hand Phone</option></select></label>
                <label>Harga Jual<input type="number" name="harga_jual" min="0" value="<?= e($_POST['harga_jual'] ?? $data['harga_jual']); ?>" required></label>
                <label>Harga Beli<input type="number" name="harga_beli" min="0" value="<?= e($_POST['harga_beli'] ?? $data['harga_beli']); ?>" required></label>
                <label>Stok<input type="number" name="stok" min="0" value="<?= e($_POST['stok'] ?? $data['stok']); ?>" required></label>
                <label class="file-label">Ganti File Gambar<span class="file-help">Kosongkan jika gambar tidak ingin diganti.</span><input type="file" name="file_gambar" accept="image/jpeg,image/png,image/webp"></label>
            </div>
            <div class="form-actions"><a class="button light" href="index.php">Batal</a><button class="button primary" type="submit">Simpan Perubahan</button></div>
        </form>
    </section>
</main>
</body>
</html>

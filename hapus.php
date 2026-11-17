<?php
require_once 'koneksi.php';
$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = mysqli_prepare($conn, 'DELETE FROM data_barang WHERE id_barang = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
}

header('Location: index.php?status=hapus');
exit;

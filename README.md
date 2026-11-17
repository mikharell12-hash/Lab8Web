# Lab8Web - CRUD Data Barang dengan PHP dan MySQL

Project ini dibuat untuk **Praktikum 8: PHP dan Database MySQL**. Aplikasi sederhana ini mengelola data barang menggunakan operasi CRUD (Create, Read, Update, Delete).

## Tujuan

1. Memahami konsep dasar database.
2. Memahami konsep dasar CRUD menggunakan PHP.
3. Membuat program CRUD sederhana menggunakan PHP dan MySQL.

## Teknologi

- PHP dengan ekstensi MySQLi
- MySQL / MariaDB
- HTML dan CSS
- XAMPP sebagai web server lokal

## Struktur File

```text
Lab8Web/
├── database.sql          # Pembuatan database, tabel, dan data awal
├── koneksi.php           # Koneksi PHP ke MySQL
├── functions.php         # Fungsi bantuan dan upload gambar
├── index.php             # Menampilkan daftar barang (Read)
├── tambah.php            # Menambahkan barang (Create)
├── ubah.php              # Mengubah barang (Update)
├── hapus.php             # Menghapus barang (Delete)
├── style.css             # Tampilan aplikasi
├── gambar/               # Gambar barang contoh dan hasil upload
└── screenshot/           # Pratinjau tampilan setiap tahap
```

## Cara Menjalankan

1. Pastikan XAMPP sudah terpasang.
2. Salin folder `Lab8Web` ke direktori `C:\\xampp\\htdocs\\`.
3. Jalankan **Apache** dan **MySQL** dari XAMPP Control Panel.
4. Buka `http://localhost/phpmyadmin/`.
5. Pilih menu **Import**, lalu pilih file `database.sql` dari folder project dan jalankan proses import. File tersebut membuat database `latihan1`, tabel `data_barang`, dan tiga data contoh.
6. Periksa pengaturan database pada `koneksi.php`. Pengaturan bawaan XAMPP yang digunakan adalah host `localhost`, user `root`, password kosong, dan database `latihan1`. Sesuaikan bila konfigurasi lokal berbeda.
7. Buka aplikasi melalui `http://localhost/Lab8Web/`.

## Langkah Kerja

### 1. Persiapan Database

Database bernama `latihan1` dibuat dengan tabel `data_barang`. Kolom tabel terdiri dari `id_barang`, `kategori`, `nama`, `gambar`, `harga_beli`, `harga_jual`, dan `stok`. Tiga data barang contoh mengikuti data pada modul praktikum.

### 2. Koneksi Database

File `koneksi.php` menghubungkan aplikasi ke MySQL menggunakan `mysqli_connect()`. Jika koneksi gagal, aplikasi menampilkan pesan kesalahan.

### 3. Menampilkan Data (Read)

File `index.php` menjalankan query `SELECT` dan menampilkan semua barang pada tabel inventaris.

### 4. Menambah Data (Create)

File `tambah.php` menampilkan form barang dan menyimpan isian ke database menggunakan query `INSERT`. Pengguna dapat mengunggah gambar JPG, PNG, atau WEBP dengan ukuran maksimal 2 MB.

### 5. Mengubah Data (Update)

File `ubah.php` mengambil data berdasarkan `id_barang`, menampilkan nilainya pada form, kemudian menyimpan perubahan menggunakan query `UPDATE`. Gambar lama tetap digunakan apabila pengguna tidak mengunggah gambar baru.

### 6. Menghapus Data (Delete)

File `hapus.php` menerima ID barang dan menjalankan query `DELETE`. Pada daftar barang, pengguna diminta mengonfirmasi sebelum membuka proses penghapusan.

## Screenshot

> **Catatan:** gambar pada folder ini adalah *pratinjau simulasi tampilan* dengan data contoh. Gambar dibuat untuk memperlihatkan rancangan halaman, bukan bukti aplikasi telah dijalankan atau terhubung ke MySQL di XAMPP. Setelah menjalankan project secara lokal, ambil screenshot aktual dan ganti gambar ini bila diperlukan untuk bukti praktikum.

### Dashboard / Read

![Pratinjau dashboard](screenshot/dashboard.png)

### Form Tambah / Create

![Pratinjau tambah barang](screenshot/tambah.png)

### Form Ubah / Update

![Pratinjau ubah barang](screenshot/ubah.png)

### Konfirmasi Hapus / Delete

![Pratinjau hapus barang](screenshot/hapus.png)

## Catatan Implementasi

- Query tambah, ubah, dan hapus menggunakan prepared statement.
- Output teks ditampilkan menggunakan `htmlspecialchars()` untuk mengurangi risiko HTML injection.
- Upload gambar dibatasi ke JPG, PNG, dan WEBP dengan ukuran maksimal 2 MB.
- Data dan pengaturan koneksi dapat disesuaikan dengan kebutuhan saat menjalankan project.

## Penulis

- **Nama:** Alleizandro Lim Hianto Prasetya
- **NIM:** 31251****
- **Kelas:** I252A
- **Program Studi:** Teknik Informatika
- **Mata Kuliah:** Pemrograman Web

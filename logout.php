<?php
session_start(); // Memulai sesi untuk mengakses data sesi yang sudah ada.
session_destroy(); // Menghapus semua data sesi, termasuk data pengguna yang login.
header("Location: login.php"); // Mengarahkan pengguna ke halaman login setelah logout.
exit; // Menghentikan eksekusi script untuk memastikan tidak ada kode tambahan yang dieksekusi.
?>

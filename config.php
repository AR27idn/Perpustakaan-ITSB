<?php
// Menyembunyikan pesan error
ini_set('display_errors', 0); // Mengatur agar pesan error tidak ditampilkan ke pengguna.
error_reporting(E_ALL); // Mengatur level error yang akan dilaporkan (semua jenis error).

// Koneksi ke database
$host = 'localhost'; // Nama host untuk server database, biasanya "localhost".
$username = 'root'; // Nama pengguna untuk koneksi database.
$password = ''; // Kata sandi untuk koneksi database.
$dbname = 'sistem_pengelolaan_data'; // Nama database yang akan digunakan.

try {
    // Membuat koneksi ke database menggunakan PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mengatur mode error agar PDO melempar exception.
} catch (PDOException $e) {
    // Menangkap error jika koneksi ke database gagal
    die("Koneksi gagal: " . $e->getMessage()); // Menghentikan script dan menampilkan pesan error.
}
?>

<?php
session_start(); // Memulai sesi untuk menampilkan pesan sukses atau error
require_once 'config.php'; // Mengimpor file koneksi database

try {
    // Query untuk mengambil semua data anggota dari tabel 'anggota'
    $stmt = $conn->query("SELECT * FROM anggota");
    $anggotaList = $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengambil semua data anggota dalam bentuk array asosiatif
} catch (PDOException $e) {
    // Menampilkan pesan error jika terjadi kesalahan pada query
    die("Terjadi kesalahan: " . htmlspecialchars($e->getMessage()));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Mengatur encoding halaman menjadi UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Membuat halaman responsif -->
    <title>Daftar Anggota</title> <!-- Judul halaman -->
    <style>
        /* Gaya umum untuk halaman */
        body {
            font-family: Arial, sans-serif; /* Mengatur font utama */
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Latar belakang gambar */
            background-size: 100%; /* Menyesuaikan ukuran gambar latar belakang */
            margin: 0; /* Menghilangkan margin default browser */
            padding: 0; /* Menghilangkan padding default browser */
        }

        /* Gaya untuk container utama */
        .container {
            max-width: 1000px; /* Lebar maksimum container */
            margin: 20px auto; /* Margin otomatis agar terpusat */
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan transparansi 90% */
            padding: 20px; /* Memberikan ruang dalam container */
            border-radius: 8px; /* Membulatkan sudut container */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Memberikan efek bayangan */
        }

        /* Gaya untuk heading */
        h1 {
            text-align: center; /* Mengatur teks agar berada di tengah */
            color: #333; /* Warna teks */
        }

        /* Gaya untuk tabel */
        table {
            width: 100%; /* Lebar penuh tabel */
            border-collapse: collapse; /* Menggabungkan border tabel */
            margin-top: 20px; /* Memberikan jarak atas tabel */
        }

        /* Gaya untuk border tabel */
        table, th, td {
            border: 1px solid #ccc; /* Warna dan ukuran border */
        }

        /* Gaya untuk sel tabel */
        th, td {
            padding: 10px; /* Memberikan ruang dalam sel tabel */
            text-align: left; /* Mengatur teks rata kiri */
        }

        /* Gaya untuk header tabel */
        th {
            background-color: #f2f2f2; /* Warna latar belakang header tabel */
        }

        /* Gaya untuk link */
        a {
            color: #007bff; /* Warna biru untuk teks link */
            text-decoration: none; /* Menghilangkan garis bawah pada link */
            font-weight: bold; /* Memberikan efek tebal pada teks link */
        }

        /* Gaya untuk pesan alert */
        .alert {
            padding: 10px; /* Ruang dalam alert */
            margin-bottom: 20px; /* Jarak bawah alert */
            border-radius: 5px; /* Membulatkan sudut alert */
            color: #fff; /* Warna teks */
        }

        .alert-success {
            background-color: #28a745; /* Warna hijau untuk pesan sukses */
        }

        .alert-error {
            background-color: #dc3545; /* Warna merah untuk pesan error */
        }

        /* Gaya untuk tombol aksi */
        .button {
            display: inline-block; /* Menampilkan tombol sebagai blok inline */
            background-color: #007bff; /* Warna biru tombol */
            color: #fff; /* Warna teks tombol */
            padding: 10px 15px; /* Ruang dalam tombol */
            border: none; /* Menghilangkan border tombol */
            border-radius: 4px; /* Membulatkan sudut tombol */
            cursor: pointer; /* Mengubah kursor saat hover */
            font-size: 16px; /* Ukuran font */
            text-decoration: none; /* Menghilangkan garis bawah */
            text-align: center; /* Mengatur teks di tengah */
        }

        .button:hover {
            background-color: #0056b3; /* Warna biru lebih gelap saat hover */
        }

        /* Gaya untuk tombol cancel */
        .btn-cancel {
            background-color: #6c757d; /* Warna abu-abu untuk tombol cancel */
        }

        .btn-cancel:hover {
            background-color: #5a6268; /* Warna abu-abu lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <div class="container"> <!-- Container utama untuk konten -->
        <h1>Daftar Anggota</h1> <!-- Judul halaman -->

        <!-- Tampilkan pesan sukses atau error -->
        <?php if (isset($_SESSION['success_message'])): ?> <!-- Jika ada pesan sukses -->
            <div class="alert alert-success"><?= $_SESSION['success_message']; ?></div> <!-- Menampilkan pesan sukses -->
            <?php unset($_SESSION['success_message']); ?> <!-- Menghapus pesan sukses dari sesi -->
        <?php elseif (isset($_SESSION['error_message'])): ?> <!-- Jika ada pesan error -->
            <div class="alert alert-error"><?= $_SESSION['error_message']; ?></div> <!-- Menampilkan pesan error -->
            <?php unset($_SESSION['error_message']); ?> <!-- Menghapus pesan error dari sesi -->
        <?php endif; ?>

        <!-- Tabel daftar anggota -->
        <table>
            <thead>
                <tr>
                    <th>ID</th> <!-- Header kolom ID -->
                    <th>Nama</th> <!-- Header kolom Nama -->
                    <th>Email</th> <!-- Header kolom Email -->
                    <th>Telepon</th> <!-- Header kolom Telepon -->
                    <th>Aksi</th> <!-- Header kolom Aksi -->
                </tr>
            </thead>
            <tbody>
                <!-- Iterasi data anggota untuk ditampilkan dalam tabel -->
                <?php foreach ($anggotaList as $anggota): ?>
                <tr>
                    <td><?= htmlspecialchars($anggota['id_anggota']); ?></td> <!-- Menampilkan ID anggota -->
                    <td><?= htmlspecialchars($anggota['nama']); ?></td> <!-- Menampilkan Nama anggota -->
                    <td><?= htmlspecialchars($anggota['email']); ?></td> <!-- Menampilkan Email anggota -->
                    <td><?= htmlspecialchars($anggota['telepon']); ?></td> <!-- Menampilkan Telepon anggota -->
                    <td>
                        <!-- Link untuk melakukan update anggota -->
                        <a href="proses_update_anggota.php?id_anggota=<?= htmlspecialchars($anggota['id_anggota']); ?>" class="button">Update</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

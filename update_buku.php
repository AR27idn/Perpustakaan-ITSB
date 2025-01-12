<?php
session_start(); // Memulai session untuk menyimpan data sementara antar halaman.
require_once 'config.php'; // Mengimpor file konfigurasi untuk koneksi database.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Menentukan encoding karakter untuk dokumen. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Membuat halaman responsif. -->
    <title>Pilih Buku untuk Update</title> <!-- Judul halaman. -->
    <style>
        /* Gaya CSS untuk mempercantik halaman. */
        body {
            font-family: Arial, sans-serif;
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Latar belakang gambar. */
            background-size: 100%; /* Ukuran gambar latar. */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.9); /* Latar belakang putih dengan transparansi. */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek bayangan. */
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #d4edda; /* Border untuk pesan sukses. */
            border-radius: 5px;
            background-color: #d4edda; /* Warna latar hijau. */
            color: #155724; /* Warna teks hijau. */
        }
        table {
            width: 100%; /* Tabel memenuhi lebar container. */
            border-collapse: collapse; /* Menghilangkan jarak antar border tabel. */
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd; /* Border untuk sel tabel. */
            text-align: left; /* Teks rata kiri. */
        }
        table th {
            background-color: #f0f0f0; /* Warna latar untuk header tabel. */
        }
        a {
            text-decoration: none;
            color: #007bff; /* Warna teks untuk tautan. */
        }
        .button {
            display: inline-block;
            background-color: #007bff; /* Warna latar tombol. */
            color: #fff; /* Warna teks tombol. */
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            text-align: center;
        }

        .button:hover {
            background-color: #0056b3; /* Warna latar tombol saat hover. */
        }

        .btn-cancel {
            background-color: #6c757d; /* Warna tombol batal. */
        }

        .btn-cancel:hover {
            background-color: #5a6268; /* Warna tombol batal saat hover. */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pilih Buku untuk Update</h2>

        <?php
        // Tampilkan pesan sukses jika ada.
        if (isset($_SESSION['success_message'])) {
            echo "<div class='alert'>{$_SESSION['success_message']}</div>"; // Menampilkan pesan sukses dari session.
            unset($_SESSION['success_message']); // Hapus pesan setelah ditampilkan untuk menghindari duplikasi.
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th> <!-- Kolom ID buku. -->
                    <th>Judul</th> <!-- Kolom judul buku. -->
                    <th>Pengarang</th> <!-- Kolom pengarang buku. -->
                    <th>Penerbit</th> <!-- Kolom penerbit buku. -->
                    <th>Tahun Terbit</th> <!-- Kolom tahun terbit buku. -->
                    <th>Aksi</th> <!-- Kolom aksi untuk update. -->
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Mengambil semua data buku dari tabel 'buku'.
                    $stmt = $conn->prepare("SELECT * FROM buku");
                    $stmt->execute();
                    $buku = $stmt->fetchAll(PDO::FETCH_ASSOC); // Mendapatkan hasil dalam bentuk array asosiatif.

                    // Loop untuk menampilkan data buku.
                    foreach ($buku as $row) {
                        echo "
                            <tr>
                                <td>{$row['id_buku']}</td> <!-- Menampilkan ID buku. -->
                                <td>{$row['judul_buku']}</td> <!-- Menampilkan judul buku. -->
                                <td>{$row['pengarang']}</td> <!-- Menampilkan pengarang buku. -->
                                <td>{$row['penerbit']}</td> <!-- Menampilkan penerbit buku. -->
                                <td>{$row['tahun_terbit']}</td> <!-- Menampilkan tahun terbit buku. -->
                                <td><a href='proses_update_buku.php?id={$row['id_buku']}' class='button'>Edit</a></td> <!-- Tombol edit buku. -->
                            </tr>
                        ";
                    }
                } catch (PDOException $e) {
                    // Tampilkan error jika terjadi kesalahan pada query.
                    echo "<tr><td colspan='6'>Terjadi kesalahan: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="iindex.php" class="button btn-cancel">Kembali Ke Beranda</a> <!-- Tombol kembali ke halaman utama. -->
    </div>
</body>
</html>

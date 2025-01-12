<?php
session_start(); // Memulai sesi untuk menyimpan atau mengambil data sesi pengguna
require_once 'config.php'; // Memasukkan file konfigurasi untuk koneksi database
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Metadata dan pengaturan dasar halaman -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Buku untuk Update</title>
    <style>
        /* Gaya CSS untuk mempercantik tampilan halaman */
        body {
            font-family: Arial, sans-serif;
            background: url('background perpus ITSB.jpg') no-repeat center center fixed;
            background-size: 100%;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #d4edda;
            border-radius: 5px;
            background-color: #d4edda;
            color: #155724;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #f0f0f0;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            text-align: center;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .btn-cancel {
            background-color: #6c757d;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pilih Buku untuk Update</h2>

        <?php
        // Menampilkan pesan sukses jika ada di sesi
        if (isset($_SESSION['success_message'])) {
            echo "<div class='alert'>{$_SESSION['success_message']}</div>";
            unset($_SESSION['success_message']); // Menghapus pesan setelah ditampilkan agar tidak muncul kembali
        }
        ?>

        <!-- Tabel untuk menampilkan data peminjaman -->
        <table>
            <thead>
                <tr>
                    <th>ID Peminjaman</th>
                    <th>Nama Anggota</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Query untuk mengambil data peminjaman dari database
                    $stmt = $conn->prepare("SELECT peminjaman.id_peminjaman, anggota.nama AS nama, buku.judul_buku, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali
                                            FROM peminjaman
                                            JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
                                            JOIN buku ON peminjaman.id_buku = buku.id_buku");
                    $stmt->execute(); // Menjalankan query
                    $buku = $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengambil semua hasil sebagai array asosiatif

                    // Iterasi melalui data untuk ditampilkan di tabel
                    foreach ($buku as $row) {
                        echo "
                            <tr>
                                <td>{$row['id_peminjaman']}</td>
                                <td>{$row['nama']}</td>
                                <td>{$row['judul_buku']}</td>
                                <td>{$row['tanggal_pinjam']}</td>
                                <td>{$row['tanggal_kembali']}</td>
                                <td><a href='proses_update_peminjaman.php?id={$row['id_peminjaman']}' class='button'>Edit</a></td>
                            </tr>
                        ";
                    }
                } catch (PDOException $e) {
                    // Menampilkan pesan error jika terjadi kesalahan koneksi atau query
                    echo "<tr><td colspan='6'>Terjadi kesalahan: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Tombol untuk kembali ke halaman beranda -->
        <a href="iindex.php" class="button btn-cancel">Kembali Ke Beranda</a>
    </div>
</body>
</html>

<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');  // Jika belum login, arahkan ke halaman login
    exit;  // Menghentikan eksekusi kode lebih lanjut
}

// Memuat konfigurasi database
require 'config.php';  // Mengimpor konfigurasi koneksi database
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <!-- Memuat Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Gaya CSS untuk tata letak halaman */
        body {
            font-family: Arial, sans-serif;
            background: url('background perpus ITSB.jpg') no-repeat center center fixed;
            background-size: 100%;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1, h2, h3 {
            text-align: center;
            color: rgb(16, 32, 47);
        }
        h2 {
            font-size: 2em;
            color: rgb(8, 8, 8);
            margin-top: -5px;
        }
        h3 {
            font-size: 1.6em;
            color: rgb(11, 19, 27);
            margin-top: 30px;
        }
        .buttons {
            text-align: center;
            margin-bottom: 20px;
        }
        .buttons .button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .buttons .button i {
            margin-right: 8px;
        }
        .buttons .button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table thead tr {
            background-color: #343a40;
            color: #fff;
        }
        table th, table td {
            border: 1px solid #dee2e6;
            text-align: left;
            padding: 12px;
        }
        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        table tbody tr:hover {
            background-color: #e9ecef;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        .logout-button {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            font-size: 0.875em;
            color: #fff;
            background-color: #dc3545;
            text-decoration: none;
            border-radius: 3px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .logout-button:hover {
            background-color: #c82333;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Tombol Logout -->
        <div class="logout">
            <a href="logout.php" class="logout-button">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>

        <!-- Menampilkan Nama Pengguna -->
        <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <h2>Database Perpustakaan ITSB 2025</h2>

        <!-- Bagian Buku -->
        <h3>Daftar Buku</h3>
        <div class="buttons">
            <!-- Link ke halaman untuk mengelola buku -->
            <a href="tambah_buku.php" class="button"><i class="fas fa-book"></i> Tambah Buku</a>
            <a href="cari_buku.php" class="button"><i class="fas fa-search"></i> Cari Buku</a>
            <a href="update_buku.php" class="button"><i class="fas fa-edit"></i> Update Buku</a>
            <a href="hapus_buku.php" class="button"><i class="fas fa-trash"></i> Hapus Buku</a>
        </div>

        <!-- Tabel Daftar Buku -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan daftar buku dari database
                try {
                    $stmt = $conn->query("SELECT * FROM buku ORDER BY id_buku ASC");
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // Menampilkan data buku di tabel
                            echo "<tr>
                                <td>" . htmlspecialchars($row['id_buku']) . "</td>
                                <td>" . htmlspecialchars($row['judul_buku']) . "</td>
                                <td>" . htmlspecialchars($row['pengarang']) . "</td>
                                <td>" . htmlspecialchars($row['penerbit']) . "</td>
                                <td>" . htmlspecialchars($row['tahun_terbit']) . "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data buku.</td></tr>";
                    }
                } catch (PDOException $e) {
                    // Menampilkan error jika terjadi masalah dengan query
                    echo "<tr><td colspan='5'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Bagian Anggota -->
        <h3>Daftar Anggota</h3>
        <div class="buttons">
            <!-- Link ke halaman untuk mengelola anggota -->
            <a href="tambah_anggota.php" class="button"><i class="fas fa-user-plus"></i> Tambah Anggota</a>
            <a href="cari_anggota.php" class="button"><i class="fas fa-search"></i> Cari Anggota</a>
            <a href="update_anggota.php" class="button"><i class="fas fa-user-edit"></i> Update Anggota</a>
            <a href="hapus_anggota.php" class="button"><i class="fas fa-user-times"></i> Hapus Anggota</a>
        </div>

        <!-- Tabel Daftar Anggota -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan daftar anggota dari database
                try {
                    $stmt = $conn->query("SELECT * FROM anggota ORDER BY id_anggota ASC");
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // Menampilkan data anggota di tabel
                            echo "<tr>
                                <td>" . htmlspecialchars($row['id_anggota']) . "</td>
                                <td>" . htmlspecialchars($row['nama']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['telepon']) . "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada data anggota.</td></tr>";
                    }
                } catch (PDOException $e) {
                    // Menampilkan error jika terjadi masalah dengan query
                    echo "<tr><td colspan='4'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Bagian Peminjaman -->
        <h3>Daftar Peminjaman</h3>
        <div class="buttons">
            <!-- Link ke halaman untuk mengelola peminjaman -->
            <a href="tambah_peminjaman.php" class="button"><i class="fas fa-plus-circle"></i> Tambah Peminjaman</a>
            <a href="cari_peminjaman.php" class="button"><i class="fas fa-search"></i> Cari Peminjaman</a>
            <a href="update_peminjaman.php" class="button"><i class="fas fa-edit"></i> Update Peminjaman</a>
            <a href="hapus_peminjaman.php" class="button"><i class="fas fa-trash"></i> Hapus Peminjaman</a>
        </div>

        <!-- Tabel Daftar Peminjaman -->
        <table>
            <thead>
                <tr>
                    <th>ID Peminjaman</th>
                    <th>Nama Anggota</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan daftar peminjaman dari database dengan join
                try {
                    $query = "
                        SELECT peminjaman.id_peminjaman, anggota.nama AS nama_anggota, buku.judul_buku AS judul_buku, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali
                        FROM peminjaman
                        INNER JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
                        INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
                        ORDER BY peminjaman.id_peminjaman ASC
                    ";
                    $stmt = $conn->query($query);

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // Menampilkan data peminjaman di tabel
                            echo "<tr>
                                <td>" . htmlspecialchars($row['id_peminjaman']) . "</td>
                                <td>" . htmlspecialchars($row['nama_anggota']) . "</td>
                                <td>" . htmlspecialchars($row['judul_buku']) . "</td>
                                <td>" . htmlspecialchars($row['tanggal_pinjam']) . "</td>
                                 <td>" . htmlspecialchars($row['tanggal_kembali']) . "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data peminjaman.</td></tr>";
                    }
                } catch (PDOException $e) {
                    // Menampilkan error jika terjadi masalah dengan query
                    echo "<tr><td colspan='5'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
</body>
</html>

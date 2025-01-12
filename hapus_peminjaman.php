<?php
// Koneksi ke database menggunakan PDO
include 'config.php'; // Memuat file konfigurasi untuk koneksi database

try {
    // Query untuk mengambil data peminjaman dari database
    $stmt = $conn->prepare("SELECT peminjaman.id_peminjaman, anggota.nama AS nama_anggota, buku.judul_buku, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali
                            FROM peminjaman
                            JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
                            JOIN buku ON peminjaman.id_buku = buku.id_buku");
    $stmt->execute(); // Menjalankan query
    $peminjaman_list = $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengambil hasil query dalam bentuk array asosiatif
} catch (PDOException $e) {
    // Jika terjadi kesalahan dalam query atau koneksi, tampilkan pesan error
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Peminjaman</title>
    <style>
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

        h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background: #3498db;
            color: #ffffff;
        }

        table tr:nth-child(even) {
            background: #f9f9f9;
        }

        table tr:hover {
            background: #f1f1f1;
        }

        .action-button {
            background: #e74c3c;
            color: #ffffff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .action-button:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
<?php if ($peminjaman_list): ?> 
            <!-- Jika ada data peminjaman, tampilkan dalam bentuk tabel -->
            <table>
                <thead>
                    <tr>
                        <!-- Header tabel -->
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($peminjaman_list as $index => $peminjaman): ?> 
                        <!-- Iterasi data peminjaman -->
                        <tr>
                            <td><?= $index + 1; ?></td> <!-- Nomor urut -->
                            <td><?= htmlspecialchars($peminjaman['nama_anggota']); ?></td> <!-- Nama anggota -->
                            <td><?= htmlspecialchars($peminjaman['judul_buku']); ?></td> <!-- Judul buku -->
                            <td><?= htmlspecialchars($peminjaman['tanggal_pinjam']); ?></td> <!-- Tanggal pinjam -->
                            <td><?= htmlspecialchars($peminjaman['tanggal_kembali']); ?></td> <!-- Tanggal kembali -->
                            <td>
                                <form action="proses_hapus_peminjaman.php" method="POST" style="display:inline;">
                                    <!-- Form untuk menghapus peminjaman -->
                                    <input type="hidden" name="id_peminjaman" value="<?= $peminjaman['id_peminjaman']; ?>">
                                    <!-- Mengirim ID peminjaman untuk diproses -->
                                    <button type="submit" class="action-button">Hapus</button> <!-- Tombol hapus -->
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- Jika tidak ada data peminjaman -->
            <p>Tidak ada data peminjaman untuk dihapus.</p>
        <?php endif; ?>

    </div>
</body>
</html>

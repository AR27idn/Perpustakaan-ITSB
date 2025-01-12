<?php
// Koneksi ke database menggunakan PDO
include 'config.php';

// Mendapatkan kata kunci pencarian dari parameter GET
$keyword = $_GET['keyword'] ?? ''; // Jika tidak ada nilai, maka default adalah string kosong

try {
    // Query untuk mencari data peminjaman berdasarkan ID
    $stmt = $conn->prepare("SELECT peminjaman.id_peminjaman, anggota.nama AS nama_anggota, buku.judul_buku, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali
                            FROM peminjaman
                            JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
                            JOIN buku ON peminjaman.id_buku = buku.id_buku
                            WHERE peminjaman.id_peminjaman LIKE ?");
    // Menjalankan query dengan parameter pencarian menggunakan wildcard
    $stmt->execute(["%$keyword%"]);
    // Mendapatkan hasil pencarian dalam bentuk array asosiatif
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Jika terjadi kesalahan, tampilkan pesan error
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"> <!-- Mengatur karakter encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur tampilan responsif -->
    <title>Hasil Pencarian Peminjaman</title>
    <style>
        /* CSS untuk membuat tampilan tabel hasil pencarian */
        body {
            font-family: Arial, sans-serif; /* Font utama */
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Gambar latar belakang */
            background-size: 100%; /* Menyesuaikan ukuran latar belakang */
            margin: 0; /* Menghapus margin bawaan */
            padding: 0; /* Menghapus padding bawaan */
        }
        .container {
            max-width: 1000px; /* Lebar maksimum container */
            margin: 20px auto; /* Menempatkan container di tengah */
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih transparan */
            padding: 20px; /* Memberikan jarak dalam container */
            border-radius: 8px; /* Membuat sudut membulat */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
        }

        table {
            width: 100%; /* Lebar tabel penuh */
            border-collapse: collapse; /* Menghapus jarak antar sel */
            margin-bottom: 20px; /* Jarak bawah tabel */
        }

        table th, table td {
            border: 1px solid #ddd; /* Garis pembatas antar sel */
            padding: 10px; /* Jarak dalam sel */
            text-align: left; /* Teks rata kiri */
        }

        table th {
            background: #3498db; /* Warna latar header tabel */
            color: #ffffff; /* Warna teks header tabel */
        }

        table tr:nth-child(even) {
            background: #f9f9f9; /* Warna latar untuk baris genap */
        }

        table tr:hover {
            background: #f1f1f1; /* Warna latar baris saat hover */
        }

        button {
            background: #3498db; /* Warna tombol */
            color: #ffffff; /* Warna teks tombol */
            border: none; /* Menghapus border tombol */
            padding: 10px 20px; /* Padding tombol */
            border-radius: 5px; /* Membulatkan sudut tombol */
            cursor: pointer; /* Mengubah kursor menjadi pointer */
            font-size: 16px; /* Ukuran font tombol */
            transition: background 0.3s ease; /* Transisi saat hover */
        }

        button:hover {
            background: #2980b9; /* Warna tombol saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hasil Pencarian Peminjaman</h2> <!-- Judul halaman -->
        <?php if ($results): ?> <!-- Jika ada hasil pencarian -->
            <table>
                <thead>
                    <tr>
                        <th>No</th> <!-- Kolom nomor -->
                        <th>ID Peminjaman</th> <!-- Kolom ID Peminjaman -->
                        <th>Nama Anggota</th> <!-- Kolom Nama Anggota -->
                        <th>Judul Buku</th> <!-- Kolom Judul Buku -->
                        <th>Tanggal Peminjaman</th> <!-- Kolom Tanggal Peminjaman -->
                        <th>Tanggal Pengembalian</th> <!-- Kolom Tanggal Pengembalian -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $index => $result): ?> <!-- Loop untuk menampilkan hasil -->
                        <tr>
                            <td><?= $index + 1; ?></td> <!-- Menampilkan nomor urut -->
                            <td><?= htmlspecialchars($result['id_peminjaman']); ?></td> <!-- Menampilkan ID Peminjaman -->
                            <td><?= htmlspecialchars($result['nama_anggota']); ?></td> <!-- Menampilkan Nama Anggota -->
                            <td><?= htmlspecialchars($result['judul_buku']); ?></td> <!-- Menampilkan Judul Buku -->
                            <td><?= htmlspecialchars($result['tanggal_pinjam']); ?></td> <!-- Menampilkan Tanggal Peminjaman -->
                            <td><?= htmlspecialchars($result['tanggal_kembali']); ?></td> <!-- Menampilkan Tanggal Pengembalian -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?> <!-- Jika tidak ada hasil pencarian -->
            <p>Tidak ada data ditemukan untuk kata kunci "<strong><?= htmlspecialchars($keyword); ?></strong>".</p>
        <?php endif; ?>
        <a href="cari_peminjaman.php"><button>Cari Lagi</button></a> <!-- Tombol kembali ke halaman pencarian -->
    </div>
</body>
</html>

<?php
require_once 'config.php'; // Mengimpor file koneksi database

// Memeriksa apakah ID anggota telah dikirim melalui parameter GET
if (isset($_GET['id_anggota'])) {
    $id_anggota = $_GET['id_anggota']; // Mengambil ID anggota dari parameter GET

    try {
        // Query untuk mencari anggota berdasarkan ID
        $stmt = $conn->prepare("SELECT * FROM anggota WHERE id_anggota = :id_anggota");
        $stmt->bindParam(':id_anggota', $id_anggota, PDO::PARAM_INT); // Menghubungkan parameter ID
        $stmt->execute(); // Menjalankan query

        $anggota = $stmt->fetch(PDO::FETCH_ASSOC); // Mengambil hasil pencarian
    } catch (PDOException $e) {
        // Menampilkan pesan kesalahan jika terjadi error pada query
        echo "Terjadi kesalahan: " . htmlspecialchars($e->getMessage());
        exit; // Menghentikan eksekusi jika terjadi kesalahan
    }
} else {
    // Menampilkan pesan kesalahan jika ID anggota tidak ditemukan pada parameter GET
    echo "ID anggota tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Mengatur encoding halaman menjadi UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Membuat halaman responsif -->
    <title>Hasil Pencarian</title> <!-- Judul halaman -->
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

        /* Gaya untuk tombol kembali */
        .btn-back {
            display: inline-block; /* Membuat tombol sebagai elemen blok inline */
            margin-top: 20px; /* Memberikan jarak atas tombol */
            padding: 10px 15px; /* Ruang dalam tombol */
            background-color: #007bff; /* Warna biru tombol */
            color: #fff; /* Warna teks tombol */
            text-decoration: none; /* Menghilangkan garis bawah pada teks */
            border-radius: 4px; /* Membulatkan sudut tombol */
            font-size: 16px; /* Ukuran font tombol */
        }

        /* Gaya hover tombol kembali */
        .btn-back:hover {
            background-color: #0056b3; /* Warna biru lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <div class="container"> <!-- Container utama untuk elemen konten -->
        <h1>Hasil Pencarian Anggota</h1> <!-- Judul halaman -->
        <?php if ($anggota): ?> <!-- Kondisi jika anggota ditemukan -->
            <table>
                <tr>
                    <th>ID</th>
                    <td><?php echo htmlspecialchars($anggota['id_anggota']); ?></td> <!-- Menampilkan ID anggota -->
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?php echo htmlspecialchars($anggota['nama']); ?></td> <!-- Menampilkan nama anggota -->
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($anggota['email']); ?></td> <!-- Menampilkan email anggota -->
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td><?php echo htmlspecialchars($anggota['telepon']); ?></td> <!-- Menampilkan telepon anggota -->
                </tr>
            </table>
        <?php else: ?> <!-- Kondisi jika anggota tidak ditemukan -->
            <p>Anggota dengan ID <strong><?php echo htmlspecialchars($id_anggota); ?></strong> tidak ditemukan.</p>
        <?php endif; ?>
        <a href="cari_anggota.php" class="btn-back">Kembali</a> <!-- Tombol kembali ke halaman pencarian -->
    </div>
</body>
</html>

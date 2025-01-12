<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Menentukan encoding karakter halaman sebagai UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsif untuk tampilan pada perangkat yang berbeda -->
    <title>Proses Hapus Anggota</title> <!-- Judul halaman -->
    <style>
        /* Gaya CSS untuk halaman */
        body {
            font-family: Arial, sans-serif; /* Font utama */
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Gambar latar tetap */
            background-size: 100%; /* Ukuran gambar latar */
            margin: 0; /* Menghapus margin default */
            padding: 0; /* Menghapus padding default */
        }
        .container {
            max-width: 1000px; /* Lebar maksimal kontainer */
            margin: 20px auto; /* Margin atas-bawah dan rata tengah secara horizontal */
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan transparansi */
            padding: 20px; /* Ruang di dalam kontainer */
            border-radius: 8px; /* Membulatkan sudut kontainer */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan untuk efek kedalaman */
        }
        h2 {
            color: #333; /* Warna teks heading */
        }
        p.success {
            color: #28a745; /* Warna teks pesan sukses */
            font-weight: bold; /* Teks lebih tebal */
        }
        p.error {
            color: #dc3545; /* Warna teks pesan error */
            font-weight: bold; /* Teks lebih tebal */
        }
        a {
            display: inline-block; /* Link tampil sebagai elemen blok */
            margin-top: 20px; /* Memberikan jarak atas */
            text-decoration: none; /* Menghapus garis bawah pada teks link */
            color: #007bff; /* Warna teks link */
            font-weight: bold; /* Teks lebih tebal */
        }
        a:hover {
            text-decoration: underline; /* Memberikan garis bawah saat link dihover */
        }
        .button {
            display: inline-block; /* Tampilkan tombol sebagai elemen blok */
            margin-top: 20px; /* Memberikan jarak atas */
            padding: 10px 20px; /* Ruang dalam tombol */
            text-decoration: none; /* Menghapus garis bawah pada link */
            color: #fff; /* Warna teks tombol */
            background-color: #007bff; /* Warna latar tombol */
            border-radius: 4px; /* Membulatkan sudut tombol */
            font-weight: bold; /* Teks lebih tebal */
            text-align: center; /* Teks rata tengah */
        }
        .button:hover {
            background-color: #0056b3; /* Warna tombol saat dihover */
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        require_once 'config.php'; // Mengimpor file konfigurasi untuk koneksi ke database

        // Memeriksa apakah request berasal dari metode POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_anggota = trim($_POST['id_anggota']); // Mengambil dan membersihkan input ID anggota

            // Validasi apakah input ID anggota kosong
            if (empty($id_anggota)) {
                echo '<p class="error">ID Anggota tidak boleh kosong!</p>';
                echo '<a href="hapus_anggota.php">Kembali</a>';
                exit; // Menghentikan eksekusi jika validasi gagal
            }

            try {
                // Menyiapkan query SQL untuk menghapus data anggota
                $stmt = $conn->prepare("DELETE FROM anggota WHERE id_anggota = :id_anggota");
                $stmt->bindValue(':id_anggota', $id_anggota, PDO::PARAM_INT); // Mengikat parameter ID anggota
                $stmt->execute(); // Menjalankan query

                // Memeriksa apakah data berhasil dihapus
                if ($stmt->rowCount() > 0) {
                    echo '<p class="success">Anggota berhasil dihapus!</p>';
                } else {
                    echo '<p class="error">Anggota tidak ditemukan.</p>'; // Jika ID anggota tidak ditemukan
                }
            } catch (PDOException $e) {
                // Menangani kesalahan koneksi atau query
                error_log("Database error: " . $e->getMessage()); // Menyimpan log kesalahan
                echo '<p class="error">Terjadi kesalahan pada server. Silakan coba lagi nanti.</p>';
            }
        } else {
            // Pesan error jika halaman diakses tanpa metode POST
            echo '<p class="error">Akses tidak valid.</p>';
        }
        ?>
        <a href="hapus_anggota.php" class="button">Kembali</a> <!-- Link untuk kembali ke halaman sebelumnya -->
    </div>
</body>
</html>

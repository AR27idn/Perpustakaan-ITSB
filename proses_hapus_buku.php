<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Hapus Buku</title>
    <style>
        /* Gaya untuk body halaman */
        body {
            font-family: Arial, sans-serif;
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Menetapkan gambar latar belakang */
            background-size: 100%; /* Mengatur ukuran latar belakang */
            margin: 0;
            padding: 0;
        }

        /* Gaya untuk container utama */
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan transparansi */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Gaya untuk heading */
        h2 {
            color: #333;
        }

        /* Gaya untuk pesan sukses */
        p.success {
            color: #28a745; /* Warna hijau untuk pesan sukses */
            font-weight: bold;
        }

        /* Gaya untuk pesan error */
        p.error {
            color: #dc3545; /* Warna merah untuk pesan error */
            font-weight: bold;
        }

        /* Gaya untuk tautan */
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff; /* Warna biru */
            font-weight: bold;
        }

        /* Gaya hover untuk tautan */
        a:hover {
            text-decoration: underline;
        }

        /* Gaya untuk tombol */
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff; /* Warna biru */
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
        }

        /* Gaya hover untuk tombol */
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        require_once 'config.php'; // Memuat file konfigurasi database

        // Memeriksa apakah metode HTTP adalah POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_buku = trim($_POST['id_buku']); // Mengambil ID Buku dari form dan menghapus spasi

            // Memeriksa apakah ID Buku kosong
            if (empty($id_buku)) {
                echo '<p class="error">ID Buku tidak boleh kosong!</p>'; // Pesan error jika kosong
                echo '<a href="hapus_buku.php">Kembali</a>'; // Tautan kembali ke halaman sebelumnya
                exit; // Menghentikan eksekusi kode
            }

            try {
                // Menyiapkan pernyataan SQL untuk menghapus buku berdasarkan ID
                $stmt = $conn->prepare("DELETE FROM buku WHERE id_buku = :id_buku");
                $stmt->bindValue(':id_buku', $id_buku, PDO::PARAM_INT); // Mengikat parameter ID
                $stmt->execute(); // Menjalankan pernyataan SQL

                // Memeriksa apakah ada baris yang terpengaruh (buku ditemukan dan dihapus)
                if ($stmt->rowCount() > 0) {
                    echo '<p class="success">Buku berhasil dihapus!</p>'; // Pesan sukses jika buku dihapus
                } else {
                    echo '<p class="error">Buku tidak ditemukan.</p>'; // Pesan error jika ID tidak ditemukan
                }
            } catch (PDOException $e) {
                // Menangkap kesalahan PDO dan mencatatnya ke log
                error_log("Database error: " . $e->getMessage());
                echo '<p class="error">Terjadi kesalahan pada server. Silakan coba lagi nanti.</p>'; // Pesan error umum
            }
        } else {
            // Jika halaman diakses tanpa metode POST, tampilkan pesan error
            echo '<p class="error">Akses tidak valid.</p>';
        }
        ?>
        <!-- Tombol kembali ke halaman hapus buku -->
        <a href="hapus_buku.php" class="button">Kembali</a>
    </div>
</body>
</html>

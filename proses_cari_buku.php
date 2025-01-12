<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Menentukan encoding karakter untuk dokumen -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Membuat halaman responsif -->
    <title>Hasil Pencarian Buku</title> <!-- Judul halaman -->
    <style>
        /* Gaya CSS untuk mempercantik tampilan halaman */
        body {
            font-family: Arial, sans-serif;
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Menambahkan gambar latar */
            background-size: 100%; /* Mengatur ukuran gambar latar */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan transparansi */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Memberikan efek bayangan */
        }
        h2 {
            color: #4a4a4a; /* Warna teks untuk judul */
        }
        table {
            width: 100%; /* Tabel memenuhi lebar container */
            border-collapse: collapse; /* Menghilangkan jarak antar border tabel */
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd; /* Border untuk sel tabel */
            padding: 10px;
            text-align: left; /* Teks rata kiri */
        }
        table th {
            background-color: #f0f0f0; /* Warna latar untuk header tabel */
        }
        p.error {
            color: #d9534f; /* Warna teks untuk pesan error */
            font-weight: bold;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff; /* Warna teks untuk tautan */
            font-weight: bold;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff; /* Warna teks untuk tombol */
            background-color: #007bff; /* Warna latar tombol */
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
        }
        .button:hover {
            background-color: #0056b3; /* Warna latar tombol saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        require_once 'config.php'; // Mengimpor file konfigurasi untuk koneksi database

        // Mengecek apakah metode request adalah POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $keyword = trim($_POST['keyword']); // Mengambil input kata kunci dari form

            // Validasi: Jika kata kunci kosong, tampilkan pesan error
            if (empty($keyword)) {
                echo '<p class="error">Kata kunci tidak boleh kosong!</p>'; // Pesan error untuk kata kunci kosong
                echo '<a href="cari_buku.php" class="button">Kembali</a>'; // Tombol untuk kembali ke halaman pencarian
                exit; // Menghentikan eksekusi jika validasi gagal
            }

            // Mengamankan input dengan htmlspecialchars untuk mencegah serangan XSS
            $keyword = htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');

            try {
                // Menyiapkan query untuk mencari buku berdasarkan judul
                $stmt = $conn->prepare("SELECT * FROM buku WHERE judul_buku LIKE :keyword");
                $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR); // Wildcards untuk pencarian
                $stmt->execute(); // Menjalankan query
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengambil semua hasil sebagai array asosiatif

                // Jika ada hasil pencarian
                if (count($results) > 0) {
                    echo "<h2>Hasil Pencarian:</h2>"; // Menampilkan judul bagian hasil pencarian
                    echo "<table>"; // Membuka tabel
                    echo "<tr><th>ID</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Tahun Terbit</th></tr>"; // Header tabel
                    foreach ($results as $row) { // Loop melalui setiap hasil
                        echo "<tr>
                                <td>" . htmlspecialchars($row['id_buku'], ENT_QUOTES, 'UTF-8') . "</td>
                                <td>" . htmlspecialchars($row['judul_buku'], ENT_QUOTES, 'UTF-8') . "</td>
                                <td>" . htmlspecialchars($row['pengarang'], ENT_QUOTES, 'UTF-8') . "</td>
                                <td>" . htmlspecialchars($row['penerbit'], ENT_QUOTES, 'UTF-8') . "</td>
                                <td>" . htmlspecialchars($row['tahun_terbit'], ENT_QUOTES, 'UTF-8') . "</td>
                              </tr>"; // Menampilkan data buku
                    }
                    echo "</table>"; // Menutup tabel
                } else {
                    // Jika tidak ada hasil ditemukan
                    echo '<p class="error">Buku tidak ditemukan. Silakan coba dengan kata kunci lain.</p>';
                }
            } catch (PDOException $e) {
                // Menangkap error dan mencatatnya ke log server
                error_log("Database error: " . $e->getMessage());
                echo '<p class="error">Terjadi kesalahan pada server. Silakan coba lagi nanti.</p>'; // Pesan error untuk pengguna
            }
        } else {
            // Jika metode request bukan POST
            echo '<p class="error">Akses tidak valid. Harap gunakan metode POST untuk pencarian.</p>';
        }
        ?>
        <a href="cari_buku.php" class="button">Kembali</a> <!-- Tombol untuk kembali ke halaman pencarian -->
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Proses Tambah Buku</title>
    <style>
        /* Mengatur gaya tampilan halaman */
        body {
            font-family: Arial, sans-serif;
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Latar belakang halaman */
            background-size: 100%; /* Menyesuaikan ukuran latar belakang */
            margin: 0;
            padding: 0;
        }
        .container {
            /* Membuat kotak putih transparan untuk konten */
            max-width: 1000px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan transparansi */
            padding: 20px;
            border-radius: 8px; /* Membulatkan sudut kotak */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Memberikan bayangan */
        }
        h2 {
            color: #333; /* Warna teks heading */
        }
        /* Gaya untuk pesan sukses dan error */
        p.success {
            color: #28a745;
            font-weight: bold;
        }
        p.error {
            color: #dc3545;
            font-weight: bold;
        }
        /* Gaya untuk tombol kembali */
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Memasukkan konfigurasi database
        require_once 'config.php';

        // Mengecek apakah form dikirim dengan metode POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mengambil data dari form dan menghilangkan spasi di awal/akhir
            $id_buku = trim($_POST['id_buku']);
            $judul = trim($_POST['judul']);
            $pengarang = trim($_POST['pengarang']);
            $penerbit = trim($_POST['penerbit']);
            $tahun_terbit = trim($_POST['tahun_terbit']);
        
            // Validasi input: Cek apakah ID buku valid
            if (empty($id_buku) || !is_numeric($id_buku) || $id_buku <= 0) {
                echo '<p class="error">ID Buku harus berupa angka positif.</p>';
                echo '<a href="tambah_buku.php" class="button">Kembali</a>';
                exit;
            }
            // Validasi input: Semua kolom harus diisi
            if (empty($judul) || empty($pengarang) || empty($penerbit) || empty($tahun_terbit)) {
                echo '<p class="error">Semua kolom harus diisi.</p>';
                echo '<a href="tambah_buku.php" class="button">Kembali</a>';
                exit;
            }
        
            // Cek apakah ID buku sudah ada di database
            try {
                $stmt = $conn->prepare("SELECT COUNT(*) FROM buku WHERE id_buku = :id_buku");
                $stmt->bindParam(':id_buku', $id_buku);
                $stmt->execute();
                $count = $stmt->fetchColumn(); // Mengambil jumlah data dengan ID buku yang sama
        
                // Jika ID buku sudah digunakan
                if ($count > 0) {
                    echo '<p class="error">ID Buku sudah digunakan. Silakan gunakan ID lain.</p>';
                    echo '<a href="tambah_buku.php" class="button">Kembali</a>';
                    exit;
                }
        
                // Menyimpan data ke dalam database
                $stmt = $conn->prepare("INSERT INTO buku (id_buku, judul_buku, pengarang, penerbit, tahun_terbit) 
                                        VALUES (:id_buku, :judul, :pengarang, :penerbit, :tahun_terbit)");
                // Mengikat parameter dengan data dari form
                $stmt->bindParam(':id_buku', $id_buku);
                $stmt->bindParam(':judul', $judul);
                $stmt->bindParam(':pengarang', $pengarang);
                $stmt->bindParam(':penerbit', $penerbit);
                $stmt->bindParam(':tahun_terbit', $tahun_terbit);
                $stmt->execute(); // Menjalankan query
        
                // Menampilkan pesan sukses
                echo '<p class="success">Buku berhasil ditambahkan!</p>';
            } catch (PDOException $e) {
                // Menangkap kesalahan dari database
                error_log("Database error: " . $e->getMessage());
                echo '<p class="error">Terjadi kesalahan pada server. Silakan coba lagi nanti.</p>';
            }
        } else {
            // Jika halaman diakses tanpa metode POST
            echo '<p class="error">Akses tidak valid.</p>';
        }
        ?>
        <!-- Tombol untuk kembali ke halaman tambah buku -->
        <a href="tambah_buku.php" class="button">Kembali</a>

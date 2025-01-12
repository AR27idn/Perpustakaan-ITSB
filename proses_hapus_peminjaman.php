<?php
// Koneksi ke database menggunakan PDO
include 'config.php'; // Memasukkan file konfigurasi untuk koneksi ke database

// Memeriksa apakah metode pengiriman data adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_peminjaman = $_POST['id_peminjaman']; // Mengambil ID peminjaman dari input form

    try {
        // Menyiapkan query untuk menghapus data peminjaman berdasarkan ID
        $stmt = $conn->prepare("DELETE FROM peminjaman WHERE id_peminjaman = ?");
        $stmt->execute([$id_peminjaman]); // Mengeksekusi query dengan parameter ID peminjaman

        $message = "Data peminjaman berhasil dihapus!"; // Pesan sukses jika penghapusan berhasil
    } catch (PDOException $e) {
        // Menangkap error jika terjadi masalah dengan query
        $message = "Error: " . $e->getMessage(); // Pesan error yang menjelaskan masalahnya
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Hapus Peminjaman</title>
    <style>
        /* Mengatur gaya umum untuk halaman */
        body {
            font-family: Arial, sans-serif;
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Mengatur background */
            background-size: 100%; /* Mengisi seluruh layar dengan gambar background */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px; /* Membatasi lebar maksimum */
            margin: 20px auto; /* Mengatur margin agar konten di tengah */
            background-color: rgba(255, 255, 255, 0.9); /* Memberikan latar putih dengan transparansi */
            padding: 20px;
            border-radius: 8px; /* Membulatkan sudut */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan */
        }

        /* Mengatur gaya untuk heading */
        h2 {
            text-align: center;
            color: #333333; /* Warna teks abu-abu gelap */
            margin-bottom: 20px;
        }

        /* Gaya untuk pesan feedback */
        .message {
            font-size: 16px;
            color: #555555; /* Warna teks abu-abu sedang */
            margin-bottom: 20px;
        }
        .success {
            color: #27ae60; /* Warna hijau untuk pesan sukses */
            font-weight: bold;
        }
        .error {
            color: #e74c3c; /* Warna merah untuk pesan error */
            font-weight: bold;
        }

        /* Gaya untuk tautan */
        a {
            display: inline-block; /* Membuat tautan terlihat seperti tombol */
            margin-top: 20px;
            text-decoration: none;
            color: #3498db; /* Warna biru untuk teks tautan */
            font-size: 14px;
        }
        a:hover {
            text-decoration: underline; /* Menambahkan garis bawah saat hover */
        }

        /* Gaya untuk tombol */
        button {
            background: #3498db; /* Warna biru untuk tombol */
            color: #ffffff; /* Warna teks putih */
            border: none;
            padding: 10px 20px; /* Mengatur padding tombol */
            border-radius: 5px; /* Membulatkan sudut tombol */
            cursor: pointer;
            font-size: 16px; /* Ukuran font tombol */
            transition: background 0.3s ease; /* Efek transisi saat hover */
            text-decoration: none;
        }
        button:hover {
            background: #2980b9; /* Warna biru lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Proses Hapus Peminjaman</h2>
        <!-- Menampilkan pesan sukses atau error dengan gaya sesuai -->
        <div class="message <?= strpos($message, 'berhasil') !== false ? 'success' : 'error'; ?>">
            <?= htmlspecialchars($message); ?> <!-- Melindungi dari XSS dengan htmlspecialchars -->
        </div>
        <!-- Tautan untuk kembali ke halaman sebelumnya atau halaman utama -->
        <a href="hapus_peminjaman.php"><button>Hapus Peminjaman Lain</button></a>
        <a href="iindex.php"><button>Kembali ke Halaman Utama</button></a>
    </div>
</body>
</html>

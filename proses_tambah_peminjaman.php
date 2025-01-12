<?php
// Koneksi ke database menggunakan PDO
include 'config.php'; // Mengimpor konfigurasi database dari file eksternal

$message = ""; // Variabel untuk menyimpan pesan status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menangkap data dari form
    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali']; // Menambahkan tanggal kembali dari form

    try {
        // Query untuk menambahkan data ke tabel peminjaman
        $stmt = $conn->prepare("INSERT INTO peminjaman (id_anggota, id_buku, tanggal_pinjam, tanggal_kembali) VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_anggota, $id_buku, $tanggal_pinjam, $tanggal_kembali]); // Menjalankan query dengan data yang dimasukkan

        $message = "Data peminjaman berhasil ditambahkan!"; // Pesan keberhasilan
    } catch (PDOException $e) {
        // Pesan error jika terjadi masalah
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Tambah Peminjaman</title>
    <style>
        /* Styling untuk halaman */
        body {
            font-family: Arial, sans-serif;
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Gambar latar belakang */
            background-size: 100%; /* Menyesuaikan ukuran latar */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.9); /* Latar transparan */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek bayangan */
        }

        h2 {
            text-align: center;
            color: #333333; /* Warna teks */
            margin-bottom: 20px;
        }

        .message {
            font-size: 16px;
            color: #555555;
            margin-bottom: 20px;
        }

        .success {
            color: #27ae60; /* Warna hijau untuk pesan berhasil */
            font-weight: bold;
        }

        .error {
            color: #e74c3c; /* Warna merah untuk pesan error */
            font-weight: bold;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #3498db; /* Warna biru untuk teks link */
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline; /* Garis bawah pada hover */
        }

        button {
            background: #3498db;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px; /* Sudut membulat */
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease; /* Animasi transisi */
            text-decoration: none;
        }

        button:hover {
            background: #2980b9; /* Warna tombol lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Proses Tambah Peminjaman</h2>
        <!-- Menampilkan pesan status -->
        <div class="message <?= $message === "Data peminjaman berhasil ditambahkan!" ? 'success' : 'error'; ?>">
            <?= htmlspecialchars($message); ?> <!-- Menghindari serangan XSS dengan htmlspecialchars -->
        </div>
        <!-- Tombol navigasi untuk kembali ke form atau halaman utama -->
        <a href="tambah_peminjaman.php"><button>Tambah Peminjaman Baru</button></a>
        <a href="index.php"><button>Kembali ke Halaman Utama</button></a>
    </div>
</body>
</html>

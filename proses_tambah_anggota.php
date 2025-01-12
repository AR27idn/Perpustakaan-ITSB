<?php
require_once 'config.php'; // Menyertakan file konfigurasi untuk koneksi ke database

$status = ''; // Variabel untuk menyimpan status proses (berhasil atau gagal)

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Memeriksa apakah request adalah POST
    $id_anggota = $_POST['id_anggota']; // Mendapatkan ID anggota dari input form
    $nama = $_POST['nama']; // Mendapatkan nama anggota dari input form
    $email = $_POST['email']; // Mendapatkan email anggota dari input form
    $telepon = $_POST['telepon']; // Mendapatkan nomor telepon anggota dari input form

    try {
        // Menyiapkan query untuk menambahkan data anggota baru ke database
        $stmt = $conn->prepare("INSERT INTO anggota (id_anggota, nama, email, telepon) VALUES (:id_anggota, :nama, :email, :telepon)");
        $stmt->bindParam(':id_anggota', $id_anggota); // Mengikat parameter ID anggota
        $stmt->bindParam(':nama', $nama); // Mengikat parameter nama anggota
        $stmt->bindParam(':email', $email); // Mengikat parameter email anggota
        $stmt->bindParam(':telepon', $telepon); // Mengikat parameter telepon anggota
        $stmt->execute(); // Menjalankan query

        $status = 'success'; // Jika berhasil, status diatur menjadi "success"
    } catch (PDOException $e) { // Menangkap kesalahan database
        $status = 'error'; // Jika terjadi kesalahan, status diatur menjadi "error"
        $error_message = htmlspecialchars($e->getMessage()); // Menyimpan pesan kesalahan
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Mengatur karakter encoding menjadi UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur halaman agar responsif -->
    <title>Proses Tambah Anggota</title> <!-- Judul halaman -->
    <style>
        /* Gaya umum untuk halaman */
        body {
            font-family: Arial, sans-serif; /* Mengatur font utama */
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Latar belakang gambar */
            background-size: 100%; /* Menyesuaikan ukuran latar belakang */
            margin: 0; /* Menghilangkan margin default browser */
            padding: 0; /* Menghilangkan padding default browser */
        }

        /* Gaya untuk container utama */
        .container {
            max-width: 1000px; /* Lebar maksimum container */
            margin: 20px auto; /* Margin otomatis agar terpusat */
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan transparansi */
            padding: 20px; /* Ruang dalam container */
            border-radius: 8px; /* Sudut membulat */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek bayangan */
        }

        /* Gaya untuk judul */
        h1 {
            font-size: 24px; /* Ukuran font */
            color: #333; /* Warna teks */
        }

        /* Gaya untuk paragraf */
        p {
            font-size: 18px; /* Ukuran font */
            margin: 20px 0; /* Margin atas dan bawah */
        }

        /* Gaya untuk teks sukses */
        .success {
            color: #28a745; /* Warna hijau untuk sukses */
        }

        /* Gaya untuk teks error */
        .error {
            color: #dc3545; /* Warna merah untuk error */
        }

        /* Gaya untuk tombol */
        .button {
            display: inline-block; /* Menampilkan sebagai blok inline */
            margin-top: 20px; /* Margin atas */
            padding: 10px 20px; /* Ruang dalam tombol */
            text-decoration: none; /* Menghilangkan garis bawah pada tautan */
            color: #fff; /* Warna teks putih */
            background-color: #007bff; /* Warna biru */
            border-radius: 4px; /* Sudut membulat */
            font-weight: bold; /* Membuat teks tebal */
        }

        /* Gaya hover tombol */
        .button:hover {
            background-color: #0056b3; /* Warna biru lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <div class="container"> <!-- Container utama halaman -->
        <?php if ($status === 'success'): ?> <!-- Jika status adalah sukses -->
            <h1 class="success">Berhasil!</h1> <!-- Pesan sukses -->
            <p>Anggota baru telah ditambahkan ke dalam database.</p>
        <?php elseif ($status === 'error'): ?> <!-- Jika status adalah error -->
            <h1 class="error">Gagal!</h1> <!-- Pesan gagal -->
            <p>Terjadi kesalahan: <?= $error_message; ?></p> <!-- Menampilkan pesan kesalahan -->
        <?php else: ?> <!-- Jika halaman diakses tanpa proses POST -->
            <h1 class="error">Oops!</h1>
            <p>Anda tidak diperbolehkan mengakses halaman ini langsung.</p>
        <?php endif; ?>
        <a href="tambah_anggota.php" class="button">Kembali ke Tambah Anggota</a> <!-- Tombol untuk kembali ke halaman tambah anggota -->
    </div>
</body>
</html>

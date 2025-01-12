<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Menentukan karakter encoding halaman sebagai UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Menyediakan responsif agar halaman tampil baik di perangkat yang berbeda -->
    <title>Hapus Anggota</title> <!-- Judul halaman -->
    <style>
        /* Pengaturan gaya CSS untuk halaman */
        body {
            font-family: Arial, sans-serif; /* Font utama halaman */
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Mengatur gambar latar belakang */
            background-size: 100%; /* Ukuran latar belakang 100% dari elemen */
            margin: 0; /* Menghapus margin default pada body */
            padding: 0; /* Menghapus padding default pada body */
        }
        .container {
            max-width: 1000px; /* Lebar maksimal kontainer */
            margin: 20px auto; /* Memberikan margin atas-bawah dan meratakan ke tengah secara horizontal */
            background-color: rgba(255, 255, 255, 0.9); /* Memberikan latar belakang putih dengan transparansi */
            padding: 20px; /* Memberikan ruang di dalam kontainer */
            border-radius: 8px; /* Membulatkan sudut kontainer */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Memberikan bayangan untuk efek 3D */
        }
        h1 {
            text-align: center; /* Menyelaraskan judul ke tengah */
            color: #333333; /* Warna teks */
        }
        form {
            margin-top: 20px; /* Memberikan jarak atas pada formulir */
        }
        label {
            font-weight: bold; /* Membuat teks label lebih tebal */
            color: #555555; /* Warna teks label */
        }
        input[type="text"] {
            width: 96%; /* Lebar input teks */
            padding: 10px; /* Memberikan ruang di dalam input */
            margin: 10px 0; /* Memberikan jarak vertikal pada input */
            border: 1px solid #ccc; /* Warna dan ketebalan border input */
            border-radius: 5px; /* Membulatkan sudut input */
        }
        button {
            background-color: #dc3545; /* Warna latar tombol (merah) */
            color: #ffffff; /* Warna teks tombol */
            border: none; /* Menghapus border tombol */
            padding: 10px 20px; /* Memberikan ruang dalam tombol */
            border-radius: 5px; /* Membulatkan sudut tombol */
            font-size: 16px; /* Ukuran font tombol */
            cursor: pointer; /* Menampilkan pointer saat hover */
            display: block; /* Menjadikan tombol elemen blok */
            width: 100%; /* Lebar tombol penuh */
            margin-top: 10px; /* Memberikan jarak atas pada tombol */
        }
        button:hover {
            background-color: #c82333; /* Warna tombol saat hover (lebih gelap) */
        }
        .message {
            text-align: center; /* Menyelaraskan pesan ke tengah */
            font-weight: bold; /* Membuat teks pesan lebih tebal */
        }
        .success {
            color: #28a745; /* Warna teks pesan sukses (hijau) */
        }
        .error {
            color: #dc3545; /* Warna teks pesan error (merah) */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hapus Anggota</h1> <!-- Judul halaman -->
        <form action="proses_hapus_anggota.php" method="POST"> <!-- Formulir untuk menghapus anggota -->
            <label for="id_anggota">ID Anggota:</label> <!-- Label untuk input ID Anggota -->
            <input type="text" id="id_anggota" name="id_anggota" placeholder="Masukkan ID Anggota untuk dihapus"> <!-- Input teks untuk ID Anggota -->
            <button type="submit">Hapus Anggota</button> <!-- Tombol submit untuk menghapus anggota -->
        </form>
        <?php
        // PHP untuk menampilkan pesan jika tersedia
        if (isset($_GET['message'])) {
            $message = htmlspecialchars($_GET['message']); // Mengamankan pesan agar tidak terjadi serangan XSS
            $type = $_GET['type'] ?? 'error'; // Jika jenis pesan tidak disediakan, default ke 'error'
            echo "<p class='message $type'>$message</p>"; // Menampilkan pesan sesuai jenisnya (success atau error)
        }
        ?>
    </div>
</body>
</html>

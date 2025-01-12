<?php
// Koneksi ke database menggunakan PDO
include 'config.php'; // Menyertakan file konfigurasi untuk koneksi database

try {
    // Ambil data anggota untuk dropdown
    $stmt_anggota = $conn->prepare("SELECT id_anggota, nama FROM anggota");
    $stmt_anggota->execute(); // Menjalankan query untuk mengambil data anggota
    $anggota_list = $stmt_anggota->fetchAll(PDO::FETCH_ASSOC); // Menyimpan hasil query dalam bentuk array asosiatif

    // Ambil data buku untuk dropdown
    $stmt_buku = $conn->prepare("SELECT id_buku, judul_buku FROM buku");
    $stmt_buku->execute(); // Menjalankan query untuk mengambil data buku
    $buku_list = $stmt_buku->fetchAll(PDO::FETCH_ASSOC); // Menyimpan hasil query dalam bentuk array asosiatif

} catch (PDOException $e) {
    // Menangkap dan menampilkan pesan kesalahan jika terjadi masalah pada koneksi atau query
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
    <style>
        /* Styling untuk tampilan form */
        body {
            font-family: Arial, sans-serif;
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Gambar latar */
            background-size: 100%; /* Menyesuaikan ukuran gambar dengan layar */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.9); /* Latar belakang transparan */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek bayangan */
        }
        /* Style untuk teks, input, tombol, dan elemen lain */
        h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }
        label {
            font-size: 14px;
            color: #555555;
        }
        select, input[type="date"], button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }
        select:focus, input[type="date"]:focus {
            border-color: #3498db; /* Warna fokus */
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5); /* Efek bayangan saat fokus */
        }
        button {
            background: #3498db;
            color: #ffffff;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease; /* Efek transisi */
        }
        button:hover {
            background: #2980b9; /* Warna tombol saat hover */
        }
        .note {
            font-size: 12px;
            color: #777777;
            margin-top: -15px;
            margin-bottom: 20px;
            text-align: center;
        }
        /* Responsif untuk layar kecil */
        @media (max-width: 600px) {
            .container {
                padding: 15px 20px;
            }
            h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Peminjaman</h2>
        <form action="proses_tambah_peminjaman.php" method="POST">
            <!-- Dropdown untuk memilih anggota -->
            <label for="id_anggota">Anggota:</label>
            <select name="id_anggota" id="id_anggota" required>
                <option value="">Pilih Anggota</option>
                <?php foreach ($anggota_list as $anggota) { ?>
                    <!-- Mengisi dropdown dengan data anggota dari database -->
                    <option value="<?= htmlspecialchars($anggota['id_anggota']); ?>">
                        <?= htmlspecialchars($anggota['nama']); ?>
                    </option>
                <?php } ?>
            </select>

            <!-- Dropdown untuk memilih buku -->
            <label for="id_buku">Buku:</label>
            <select name="id_buku" id="id_buku" required>
                <option value="">Pilih Buku</option>
                <?php foreach ($buku_list as $buku) { ?>
                    <!-- Mengisi dropdown dengan data buku dari database -->
                    <option value="<?= htmlspecialchars($buku['id_buku']); ?>">
                        <?= htmlspecialchars($buku['judul_buku']); ?>
                    </option>
                <?php } ?>
            </select>

            <!-- Input tanggal peminjaman -->
            <label for="tanggal_pinjam">Tanggal Peminjaman:</label>
            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" required>

            <!-- Input tanggal kembali -->
            <label for="tanggal_kembali">Tanggal Kembali:</label>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali" required>

            <!-- Tombol submit untuk menyimpan data -->
            <button type="submit">Tambah Peminjaman</button>

            <!-- Catatan kecil untuk pengguna -->
            <p class="note">Pastikan data yang Anda isi sudah benar.</p>
        </form>
    </div>
</body>
</html>

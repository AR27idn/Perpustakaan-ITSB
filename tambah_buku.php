<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <style>
        /* Gaya CSS */
        body {
            /* Mengatur font, latar belakang berupa gambar, serta margin dan padding */
            font-family: Arial, sans-serif;
            background: url('background perpus ITSB.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            /* Membuat area konten dengan ukuran, warna latar belakang transparan, padding, dan border */
            max-width: 1000px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            /* Mengatur heading agar berada di tengah */
            text-align: center;
        }
        form label {
            /* Mengatur label dalam form */
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        form input {
            /* Mengatur tampilan input form */
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-buttons {
            /* Menata tombol dalam form */
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }
        .button {
            /* Mengatur gaya tombol umum */
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
        }
        .button:hover {
            /* Gaya hover untuk tombol utama */
            background-color: #0056b3;
        }
        .btn-cancel {
            /* Gaya tombol batal */
            background-color: #6c757d;
        }
        .btn-cancel:hover {
            /* Gaya hover untuk tombol batal */
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Bagian judul halaman -->
        <h1>Tambah Buku Baru</h1>
        <!-- Form untuk menambah data buku -->
        <form action="proses_tambah_buku.php" method="POST">
            <!-- Input untuk ID Buku -->
            <div class="form-group">
                <label for="id_buku">ID Buku</label>
                <input type="number" id="id_buku" name="id_buku" required>
            </div>
            <!-- Input untuk Judul Buku -->
            <div class="form-group">
                <label for="judul">Judul Buku</label>
                <input type="text" id="judul" name="judul" required>
            </div>
            <!-- Input untuk Pengarang -->
            <div class="form-group">
                <label for="pengarang">Pengarang</label>
                <input type="text" id="pengarang" name="pengarang" required>
            </div>
            <!-- Input untuk Penerbit -->
            <div class="form-group">
                <label for="penerbit">Penerbit</label>
                <input type="text" id="penerbit" name="penerbit" required>
            </div>
            <!-- Input untuk Tahun Terbit -->
            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="number" id="tahun_terbit" name="tahun_terbit" required min="1900" max="<?php echo date('Y'); ?>">
            </div>
            <!-- Tombol untuk menyimpan dan batal -->
            <div class="form-buttons">
                <button type="submit" class="button">Simpan</button>
                <!-- Tombol batal, kembali ke halaman utama -->
                <a href="iindex.php" class="button btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>

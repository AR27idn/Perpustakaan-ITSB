<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Menentukan encoding karakter dokumen -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Membuat halaman responsif -->
    <title>Cari Buku</title> <!-- Judul halaman -->
    <style>
        /* Gaya CSS untuk mempercantik tampilan halaman */
        body {
            font-family: Arial, sans-serif; /* Font untuk teks */
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Gambar latar */
            background-size: 100%; /* Menyesuaikan ukuran gambar latar */
            margin: 0; /* Menghapus margin default */
            padding: 0; /* Menghapus padding default */
        }
        .container {
            max-width: 1000px; /* Lebar maksimum container */
            margin: 20px auto; /* Menambahkan margin di atas dan bawah, serta memusatkan container */
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan transparansi */
            padding: 20px; /* Jarak dalam container */
            border-radius: 8px; /* Membuat sudut container melengkung */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek bayangan */
        }
        h1 {
            text-align: center; /* Memusatkan teks judul */
            color: #333; /* Warna teks judul */
        }

        form {
            display: flex; /* Mengatur elemen form dalam satu baris */
            gap: 10px; /* Jarak antar elemen dalam form */
            align-items: center; /* Menyelaraskan elemen secara vertikal */
        }

        form input[type="text"] {
            flex: 1; /* Membuat input teks mengisi ruang yang tersedia */
            padding: 10px; /* Padding untuk teks dalam input */
            border: 1px solid #ccc; /* Border dengan warna abu-abu */
            border-radius: 4px; /* Membuat sudut input melengkung */
            box-sizing: border-box; /* Menghindari padding memengaruhi ukuran elemen */
        }

        form button {
            background-color: #007bff; /* Warna latar tombol */
            color: #fff; /* Warna teks tombol */
            padding: 10px 15px; /* Jarak dalam tombol */
            border: none; /* Menghapus border default */
            border-radius: 4px; /* Membuat sudut tombol melengkung */
            cursor: pointer; /* Mengubah kursor menjadi pointer saat hover */
            font-size: 16px; /* Ukuran font tombol */
        }

        form button:hover {
            background-color: #0056b3; /* Warna tombol saat di-hover */
        }

        .link-back {
            display: block; /* Membuat tautan menjadi elemen blok */
            margin-top: 20px; /* Jarak atas tautan */
            text-align: center; /* Memusatkan teks tautan */
            color: #007bff; /* Warna teks tautan */
            text-decoration: none; /* Menghapus garis bawah tautan */
        }

        .link-back:hover {
            text-decoration: underline; /* Menambahkan garis bawah saat di-hover */
        }
        
        .button {
            display: inline-block; /* Membuat tombol menjadi elemen blok */
            background-color: #007bff; /* Warna latar tombol */
            color: #fff; /* Warna teks tombol */
            padding: 10px 15px; /* Jarak dalam tombol */
            border: none; /* Menghapus border */
            border-radius: 4px; /* Membuat sudut tombol melengkung */
            cursor: pointer; /* Mengubah kursor menjadi pointer saat hover */
            font-size: 16px; /* Ukuran font tombol */
            text-decoration: none; /* Menghapus garis bawah teks */
            text-align: center; /* Menyelaraskan teks di tengah */
        }

        .button:hover {
            background-color: #0056b3; /* Warna tombol saat di-hover */
        }

        .btn-cancel {
            background-color: #6c757d; /* Warna khusus untuk tombol batal */
        }

        .btn-cancel:hover {
            background-color: #5a6268; /* Warna tombol batal saat di-hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cari Buku</h2> <!-- Judul halaman -->
        <form action="proses_cari_buku.php" method="POST"> <!-- Form untuk pencarian buku -->
            <label for="keyword">Kata Kunci (Judul Buku):</label> <!-- Label untuk input kata kunci -->
            <input type="text" id="keyword" name="keyword" placeholder="Masukkan kata kunci" required> <!-- Input untuk kata kunci -->
            <button type="submit">Cari</button> <!-- Tombol untuk mengirim form -->
        </form>
        <a href="iindex.php" class="button btn-cancel">Kembali Ke Beranda</a> <!-- Tombol untuk kembali ke beranda -->
    </div>
</body>
</html>

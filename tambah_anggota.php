<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Mengatur karakter encoding menjadi UTF-8 untuk mendukung berbagai karakter -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur agar halaman bersifat responsif -->
    <title>Tambah Anggota</title> <!-- Judul halaman -->
    <style>
        /* Gaya untuk body halaman */
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
            margin: 20px auto; /* Membuat margin otomatis agar terpusat */
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan transparansi */
            padding: 20px; /* Ruang dalam container */
            border-radius: 8px; /* Sudut membulat */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek bayangan */
        }

        /* Gaya untuk judul */
        h1 {
            text-align: center; /* Menengahkan teks judul */
            color: #333; /* Warna teks judul */
        }

        /* Gaya untuk label form */
        form label {
            display: block; /* Menampilkan label di baris baru */
            margin-bottom: 8px; /* Jarak bawah */
            font-weight: bold; /* Membuat teks label tebal */
        }

        /* Gaya untuk input teks, email, dan angka */
        form input[type="text"],
        form input[type="email"],
        form input[type="number"] {
            width: 100%; /* Lebar penuh */
            padding: 10px; /* Ruang dalam input */
            margin-bottom: 15px; /* Jarak bawah antar input */
            border: 1px solid #ccc; /* Border abu-abu */
            border-radius: 4px; /* Sudut membulat */
            box-sizing: border-box; /* Memastikan padding tidak menambah ukuran elemen */
        }

        /* Gaya untuk tombol-tombol */
        .form-buttons {
            display: flex; /* Menjadikan tombol sebagai flexbox */
            gap: 10px; /* Jarak antar tombol */
            justify-content: flex-end; /* Menempatkan tombol di sisi kanan */
        }

        /* Gaya umum tombol */
        .form-buttons button,
        .form-buttons a {
            padding: 10px 15px; /* Ruang dalam tombol */
            border-radius: 4px; /* Sudut membulat */
            font-size: 16px; /* Ukuran font */
            text-align: center; /* Teks rata tengah */
            text-decoration: none; /* Menghilangkan garis bawah pada tautan */
            font-weight: bold; /* Membuat teks tebal */
            cursor: pointer; /* Menjadikan kursor berbentuk tangan */
            border: none; /* Menghilangkan border default */
        }

        /* Gaya tombol submit */
        button[type="submit"] {
            background-color: #007bff; /* Warna biru */
            color: #fff; /* Warna teks putih */
        }

        /* Gaya hover tombol submit */
        button[type="submit"]:hover {
            background-color: #0056b3; /* Warna biru lebih gelap */
        }

        /* Gaya tombol batal */
        .btn-cancel {
            background-color: #6c757d; /* Warna abu-abu */
            color: #fff; /* Warna teks putih */
        }

        /* Gaya hover tombol batal */
        .btn-cancel:hover {
            background-color: #5a6268; /* Warna abu-abu lebih gelap */
        }
    </style>
</head>
<body>
    <div class="container"> <!-- Container utama halaman -->
        <h1>Tambah Anggota Baru</h1> <!-- Judul halaman -->
        <form action="proses_tambah_anggota.php" method="POST"> <!-- Form untuk mengirim data ke proses_tambah_anggota.php -->
            <div>
                <label for="id_anggota">ID Anggota:</label> <!-- Label untuk input ID Anggota -->
                <input type="number" id="id_anggota" name="id_anggota" placeholder="Masukkan ID anggota" required> <!-- Input untuk ID Anggota -->
            </div>
            <div>
                <label for="nama">Nama Lengkap:</label> <!-- Label untuk input Nama Lengkap -->
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required> <!-- Input untuk Nama Lengkap -->
            </div>
            <div>
                <label for="email">Email:</label> <!-- Label untuk input Email -->
                <input type="email" id="email" name="email" placeholder="Masukkan email" required> <!-- Input untuk Email -->
            </div>
            <div>
                <label for="telepon">Nomor Telepon:</label> <!-- Label untuk input Nomor Telepon -->
                <input type="number" id="telepon" name="telepon" placeholder="Masukkan nomor telepon" required> <!-- Input untuk Nomor Telepon -->
            </div>
            <div class="form-buttons"> <!-- Bagian tombol -->
                <button type="submit">Simpan</button> <!-- Tombol untuk mengirim data -->
                <a href="iindex.php" class="btn-cancel">Batal</a> <!-- Tombol untuk kembali ke halaman utama -->
            </div>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Mengatur encoding halaman menjadi UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Membuat halaman responsif -->
    <title>Cari Anggota</title> <!-- Judul halaman -->
    <style>
        /* Gaya umum untuk halaman */
        body {
            font-family: Arial, sans-serif; /* Mengatur font utama */
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Latar belakang gambar */
            background-size: 100%; /* Menyesuaikan ukuran gambar latar belakang */
            margin: 0; /* Menghilangkan margin default browser */
            padding: 0; /* Menghilangkan padding default browser */
        }

        /* Gaya untuk container utama */
        .container {
            max-width: 1000px; /* Lebar maksimum container */
            margin: 20px auto; /* Margin otomatis agar terpusat */
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan transparansi 90% */
            padding: 20px; /* Memberikan ruang dalam container */
            border-radius: 8px; /* Membulatkan sudut container */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Memberikan efek bayangan */
        }

        /* Gaya untuk heading */
        h1 {
            text-align: center; /* Mengatur teks agar berada di tengah */
            color: #333; /* Warna teks */
        }

        /* Gaya untuk label form */
        form label {
            display: block; /* Menampilkan label sebagai blok */
            margin-bottom: 8px; /* Memberikan jarak bawah pada label */
            font-weight: bold; /* Membuat teks tebal */
        }

        /* Gaya untuk input form */
        form input[type="number"] {
            width: 100%; /* Lebar penuh */
            padding: 10px; /* Ruang dalam input */
            margin-bottom: 15px; /* Memberikan jarak bawah */
            border: 1px solid #ccc; /* Warna dan ukuran border */
            border-radius: 4px; /* Membulatkan sudut input */
            box-sizing: border-box; /* Memastikan padding termasuk dalam lebar total */
        }

        /* Gaya untuk tombol form */
        .form-buttons {
            display: flex; /* Menampilkan tombol dalam baris */
            gap: 10px; /* Memberikan jarak antar tombol */
            justify-content: flex-end; /* Mengatur tombol di sisi kanan */
        }

        /* Gaya untuk tombol submit */
        .form-buttons button {
            padding: 10px 15px; /* Memberikan ruang dalam tombol */
            border-radius: 4px; /* Membulatkan sudut tombol */
            font-size: 16px; /* Ukuran font */
            font-weight: bold; /* Membuat teks tebal */
            cursor: pointer; /* Mengubah kursor menjadi pointer */
            border: none; /* Menghilangkan border default */
        }

        /* Gaya khusus tombol submit */
        button[type="submit"] {
            background-color: #007bff; /* Warna biru untuk tombol */
            color: #fff; /* Warna teks putih */
        }

        /* Gaya hover tombol submit */
        button[type="submit"]:hover {
            background-color: #0056b3; /* Warna biru lebih gelap saat hover */
        }

        /* Gaya untuk tombol reset */
        .btn-reset {
            background-color: #6c757d; /* Warna abu-abu untuk tombol reset */
            color: #fff; /* Warna teks putih */
        }

        /* Gaya hover tombol reset */
        .btn-reset:hover {
            background-color: #5a6268; /* Warna abu-abu lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <div class="container"> <!-- Container utama untuk elemen konten -->
        <h1>Cari Anggota Berdasarkan ID</h1> <!-- Judul halaman -->
        <form action="proses_cari_anggota.php" method="GET"> <!-- Form dengan metode GET untuk mencari anggota -->
            <div>
                <label for="id_anggota">Masukkan ID Anggota:</label> <!-- Label untuk input ID anggota -->
                <input type="number" id="id_anggota" name="id_anggota" placeholder="Contoh: 12345" required> 
                <!-- Input untuk ID anggota, wajib diisi -->
            </div>
            <div class="form-buttons"> <!-- Bagian tombol -->
                <button type="submit">Cari</button> <!-- Tombol untuk mengirim form -->
                <button type="reset" class="btn-reset">Reset</button> <!-- Tombol untuk mereset input -->
            </div>
        </form>
    </div>
</body>
</html>

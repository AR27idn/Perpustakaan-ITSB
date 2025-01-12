<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"> <!-- Menentukan karakter encoding untuk dokumen -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur tampilan responsif -->
    <title>Cari Peminjaman</title> <!-- Judul halaman -->
    <style>
        /* Desain tampilan halaman */
        body {
            font-family: Arial, sans-serif; /* Mengatur font teks */
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Gambar latar belakang */
            background-size: 100%; /* Ukuran gambar latar menyesuaikan layar */
            margin: 0; /* Menghapus margin bawaan */
            padding: 0; /* Menghapus padding bawaan */
        }
        .container {
            max-width: 1000px; /* Lebar maksimum kontainer */
            margin: 20px auto; /* Margin otomatis untuk pusatkan kontainer */
            background-color: rgba(255, 255, 255, 0.9); /* Latar belakang putih dengan transparansi */
            padding: 20px; /* Ruang dalam kontainer */
            border-radius: 8px; /* Sudut membulat */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek bayangan lembut */
        }

        h2 {
            text-align: center; /* Teks judul di tengah */
            color: #333333; /* Warna teks abu gelap */
            margin-bottom: 20px; /* Jarak bawah judul */
        }

        label {
            font-size: 14px; /* Ukuran font label */
            color: #555555; /* Warna teks label */
        }

        input, button {
            width: 100%; /* Lebar penuh */
            padding: 10px; /* Ruang dalam */
            margin-top: 5px; /* Jarak atas */
            margin-bottom: 20px; /* Jarak bawah */
            border: 1px solid #ddd; /* Garis pembatas */
            border-radius: 5px; /* Sudut membulat */
            font-size: 14px; /* Ukuran font */
            box-sizing: border-box; /* Menghitung padding dalam lebar elemen */
        }

        button {
            background: #3498db; /* Warna latar biru */
            color: #ffffff; /* Warna teks putih */
            border: none; /* Menghapus garis pembatas */
            cursor: pointer; /* Menampilkan kursor pointer */
            font-size: 16px; /* Ukuran font tombol */
            transition: background 0.3s ease; /* Efek transisi pada hover */
        }

        button:hover {
            background: #2980b9; /* Warna biru lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cari Peminjaman</h2> <!-- Judul halaman -->
        <form action="proses_cari_peminjaman.php" method="GET"> <!-- Form pencarian dengan metode GET -->
            <label for="keyword">ID Peminjaman:</label> <!-- Label untuk input -->
            <input type="text" name="keyword" id="keyword" placeholder="Masukkan ID Peminjaman" required> 
            <!-- Input teks untuk kata kunci pencarian dengan placeholder dan atribut required -->
            <button type="submit">Cari</button> <!-- Tombol untuk mengirim form -->
        </form>
    </div>
</body>
</html>

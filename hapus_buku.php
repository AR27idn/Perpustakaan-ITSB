<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Buku</title>
    <style>
        /* Gaya untuk body halaman */
        body {
            font-family: Arial, sans-serif;
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Menetapkan latar belakang gambar */
            background-size: 100%; /* Mengatur ukuran latar belakang */
            margin: 0;
            padding: 0;
        }

        /* Gaya untuk container utama */
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan transparansi */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Memberikan bayangan pada kontainer */
        }

        /* Gaya untuk heading */
        h1 {
            text-align: center;
            color: #333333;
        }

        /* Gaya untuk form */
        form {
            margin-top: 20px;
        }

        /* Gaya untuk label */
        label {
            font-weight: bold;
            color: #555555; /* Warna label */
        }

        /* Gaya untuk input text */
        input[type="text"] {
            width: 96%; /* Lebar 96% dari lebar kontainer */
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Gaya untuk tombol */
        button {
            background-color: #dc3545; /* Warna latar belakang merah */
            color: #ffffff; /* Warna teks putih */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            width: 100%; /* Tombol mengisi lebar penuh form */
            margin-top: 10px;
        }

        /* Gaya untuk efek hover pada tombol */
        button:hover {
            background-color: #c82333; /* Mengubah warna tombol saat dihover */
        }

        /* Gaya untuk menampilkan pesan (berhasil atau gagal) */
        .message {
            text-align: center;
            font-weight: bold;
        }

        /* Gaya untuk pesan sukses */
        .success {
            color: #28a745; /* Warna hijau untuk pesan sukses */
        }

        /* Gaya untuk pesan error */
        .error {
            color: #dc3545; /* Warna merah untuk pesan error */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hapus Buku</h1>
        <!-- Formulir untuk memasukkan ID buku yang ingin dihapus -->
        <form action="proses_hapus_buku.php" method="POST">
            <label for="id_buku">ID Buku:</label>
            <!-- Input untuk ID buku -->
            <input type="text" id="id_buku" name="id_buku" placeholder="Masukkan ID Buku untuk dihapus">
            <!-- Tombol submit untuk menghapus buku -->
            <button type="submit">Hapus Buku</button>
        </form>

        <?php
        // Memeriksa apakah ada pesan yang dikirimkan melalui URL (query string)
        if (isset($_GET['message'])) {
            // Mengambil pesan dan jenis pesan dari URL
            $message = htmlspecialchars($_GET['message']);
            $type = $_GET['type'] ?? 'error'; // Jika tidak ada tipe, defaultkan menjadi 'error'
            // Menampilkan pesan berdasarkan tipe (error atau success)
            echo "<p class='message $type'>$message</p>";
        }
        ?>
    </div>
</body>
</html>

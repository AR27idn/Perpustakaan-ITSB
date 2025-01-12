<?php
session_start(); // Memulai sesi PHP untuk menyimpan data pengguna setelah login.
require 'config.php'; // Mengimpor file konfigurasi untuk koneksi database.

$error = ''; // Variabel untuk menyimpan pesan error jika login gagal.

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Mengecek apakah form dikirim melalui metode POST.
    $username = $_POST['username']; // Mengambil input username dari form.
    $password = $_POST['password']; // Mengambil input password dari form.

    try {
        // Mempersiapkan query untuk mencari pengguna berdasarkan username dan password.
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        
        // Mengikat nilai dari form ke parameter query untuk keamanan.
        $stmt->bindParam(':username', $username); 
        $stmt->bindParam(':password', $password); 
        
        $stmt->execute(); // Menjalankan query.

        // Mengambil data pengguna jika ditemukan.
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) { // Jika pengguna ditemukan (login berhasil).
            // Menyimpan data pengguna ke sesi.
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Mengarahkan pengguna ke halaman index.php.
            header('Location: iindex.php'); // PERHATIAN: "iindex.php" 
            exit; // Menghentikan eksekusi script setelah redirect.
        } else {
            $error = 'Username atau password salah.'; // Pesan error jika login gagal.
        }
    } catch (PDOException $e) { // Menangkap error jika terjadi masalah pada database.
        $error = 'Terjadi kesalahan: ' . $e->getMessage(); // Menyimpan pesan error untuk ditampilkan.
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Menentukan karakter encoding dokumen. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Membuat halaman responsif untuk perangkat. -->
    <title>Login</title>
    <style>
        /* Gaya untuk halaman login */
        body {
            font-family: Arial, sans-serif; /* Font utama. */
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Gambar latar belakang. */
            background-size: cover; /* Memastikan gambar memenuhi layar. */
            color: #fff; /* Warna teks putih. */
            display: flex; /* Flexbox untuk tata letak tengah. */
            justify-content: center; /* Pusat horizontal. */
            align-items: center; /* Pusat vertikal. */
            height: 100vh; /* Tinggi penuh layar. */
            margin: 0; /* Menghapus margin default. */
        }

        .login-container {
            background: rgba(0, 0, 0, 0.7); /* Latar semi-transparan. */
            padding: 30px 50px; /* Padding dalam kontainer. */
            border-radius: 10px; /* Sudut membulat. */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Bayangan. */
            text-align: center; /* Teks rata tengah. */
            width: 100%; /* Lebar penuh. */
            max-width: 400px; /* Maksimal lebar 400px. */
        }

        h2 {
            margin-bottom: 20px; /* Jarak bawah heading. */
            font-size: 1.8em; /* Ukuran font heading. */
        }

        form {
            display: flex; /* Flexbox untuk form. */
            flex-direction: column; /* Elemen dalam form diatur secara vertikal. */
        }

        label {
            margin: 10px 0 5px; /* Jarak di sekitar label. */
            text-align: left; /* Teks rata kiri. */
            color: #ddd; /* Warna teks abu terang. */
        }

        input {
            padding: 10px; /* Ruang dalam input. */
            border: none; /* Menghapus border default. */
            border-radius: 4px; /* Sudut membulat. */
            margin-bottom: 20px; /* Jarak bawah input. */
            font-size: 1em; /* Ukuran font input. */
        }

        input[type="text"], input[type="password"] {
            background: rgba(255, 255, 255, 0.8); /* Latar belakang putih transparan. */
            color: #000; /* Warna teks hitam. */
        }

        input[type="text"]:focus, input[type="password"]:focus {
            outline: none; /* Menghapus outline default. */
            border: 2px solid #4CAF50; /* Border hijau saat fokus. */
        }

        button {
            padding: 10px; /* Ruang dalam tombol. */
            background-color: #4CAF50; /* Warna latar tombol hijau. */
            border: none; /* Menghapus border default. */
            border-radius: 4px; /* Sudut membulat. */
            color: white; /* Warna teks putih. */
            font-size: 1em; /* Ukuran font tombol. */
            cursor: pointer; /* Kursor pointer. */
            transition: background-color 0.3s; /* Animasi perubahan warna. */
        }

        button:hover {
            background-color: #45a049; /* Warna tombol saat hover. */
        }

        .error {
            color: red; /* Warna teks error merah. */
            margin-bottom: 20px; /* Jarak bawah teks error. */
        }

        @media screen and (max-width: 480px) {
            .login-container {
                padding: 20px; /* Padding lebih kecil untuk layar kecil. */
                width: 90%; /* Lebar 90% layar. */
            }

            h2 {
                font-size: 1.5em; /* Ukuran heading lebih kecil. */
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if ($error): ?> <!-- Menampilkan error jika ada. -->
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action=""> <!-- Form dikirim ke skrip ini sendiri. -->
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required> <!-- Input username. -->

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required> <!-- Input password. -->

            <button type="submit">Login</button> <!-- Tombol login. -->
        </form>
    </div>
</body>
</html>

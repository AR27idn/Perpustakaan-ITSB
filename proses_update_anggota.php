<?php
session_start(); // Memulai sesi untuk menyimpan pesan notifikasi.
require_once 'config.php'; // Menyertakan file konfigurasi database.

if (isset($_GET['id_anggota'])) { // Memeriksa apakah parameter `id_anggota` dikirim.
    $id_anggota = $_GET['id_anggota']; // Menangkap nilai `id_anggota`.

    try {
        // Mengambil data anggota berdasarkan ID menggunakan prepared statement.
        $stmt = $conn->prepare("SELECT * FROM anggota WHERE id_anggota = :id_anggota");
        $stmt->bindParam(':id_anggota', $id_anggota, PDO::PARAM_INT);
        $stmt->execute();
        $anggota = $stmt->fetch(PDO::FETCH_ASSOC); // Mengambil data sebagai array asosiatif.

        if (!$anggota) { // Jika data anggota tidak ditemukan.
            echo "Anggota tidak ditemukan.";
            exit; // Menghentikan eksekusi jika ID tidak valid.
        }
    } catch (PDOException $e) {
        // Menampilkan pesan error jika terjadi kesalahan database.
        echo "Terjadi kesalahan: " . htmlspecialchars($e->getMessage());
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Memproses permintaan POST untuk pembaruan data.
        // Validasi input dari form.
        $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $telepon = isset($_POST['telepon']) ? trim($_POST['telepon']) : '';

        if (empty($nama) || empty($email) || empty($telepon)) { // Cek jika ada input kosong.
            echo "Semua data wajib diisi.";
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Validasi format email.
            echo "Email tidak valid.";
            exit;
        }

        try {
            // Query untuk memperbarui data anggota.
            $updateStmt = $conn->prepare("UPDATE anggota SET nama = :nama, email = :email, telepon = :telepon WHERE id_anggota = :id_anggota");
            $updateStmt->bindParam(':nama', $nama);
            $updateStmt->bindParam(':email', $email);
            $updateStmt->bindParam(':telepon', $telepon);
            $updateStmt->bindParam(':id_anggota', $id_anggota, PDO::PARAM_INT);
            $updateStmt->execute();

            // Set pesan sukses di sesi.
            $_SESSION['success_message'] = "Data anggota berhasil diperbarui.";

            // Redirect ke halaman daftar anggota.
            header('Location: update_anggota.php');
            exit;
        } catch (PDOException $e) {
            // Menampilkan pesan error jika gagal memperbarui data.
            echo "Terjadi kesalahan saat memperbarui data: " . htmlspecialchars($e->getMessage());
        }
    }
} else {
    // Jika parameter `id_anggota` tidak ditemukan.
    echo "ID anggota tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Anggota</title>
    <style>
        /* Gaya untuk tampilan halaman */
        body {
            font-family: Arial, sans-serif;
            background: url('background perpus ITSB.jpg') no-repeat center center fixed;
            background-size: 100%; /* Ukuran background */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan transparansi */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center; /* Judul di tengah */
            color: #333;
            margin-bottom: 20px;
        }
        form div {
            margin-bottom: 15px; /* Jarak antar input */
        }
        label {
            font-weight: bold; /* Label dengan huruf tebal */
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"] {
            width: 100%; /* Input dengan lebar penuh */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-buttons {
            display: flex;
            justify-content: flex-end; /* Tombol di kanan */
            gap: 10px;
            margin-top: 20px;
        }
        button, .btn-cancel {
            padding: 10px 20px; /* Ukuran tombol */
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }
        button {
            background-color: #007bff; /* Tombol warna biru */
            color: #fff;
        }
        button:hover {
            background-color: #0056b3; /* Warna biru lebih gelap saat hover */
        }
        .btn-cancel {
            background-color: #6c757d; /* Tombol warna abu-abu */
            color: #fff;
        }
        .btn-cancel:hover {
            background-color: #5a6268; /* Warna abu-abu lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Anggota</h2>
        <!-- Form untuk mengupdate data anggota -->
        <form action="proses_update_anggota.php?id_anggota=<?php echo $id_anggota; ?>" method="POST">
            <div>
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($anggota['nama']); ?>" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($anggota['email']); ?>" required>
            </div>
            <div>
                <label for="telepon">Telepon:</label>
                <input type="text" name="telepon" id="telepon" value="<?php echo htmlspecialchars($anggota['telepon']); ?>" required>
            </div>
            <div class="form-buttons">
                <button type="submit">Simpan Perubahan</button>
                <!-- Tombol kembali ke halaman daftar anggota -->
                <a href="update_anggota.php" class="btn-cancel">Kembali ke Update Anggota</a>
            </div>
        </form>
    </div>
</body>
</html>

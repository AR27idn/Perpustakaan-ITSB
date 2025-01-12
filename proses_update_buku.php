<?php
session_start(); // Memulai session untuk menyimpan data sementara
require_once 'config.php'; // Memuat konfigurasi koneksi database

// Memeriksa apakah parameter ID tersedia
if (isset($_GET['id'])) {
    $id_buku = $_GET['id']; // Mengambil nilai ID buku dari URL

    try {
        // Query untuk mengambil data buku berdasarkan ID
        $stmt = $conn->prepare("SELECT * FROM buku WHERE id_buku = :id_buku");
        $stmt->bindParam(':id_buku', $id_buku, PDO::PARAM_INT); // Mengikat parameter ID ke query
        $stmt->execute(); // Menjalankan query
        $buku = $stmt->fetch(PDO::FETCH_ASSOC); // Mendapatkan hasil sebagai array asosiatif

        // Jika buku tidak ditemukan, tampilkan pesan kesalahan
        if (!$buku) {
            echo "Buku tidak ditemukan.";
            exit;
        }
    } catch (PDOException $e) {
        // Menangani error dan menampilkan pesan
        echo "Terjadi kesalahan: " . htmlspecialchars($e->getMessage());
        exit;
    }

    // Jika metode HTTP adalah POST, proses data formulir
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $judul = $_POST['judul']; // Mengambil input judul dari form
        $pengarang = $_POST['pengarang']; // Mengambil input pengarang dari form
        $penerbit = $_POST['penerbit']; // Mengambil input penerbit dari form

        try {
            // Query untuk memperbarui data buku
            $updateStmt = $conn->prepare("UPDATE buku SET judul_buku = :judul_buku, pengarang = :pengarang, penerbit = :penerbit WHERE id_buku = :id_buku");
            $updateStmt->bindParam(':judul_buku', $judul); // Mengikat nilai judul
            $updateStmt->bindParam(':pengarang', $pengarang); // Mengikat nilai pengarang
            $updateStmt->bindParam(':penerbit', $penerbit); // Mengikat nilai penerbit
            $updateStmt->bindParam(':id_buku', $id_buku, PDO::PARAM_INT); // Mengikat ID buku
            $updateStmt->execute(); // Menjalankan query

            // Menyimpan pesan sukses di session
            $_SESSION['success_message'] = "Buku berhasil diperbarui.";

            // Redirect ke halaman daftar buku
            header('Location: update_buku.php');
            exit;
        } catch (PDOException $e) {
            // Menangani error saat memperbarui data
            echo "Terjadi kesalahan saat memperbarui data: " . htmlspecialchars($e->getMessage());
        }
    }
} else {
    // Jika parameter ID tidak tersedia, tampilkan pesan kesalahan
    echo "ID buku tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Buku</title>
    <style>
        /* CSS untuk tampilan halaman */
        body {
            font-family: Arial, sans-serif;
            background: url('background perpus ITSB.jpg') no-repeat center center fixed;
            background-size: 100%; /* Mengatur ukuran latar belakang */
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
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        form div {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
        button, .btn-cancel {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }
        button {
            background-color: #007bff;
            color: #fff;
        }
        button:hover {
            background-color: #0056b3;
        }
        .btn-cancel {
            background-color: #6c757d;
            color: #fff;
        }
        .btn-cancel:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Buku</h2>
        <!-- Formulir untuk mengupdate data buku -->
        <form action="proses_update_buku.php?id=<?php echo $id_buku; ?>" method="POST">
            <div>
                <label for="judul">Judul:</label>
                <!-- Input untuk judul buku -->
                <input type="text" name="judul" id="judul" value="<?php echo htmlspecialchars($buku['judul_buku']); ?>" required>
            </div>
            <div>
                <label for="pengarang">Pengarang:</label>
                <!-- Input untuk pengarang buku -->
                <input type="text" name="pengarang" id="pengarang" value="<?php echo htmlspecialchars($buku['pengarang']); ?>" required>
            </div>
            <div>
                <label for="penerbit">Penerbit:</label>
                <!-- Input untuk penerbit buku -->
                <input type="text" name="penerbit" id="penerbit" value="<?php echo htmlspecialchars($buku['penerbit']); ?>" required>
            </div>
            <div class="form-buttons">
                <!-- Tombol untuk menyimpan perubahan -->
                <button type="submit">Simpan Perubahan</button>
                <!-- Tombol untuk kembali ke halaman daftar buku -->
                <a href="update_buku.php" class="btn-cancel">Kembali ke Update Buku</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php
session_start(); // Memulai session untuk menyimpan atau mengambil data.
require_once 'config.php'; // Menyertakan file konfigurasi untuk koneksi database.

if (isset($_GET['id'])) { // Memeriksa apakah parameter `id` ada di URL.
    $id_peminjaman = $_GET['id']; // Menyimpan ID peminjaman dari URL.

    try {
        // Query untuk mengambil data peminjaman berdasarkan ID.
        $stmt = $conn->prepare("SELECT * FROM peminjaman WHERE id_peminjaman = :id_peminjaman");
        $stmt->bindParam(':id_peminjaman', $id_peminjaman, PDO::PARAM_INT); // Bind parameter ID.
        $stmt->execute(); // Menjalankan query.
        $peminjaman = $stmt->fetch(PDO::FETCH_ASSOC); // Mengambil hasil query.

        if (!$peminjaman) { // Jika data tidak ditemukan, beri feedback dan hentikan proses.
            echo "Peminjaman tidak ditemukan.";
            exit;
        }
    } catch (PDOException $e) {
        // Menangkap error koneksi atau query dan menampilkan pesan kesalahan.
        echo "Terjadi kesalahan: " . htmlspecialchars($e->getMessage());
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Memeriksa apakah form dikirimkan.
        $tanggal_peminjaman = $_POST['tanggal_peminjaman']; // Mengambil input tanggal peminjaman.
        $tanggal_kembali = $_POST['tanggal_kembali']; // Mengambil input tanggal kembali.

        try {
            // Query untuk memperbarui data peminjaman di database.
            $updateStmt = $conn->prepare("UPDATE peminjaman SET tanggal_peminjaman = :tanggal_peminjaman, tanggal_kembali = :tanggal_kembali WHERE id_peminjaman = :id_peminjaman");
            $updateStmt->bindParam(':tanggal_peminjaman', $tanggal_peminjaman); // Bind tanggal peminjaman.
            $updateStmt->bindParam(':tanggal_kembali', $tanggal_kembali); // Bind tanggal kembali.
            $updateStmt->bindParam(':id_peminjaman', $id_peminjaman, PDO::PARAM_INT); // Bind ID peminjaman.
            $updateStmt->execute(); // Menjalankan query update.

            // Menyimpan pesan sukses di session.
            $_SESSION['success_message'] = "Peminjaman berhasil diperbarui.";

            // Redirect ke halaman daftar peminjaman.
            header('Location: update_peminjaman.php');
            exit;
        } catch (PDOException $e) {
            // Menangkap error saat memperbarui data.
            echo "Terjadi kesalahan saat memperbarui data: " . htmlspecialchars($e->getMessage());
        }
    }
} else {
    // Jika ID peminjaman tidak ditemukan di URL, tampilkan pesan error.
    echo "ID peminjaman tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Metadata dasar halaman -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Peminjaman</title>
    <style>
        /* Gaya untuk mempercantik halaman */
        body {
            font-family: Arial, sans-serif; /* Font dasar */
            background: url('background perpus ITSB.jpg') no-repeat center center fixed; /* Latar belakang */
            background-size: 100%; /* Memastikan latar belakang menutupi layar */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px; /* Lebar maksimum container */
            margin: 20px auto; /* Tengah secara horizontal */
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih transparan */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
        }
        h2 {
            text-align: center; /* Rata tengah judul */
            color: #333; /* Warna teks */
            margin-bottom: 20px; /* Jarak bawah judul */
        }
        form div {
            margin-bottom: 15px; /* Jarak antar elemen form */
        }
        label {
            font-weight: bold; /* Huruf tebal */
            display: block; /* Tampilkan label sebagai blok */
            margin-bottom: 5px; /* Jarak bawah label */
        }
        input[type="date"] {
            width: 100%; /* Lebar penuh input */
            padding: 10px; /* Padding dalam input */
            border: 1px solid #ccc; /* Warna border */
            border-radius: 4px; /* Border melengkung */
            box-sizing: border-box; /* Memasukkan padding dalam ukuran box */
        }
        .form-buttons {
            display: flex; /* Tampilkan tombol dalam satu baris */
            justify-content: flex-end; /* Rata kanan */
            gap: 10px; /* Jarak antar tombol */
            margin-top: 20px; /* Jarak atas tombol */
        }
        button, .btn-cancel {
            padding: 10px 20px; /* Ukuran tombol */
            border: none; /* Tanpa border */
            border-radius: 4px; /* Border melengkung */
            font-size: 16px; /* Ukuran font */
            cursor: pointer; /* Pointer saat diarahkan */
            text-decoration: none; /* Tanpa garis bawah */
            text-align: center; /* Rata tengah teks */
        }
        button {
            background-color: #007bff; /* Warna biru */
            color: #fff; /* Teks putih */
        }
        button:hover {
                background-color: #0056b3; /* Warna biru lebih gelap saat hover */
            }
            .btn-cancel {
                background-color: #6c757d; /* Warna abu-abu */
                color: #fff;
            }
            .btn-cancel:hover {
                background-color: #5a6268; /* Warna abu-abu lebih gelap saat hover */
            }
        </style>
    </head>
    <body>
        <div class="container">
            <!-- Form untuk memperbarui data -->
            <h2>Update Peminjaman</h2>
            <form action="proses_update_peminjaman.php?id=<?php echo $id_peminjaman; ?>" method="POST">
                <!-- Input tanggal peminjaman -->
                <div>
                    <label for="tanggal_peminjaman">Tanggal Peminjaman:</label>
                    <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" value="<?php echo htmlspecialchars($peminjaman['tanggal_peminjaman']); ?>" required>
                </div>
                <!-- Input tanggal kembali -->
                <div>
                    <label for="tanggal_kembali">Tanggal Kembali:</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="<?php echo htmlspecialchars($peminjaman['tanggal_kembali']); ?>" required>
                </div>
                <!-- Tombol aksi -->
                <div class="form-buttons">
                    <button type="submit">Simpan Perubahan</button>
                    <a href="update_peminjaman.php" class="btn-cancel">Kembali ke Update Peminjaman</a>
                </div>
            </form>
        </div>
    </body>
    </html>

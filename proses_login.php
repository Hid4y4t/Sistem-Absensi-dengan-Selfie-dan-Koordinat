<?php
// Mengambil koneksi ke database dari file terpisah
require_once 'koneksi/koneksi.php';

// Mulai session
session_start();

// Halaman login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mencegah SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query untuk memeriksa username yang sesuai
    $query = "SELECT * FROM users_k WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verifikasi password menggunakan bcrypt
        if (password_verify($password, $hashed_password)) {
            $jabatan = $row['jabatan'];
            $karyawan_id = $row['id_karyawan']; // Tambahkan baris ini untuk mengambil karyawan_id

            // Mengatur session berdasarkan jabatan dan karyawan_id
            $_SESSION['jabatan'] = $jabatan;
            $_SESSION['nama'] = $nama;
            $_SESSION['karyawan_id'] = $karyawan_id; // Tambahkan baris ini
            $_SESSION['username'] = $username;

            if ($jabatan == 'admin') {
                header("Location: admin/index.php");
                exit();
            } elseif ($jabatan == 'karyawan') {
                header("Location: karyawan/index.php");
                exit();
            }
        } else {
            echo "Username atau password salah.";
        }
    } else {
        echo "Username atau password salah.";
    }
}
?>

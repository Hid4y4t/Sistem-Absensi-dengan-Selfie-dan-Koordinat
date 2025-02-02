<?php
// Sertakan koneksi ke database di sini
include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir
    $id_karyawan = $_POST['id_karyawan'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password_baru = isset($_POST['password']) ? $_POST['password'] : ''; // Ganti baris ini
    $departemen = $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $tanggal_bergabung = $_POST['tanggal_bergabung'];
    $golongan = $_POST['golongan'];

    // Cek apakah password diisi
    if (empty($password_baru)) {
        // Jika password tidak diisi, ambil password lama dari database
        $sqlGetPassword = "SELECT password FROM users_k WHERE id_karyawan = '$id_karyawan'";
        $resultGetPassword = $conn->query($sqlGetPassword);

        if ($resultGetPassword->num_rows > 0) {
            $row = $resultGetPassword->fetch_assoc();
            $password = $row['password'];
        }
    } else {
        // Enkripsi password menggunakan bcrypt jika diisi
        $password = password_hash($password_baru, PASSWORD_BCRYPT);
    }

    // Query untuk menyimpan data karyawan yang diubah ke dalam tabel users_k
    $sql = "UPDATE users_k
            SET nama = '$nama',
                username = '$username',
                password = '$password',
                departemen = '$departemen',
                jabatan = '$jabatan',
                tanggal_bergabung = '$tanggal_bergabung',
                golongan = '$golongan'
            WHERE id_karyawan = '$id_karyawan'";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        // Jika penyimpanan berhasil, arahkan kembali ke halaman sebelumnya
        header("Location: profile.php");
        exit(); // Pastikan untuk keluar dari script setelah melakukan redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo 'Metode request tidak valid.';
}

// Tutup koneksi ke database
$conn->close();
?>

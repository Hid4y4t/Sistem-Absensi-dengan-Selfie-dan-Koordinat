<?php
 
include '../koneksi/koneksi.php';

if (isset($_GET['id'])) {
    $id_karyawan = $_GET['id'];

    // Query untuk menghapus data dari tabel users_k
    $sql = "DELETE FROM users_k WHERE id_karyawan = '$id_karyawan'";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        // Jika penghapusan berhasil, arahkan kembali ke halaman sebelumnya
        header("Location: data_karyawan.php");
        exit(); // Pastikan untuk keluar dari script setelah melakukan redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "ID Karyawan tidak valid.";
}

// Tutup koneksi ke database
$conn->close();
?>

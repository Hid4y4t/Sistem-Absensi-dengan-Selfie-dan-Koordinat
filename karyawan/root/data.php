<?php

// Mengambil koneksi ke database dari file terpisah
require_once '../koneksi/koneksi.php';




// Mulai session
session_start();

// Memeriksa apakah pengguna sudah login, jika tidak, alihkan ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

// Ambil data pengguna dari session
$nama = $_SESSION['nama'];
$username = $_SESSION['username'];
$jabatan = $_SESSION['jabatan'];
$karyawan_id = $_SESSION['karyawan_id'];



// Query untuk mengambil data perusahaan
$query = "SELECT nama_perusahaan, alamat, logo FROM perusahaan";
$result = $conn->query($query);

// Memeriksa apakah ada data yang ditemukan
if ($result->num_rows > 0) {
    $perusahaan = [];

    while ($row = $result->fetch_assoc()) {
        $perusahaan[] = $row;
    }
} else {
    $perusahaan = [];
}



?>

<?php
session_start();
// Koneksi ke basis data 
require_once '../koneksi/koneksi.php';
// Mendapatkan karyawan_id dari data pengguna yang masuk 
$karyawan_id = $_SESSION["karyawan_id"]; 

$tanggal = $_POST['tanggal'];
$jam_masuk = $_POST['jam_masuk'];
$latitude_masuk = $_POST['latitude_masuk'];
$longitude_masuk = $_POST['longitude_masuk'];
$foto_base64 = $_POST['foto_base64'];
$keterangan = 'Belum Absen Pulang';
// Decode base64 string ke gambar
$foto_data = base64_decode($foto_base64);

// Nama file unik untuk foto
$foto_filename = 'foto/' . uniqid() . '.png';

// Menyimpan foto ke folder
file_put_contents($foto_filename, $foto_data);


// Query untuk menyimpan data ke database
$sql = "INSERT INTO absensi (karyawan_id, tanggal, jam_masuk, latitude_masuk,  longitude_masuk, foto_selfie_masuk, keterangan) VALUES ('$karyawan_id', '$tanggal', '$jam_masuk', '$latitude_masuk','$longitude_masuk', '$foto_filename' , '$keterangan')";

if ($conn->query($sql) === TRUE) {
    echo "Data and photo saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

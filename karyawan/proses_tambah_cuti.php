<?php
session_start();


require_once '../koneksi/koneksi.php';

// Mendapatkan karyawan_id dari data pengguna yang masuk (diasumsikan Anda telah mengidentifikasi pengguna)
$karyawan_id = $_SESSION["karyawan_id"]; 
// Mendapatkan data dari formulir
$tanggal_mulai = $_POST['tanggal_mulai'];
$tanggal_selesai = $_POST['tanggal_selesai'];

$penjelasan = $_POST['penjelasan'];
$file = $_FILES['file']['name'];

// Proses upload file (jika diperlukan)
if (!empty($file)) {
    $target_dir = "file_permohonan_cuti/"; // Folder tempat Anda menyimpan file
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
} else {
    $target_file = "";
}

// Masukkan data ke tabel permohonan_cuti
$sql = "INSERT INTO permohonan_cuti (karyawan_id, tanggal_mulai, tanggal_selesai, penjelasan, file, ketentuan_keterangan, acc)
        VALUES ('$karyawan_id', '$tanggal_mulai', '$tanggal_selesai',  '$penjelasan', '$target_file', '', 'permohonan')";

if ($conn->query($sql) === TRUE) {
    header("Location: permohonan_cuti.php"); // Redirect ke halaman permohonan cuti setelah berhasil
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

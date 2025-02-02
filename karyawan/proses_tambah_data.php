<?php
session_start();

require_once '../koneksi/koneksi.php';
// Mendapatkan karyawan_id dari data pengguna yang masuk 
$karyawan_id = $_SESSION["karyawan_id"]; 

// Mendapatkan data dari formulir
$tanggal = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];
$penjelasan = $_POST['penjelasan'];
$file = $_FILES['file']['name'];

// Proses upload file (jika diperlukan)
if (!empty($file)) {
    $target_dir = "file_permohonan/"; // Folder tempat Anda menyimpan file
    $file_extension = pathinfo($file, PATHINFO_EXTENSION); // Dapatkan ekstensi file
    $unique_filename = uniqid() . '_' . time() . '.' . $file_extension; // Buat nama unik dengan timestamp
    $target_file = $target_dir . $unique_filename;
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
} else {
    $target_file = "";
}

// Masukkan data ke tabel
$sql = "INSERT INTO permohonan (karyawan_id, tanggal, keterangan, penjelasan, file, ketentuan_keterangan, acc)
        VALUES ('$karyawan_id', '$tanggal', '$keterangan', '$penjelasan', '$unique_filename', '', 'permohonan')";

if ($conn->query($sql) === TRUE) {
    header("Location: permohonan.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

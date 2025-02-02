<?php
// Sertakan koneksi ke database di sini
include '../koneksi/koneksi.php';

// Pastikan session sudah dimulai
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_perusahaan = $_POST['id_perusahaan'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $website = $_POST['website'];

    // Cek apakah file logo diupload atau tidak
if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
    $logo = $_FILES['logo']['name'];
    $temp_logo = $_FILES['logo']['tmp_name'];

    // Pindahkan file logo yang diupload ke direktori yang diinginkan
    move_uploaded_file($temp_logo, '../assets/img/' . $logo);

    // Update data perusahaan dengan logo baru
    $sql_update = "UPDATE perusahaan SET
                    nama_perusahaan = '$nama',
                    alamat = '$alamat',
                    kota = '$kota',
                    telepon = '$telepon',
                    email = '$email',
                    website = '$website',
                    logo = '$logo'
                    WHERE id_perusahaan = '$id_perusahaan'";
} else {
    // Jika logo tidak diupload, gunakan logo lama
    $sql_update = "UPDATE perusahaan SET
                    nama_perusahaan = '$nama',
                    alamat = '$alamat',
                    kota = '$kota',
                    telepon = '$telepon',
                    email = '$email',
                    website = '$website'
                    WHERE id_perusahaan = '$id_perusahaan'";
}

if ($conn->query($sql_update) === TRUE) {
    header("Location: intansi.php");
} else {
    echo "Error: " . $sql_update . "<br>" . $conn->error;
}
    // Tutup koneksi ke database
    $conn->close();
}
?>

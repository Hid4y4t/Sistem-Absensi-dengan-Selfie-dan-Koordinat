<?php
// Sertakan koneksi ke database di sini
include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir
    $nama_golongan = $_POST['nama_golongan'];
    $gaji_pokok = $_POST['gaji_pokok'];
    $tunjangan = $_POST['tunjangan'];
    $potongan = $_POST['potongan'];

    // Query untuk menyimpan data golongan baru ke dalam tabel golongan_gajih
    $sql = "INSERT INTO golongan_gajih (nama_golongan, gaji_pokok, tunjangan, potongan)
            VALUES ('$nama_golongan', '$gaji_pokok', '$tunjangan', '$potongan')";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        // Jika penyimpanan berhasil, arahkan kembali ke halaman sebelumnya
        header("Location: penggajihan.php");
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

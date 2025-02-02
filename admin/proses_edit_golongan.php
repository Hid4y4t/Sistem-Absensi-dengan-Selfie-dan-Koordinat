<?php

include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir
    $golongan_id = $_POST['golongan_id'];
    $nama_golongan = $_POST['nama_golongan'];
    $gaji_pokok = $_POST['gaji_pokok'];
    $tunjangan = $_POST['tunjangan'];
    $potongan = $_POST['potongan'];

    // Query untuk menyimpan data golongan yang diubah ke dalam tabel golongan_gajih
    $sql = "UPDATE golongan_gajih
            SET nama_golongan = '$nama_golongan',
                gaji_pokok = '$gaji_pokok',
                tunjangan = '$tunjangan',
                potongan = '$potongan'
            WHERE golongan_id = '$golongan_id'";

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

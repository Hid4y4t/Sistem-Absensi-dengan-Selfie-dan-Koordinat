<?php
 
include '../koneksi/koneksi.php';

// Periksa apakah ada parameter ID yang dikirim dari URL
if (isset($_GET['id'])) {
    $golongan_id = $_GET['id'];

    // Query untuk menghapus golongan berdasarkan ID
    $sql_delete = "DELETE FROM golongan_gajih WHERE golongan_id = $golongan_id";

    // Eksekusi query penghapusan
    if ($conn->query($sql_delete) === TRUE) {
        header("Location: penggajihan.php");
    } else {
        echo "Error: " . $sql_delete . "<br>" . $conn->error;
    }
} else {
    echo "ID golongan tidak valid.";
}

// Tutup koneksi ke database
$conn->close();
?>

<?php

include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil ID gaji dari formulir
    $id_gaji = $_POST['id_gaji'];

    // Query untuk menghapus data gaji berdasarkan ID
    $sql = "DELETE FROM gaji WHERE id_gaji = $id_gaji";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        // Jika penghapusan berhasil, kirimkan respon JSON sukses
        echo json_encode(['status' => 'success']);
    } else {
        // Jika terjadi kesalahan, kirimkan respon JSON gagal dengan pesan error
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }

    // Tutup koneksi ke database
    $conn->close();
} else {
    // skirimkan respon JSON dengan pesan error
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>

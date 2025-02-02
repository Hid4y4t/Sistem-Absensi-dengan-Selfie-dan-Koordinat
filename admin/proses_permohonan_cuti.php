<?php
// proses_permohonan.php

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id_permohonan = $_GET['id'];
    $action = $_GET['action'];

    require_once '../koneksi/koneksi.php';
    // Proses Izin atau Tolak
    if ($action == 'approve') {
        // Lakukan tindakan untuk menyetujui permohonan
        $sql_update = "UPDATE permohonan_cuti SET acc = 'diterima' WHERE id = $id_permohonan";
        if ($conn->query($sql_update) === TRUE) {
            echo "Permohonan disetujui.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } elseif ($action == 'reject') {
        // Lakukan tindakan untuk menolak permohonan
        $sql_update = "UPDATE permohonan_cuti SET acc = 'ditolak' WHERE id = $id_permohonan";
        if ($conn->query($sql_update) === TRUE) {
            echo "Permohonan ditolak.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Aksi tidak valid.";
    }

    // Tutup koneksi
    $conn->close();
      // Kembalikan ke halaman sebelumnya dengan JavaScript
      echo "<script>window.history.back();</script>";
} else {
    echo "Data tidak lengkap.";
}
?>

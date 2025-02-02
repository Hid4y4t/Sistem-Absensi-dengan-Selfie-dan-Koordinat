<?php

// Mendapatkan karyawan_id dari data pengguna yang masuk (sesuaikan dengan cara Anda)
$karyawan_id = $_SESSION["karyawan_id"]; 

// Query untuk mendapatkan tanggal bergabung karyawan
$sql_tanggal_bergabung = "SELECT tanggal_bergabung FROM users_k WHERE id_karyawan = '$karyawan_id'";
$result_tanggal_bergabung = $conn->query($sql_tanggal_bergabung);

if ($result_tanggal_bergabung->num_rows > 0) {
    $row_tanggal_bergabung = $result_tanggal_bergabung->fetch_assoc();
    $tanggal_bergabung = new DateTime($row_tanggal_bergabung["tanggal_bergabung"]);
    
    // Hitung selisih bulan antara tanggal bergabung dan tanggal sekarang
    $sekarang = new DateTime();
    $selisih_bulan = $sekarang->diff($tanggal_bergabung)->format("%m");

    // Tentukan jumlah cuti yang diberikan per bulan (misalnya, 1 hari)
    $jumlah_cuti_per_bulan = 1;

    // Hitung total cuti yang diberikan sejak bulan pertama bergabung
    $total_cuti_diberikan = $selisih_bulan * $jumlah_cuti_per_bulan;

    // Query untuk mengambil data permohonan cuti yang telah disetujui (kolom `acc` = 'diterima') dalam rentang bulan yang sesuai
    $sql_permohonan_cuti = "SELECT tanggal_mulai, tanggal_selesai FROM permohonan_cuti WHERE karyawan_id = '$karyawan_id' AND acc = 'diterima' AND ((YEAR(tanggal_mulai) = YEAR(CURDATE()) AND MONTH(tanggal_mulai) <= MONTH(CURDATE())) OR (YEAR(tanggal_selesai) = YEAR(CURDATE()) AND MONTH(tanggal_selesai) >= MONTH(CURDATE())))";
    $result_permohonan_cuti = $conn->query($sql_permohonan_cuti);

    $total_cuti_diambil = 0;

    if ($result_permohonan_cuti->num_rows > 0) {
        while ($row_permohonan_cuti = $result_permohonan_cuti->fetch_assoc()) {
            $tanggal_mulai = new DateTime($row_permohonan_cuti["tanggal_mulai"]);
            $tanggal_selesai = new DateTime($row_permohonan_cuti["tanggal_selesai"]);
            $interval = $tanggal_mulai->diff($tanggal_selesai);

            $total_cuti_diambil += $interval->days + 1; // Menambah jumlah cuti sesuai rentang tanggal
        }
    }

    // Hitung sisa cuti (total cuti diberikan - total cuti diambil)
    $sisa_cuti = $total_cuti_diberikan - $total_cuti_diambil;

    // Pastikan sisa cuti tidak kurang dari nol
    if ($sisa_cuti < 0) {
        $sisa_cuti = 0;
    }

    echo "Total cuti yang diambil : $total_cuti_diambil hari<br>";
    echo "Sisa cuti : $sisa_cuti hari";
} else {
    echo "Tanggal bergabung karyawan tidak ditemukan.";
}


?>
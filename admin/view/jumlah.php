<?php
// Query untuk menghitung jumlah data pada tabel users_k
$query = "SELECT COUNT(*) as total_karyawan FROM users_k";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_karyawan = $row['total_karyawan'];
} else {
    echo "Error: " . mysqli_error($conn);
}

// Mendapatkan tanggal hari ini
$tanggal_hari_ini = date("Y-m-d");

// Query untuk menghitung jumlah data pada tabel absensi dengan jam_masuk terisi pada tanggal hari ini
$query = "SELECT COUNT(*) as jumlah_absensi
          FROM absensi
          WHERE tanggal = '$tanggal_hari_ini' AND jam_masuk IS NOT NULL";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $jumlah_absensi = $row['jumlah_absensi'];
} else {
    echo "Error: " . $conn->error;
}

// Query untuk menghitung jumlah data pada tabel permohonan pada tanggal hari ini
$query = "SELECT COUNT(*) as jumlah_permohonan
          FROM permohonan
          WHERE tanggal = '$tanggal_hari_ini'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $jumlah_permohonan = $row['jumlah_permohonan'];
} else {
    echo "Error: " . $conn->error;
}
?>
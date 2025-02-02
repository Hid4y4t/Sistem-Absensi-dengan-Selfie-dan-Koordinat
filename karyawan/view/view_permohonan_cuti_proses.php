<?php

// Mendapatkan karyawan_id dari data pengguna yang masuk (sesuaikan dengan cara Anda)
$karyawan_id = $_SESSION["karyawan_id"]; 

// Query untuk mengambil data permohonan cuti dengan status "diterima" atau "ditolak"
$sql_permohonan_cuti = "SELECT * FROM permohonan_cuti WHERE karyawan_id = '$karyawan_id' AND acc IN ('diterima', 'ditolak')";
$result_permohonan_cuti = $conn->query($sql_permohonan_cuti);

if ($result_permohonan_cuti->num_rows > 0) {
    echo "<table class='table table-borderless'>";
    echo "<tr>

    <th>Tanggal Mulai</th>
    <th>Tanggal Selesai</th>
    <th>Status</th>
    </tr>";
    
    while ($row_permohonan_cuti = $result_permohonan_cuti->fetch_assoc()) {
        echo "<tr>";
      
        echo "<td>" . $row_permohonan_cuti["tanggal_mulai"] . "</td>";
        echo "<td>" . $row_permohonan_cuti["tanggal_selesai"] . "</td>";
        echo "<td>" . $row_permohonan_cuti["acc"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data permohonan cuti dengan status 'diterima' atau 'ditolak' untuk karyawan ini.";
}

$conn->close();
?>
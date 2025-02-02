<?php

// Mendapatkan karyawan_id dari data pengguna yang masuk (diasumsikan Anda telah mengidentifikasi pengguna)
$karyawan_id = $_SESSION["karyawan_id"]; // Sesuaikan ini dengan cara Anda mengambil karyawan_id.

// Query untuk mengambil data permohonan cuti yang memiliki status "permohonan" dan sesuai dengan ID karyawan yang login
$sql = "SELECT * FROM permohonan_cuti WHERE karyawan_id = '$karyawan_id' AND acc = 'permohonan'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-borderless'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Tanggal Mulai</th>";
    echo "<th>Tanggal Selesai</th>";
   
    echo "<th>Penjelasan</th>";
    echo "<th>Status</th>";
    echo "</tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["tanggal_mulai"] . "</td>";
        echo "<td>" . $row["tanggal_selesai"] . "</td>";
      
        echo "<td>" . $row["penjelasan"] . "</td>";
        echo "<td>" . $row["acc"] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "Tidak ada data permohonan cuti dengan status 'permohonan' untuk karyawan ini.";
}


?>
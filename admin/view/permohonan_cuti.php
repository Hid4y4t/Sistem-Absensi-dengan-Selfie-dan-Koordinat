<?php

// Query untuk mengambil data permohonan cuti dengan status "permohonan" dan menggabungkannya dengan tabel "users_k" untuk mendapatkan nama karyawan
$sql_permohonan_cuti = "SELECT permohonan_cuti.id, users_k.nama, permohonan_cuti.tanggal_mulai, permohonan_cuti.tanggal_selesai, permohonan_cuti.penjelasan, permohonan_cuti.file, permohonan_cuti.ketentuan_keterangan FROM permohonan_cuti JOIN users_k ON permohonan_cuti.karyawan_id = users_k.id_karyawan WHERE permohonan_cuti.acc = 'permohonan'";
$result_permohonan_cuti = $conn->query($sql_permohonan_cuti);

if ($result_permohonan_cuti->num_rows > 0) {
    echo "<table class='table datatable'>";
    echo "<tr>
   
    <th>Nama Karyawan</th>
    <th>Tanggal Mulai</th>
    <th>Tanggal Selesai</th>
   
    <th>Action</th> <!-- Tambah kolom Action -->
    </tr>";

    while ($row_permohonan_cuti = $result_permohonan_cuti->fetch_assoc()) {
        echo "<tr>";
       
        echo "<td>" . $row_permohonan_cuti["nama"] . "</td>";
        echo "<td>" . $row_permohonan_cuti["tanggal_mulai"] . "</td>";
        echo "<td>" . $row_permohonan_cuti["tanggal_selesai"] . "</td>";
       
        echo "<td><a href='view_permohonan_cuti.php?id=" . $row_permohonan_cuti["id"] . "'>View</a></td>"; // Tambahkan link "View" dengan ID permohonan cuti sebagai parameter
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data permohonan cuti dengan status 'permohonan'.";
}

$conn->close();
?>

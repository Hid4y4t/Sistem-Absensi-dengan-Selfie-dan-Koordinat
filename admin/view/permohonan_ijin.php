<?php
// Query untuk mengambil semua data permohonan dengan status "permohonan" dan gabungkan dengan tabel users_k
$sql_permohonan = "SELECT permohonan.id, users_k.nama, permohonan.tanggal, permohonan.keterangan FROM permohonan JOIN users_k ON permohonan.karyawan_id = users_k.id_karyawan WHERE permohonan.acc = 'permohonan'";
$result_permohonan = $conn->query($sql_permohonan);

if ($result_permohonan->num_rows > 0) {
    echo "<table class='table table-borderless'>";
    echo "
    <tr>
        <td>Nama Karyawan</td>
        <td>Tanggal</td>
        <td>Keterangan</td>
        <td>Action</td>
    </tr>
    ";
    
    while ($row_permohonan = $result_permohonan->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row_permohonan["nama"] . "</td>";
        echo "<td>" . $row_permohonan["tanggal"] . "</td>";
        echo "<td>" . $row_permohonan["keterangan"] . "</td>";
        echo "<td>
                <a href='view_permohonan.php?id=" . $row_permohonan["id"] . "'>View</a> |
                <a href='proses_permohonan.php?id=" . $row_permohonan["id"] . "&action=approve'>Izin</a> |
                <a href='proses_permohonan.php?id=" . $row_permohonan["id"] . "&action=reject'>Tolak</a>
              </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data permohonan dengan status 'permohonan'.";
}
?>

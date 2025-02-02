<?php
$karyawan_id = $_SESSION["karyawan_id"];
// Query untuk mengambil data permohonan berdasarkan ID karyawan yang login dan acc berisi "permohonan"
$sql = "SELECT * FROM permohonan WHERE karyawan_id = '$karyawan_id' AND acc = 'permohonan'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";

        echo "<td>" . $row["tanggal"] . "</td>";
        echo "<td>" . $row["keterangan"] . "</td>";
        echo "<td>" . $row["penjelasan"] . "</td>";
       
       
        echo "<td>" . $row["acc"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>Tidak ada data permohonan permohonan untuk karyawan ini.</td></tr>";
}
?>
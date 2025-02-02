<table class="table datatable">
    <tr>
        <td>Tanggal</td>
        <td>Keterangan</td>
        <td>Persetujuan</td>
    </tr>
    <?php
    $karyawan_id = $_SESSION["karyawan_id"];
    // Query untuk mengambil data permohonan berdasarkan ID karyawan yang login dan acc berisi 'ijin' atau 'tolak'
    $sql = "SELECT * FROM permohonan WHERE karyawan_id = '$karyawan_id' AND acc IN ('ijin', 'tolak')";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Tentukan warna berdasarkan nilai kolom acc
            $background_color = ($row["acc"] == "ijin") ? "green" : "red";
            $text_color = "white"; // Warna teks tetap putih

            // Tampilkan data dalam tabel dengan warna yang sesuai
            echo "<tr style='background-color: $background_color; color: $text_color;'>";
            echo "<td>" . $row["tanggal"] . "</td>";
            echo "<td>" . $row["keterangan"] . "</td>";
            echo "<td>" . $row["acc"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Tidak ada data permohonan ijin atau tolak untuk karyawan ini.</td></tr>";
    }
    ?>
</table>

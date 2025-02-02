<?php


// Mendapatkan ID karyawan dari session
if (isset($_SESSION['karyawan_id'])) {
    $karyawan_id = $_SESSION['karyawan_id'];

    // Query untuk mengambil data absensi dan nama karyawan sesuai dengan ID karyawan
    $query = "SELECT a.*, u.nama FROM absensi a
              INNER JOIN users_k u ON a.karyawan_id = u.id_karyawan
              WHERE a.karyawan_id = ? ORDER BY id DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $karyawan_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<table class="table datatable">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>#</th>';
        echo '<th>Nama</th>';
        echo '<th>Tanggal</th>';
        echo '<th>Jam Masuk</th>';
        echo '<th>Jam Keluar</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        $counter = 1;
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $counter . '</td>';
            echo '<td>' . $row['nama'] . '</td>';
            echo '<td>' . $row['tanggal'] . '</td>';
            echo '<td>' . $row['jam_masuk'] . '</td>';
            echo '<td>' . $row['jam_keluar'] . '</td>';
            echo '</tr>';
            $counter++;
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'Tidak ada data absensi.';
    }

    // Tutup statement dan koneksi database
    $stmt->close();
    
} else {
    echo 'Anda belum login atau tidak memiliki akses.';
}
?>

<?php
// Mendapatkan karyawan_id dari session (sesuai dengan cara Anda mengatur session saat login)
$karyawan_id = $_SESSION["karyawan_id"];

// Mendapatkan tanggal saat ini
$currentDate = date("Y-m-d");

// Menghitung tanggal 26 bulan sekarang
$currentMonthStart = date("Y-m-26", strtotime($currentDate));

// Menghitung tanggal 25 bulan ini
$currentMonthEnd = date("Y-m-25", strtotime("+1 month", strtotime($currentDate)));

// Menghitung tanggal 26 bulan sebelumnya
$previousMonthStart = date("Y-m-26", strtotime("-1 month", strtotime($currentDate)));

// Menghitung tanggal 25 bulan sebelumnya
$previousMonthEnd = date("Y-m-25", strtotime($currentDate));

// Query untuk mengambil data absensi berdasarkan karyawan_id dan rentang tanggal
$query = "SELECT * FROM absensi WHERE karyawan_id = ? AND tanggal BETWEEN ? AND ? ORDER BY id DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $karyawan_id, $previousMonthStart, $currentMonthEnd);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<table class="table table-borderless">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">#</th>';
    echo '<th scope="col">Tanggal</th>';
    echo '<th scope="col">Jam Masuk</th>';
    echo '<th scope="col">Jam Keluar</th>';
    echo '<th scope="col">Aksi</th>'; // Kolom untuk menampilkan button
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    $counter = 1;
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<th scope="row">' . $counter . '</th>';
        echo '<td>' . $row['tanggal'] . '</td>';
        echo '<td>' . $row['jam_masuk'] . '</td>';
        echo '<td>' . $row['jam_keluar'] . '</td>';
       
        echo '<td>';
        
        // Tampilkan button "Keterangan Absen Pulang" jika kolom "jam_keluar" kosong
        if (empty($row['jam_keluar'])) {
            echo '<a href="absen_pulang.php?absen_id=' . $row['id'] . '" class="btn btn-primary">Absen Pulang</a>';
        }
        
        echo '</td>';
        echo '</tr>';
        $counter++;
    }
    
    echo '</tbody>';
    echo '</table>';
} else {
    echo 'Tidak ada data absensi.';
}

$stmt->close();
$conn->close();
?>
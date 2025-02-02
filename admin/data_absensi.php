<!DOCTYPE html>
<html lang="en">
<?php include 'root/head.php'; ?>


<body>

    <?php include 'root/navbar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah Golongan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $username; ?></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="row">

            <?php

// Waktu server
$waktu_server = date('Y-m-d');

// Query untuk mengambil data absensi pada tanggal tertentu (waktu server) dengan nama karyawan
$sql_absensi = "SELECT absensi.id, users_k.nama AS karyawan_nama, absensi.tanggal, absensi.jam_masuk, absensi.jam_keluar FROM absensi 
                JOIN users_k ON absensi.karyawan_id = users_k.id_karyawan 
                WHERE absensi.tanggal = '$waktu_server'";
$result_absensi = $conn->query($sql_absensi);

if ($result_absensi) { // Periksa apakah query berhasil dieksekusi
    if ($result_absensi->num_rows > 0) {
        echo '<div class="card">
                <div class="card-body">
                  <h5 class="card-title">Daftar Absensi Hari ini</h5>';

        // Table header
        echo '<table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Karyawan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jam Masuk</th>
                    <th scope="col">Jam Keluar</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>';

        $counter = 1;

        while ($row = $result_absensi->fetch_assoc()) {
            // Table rows
            echo '<tr>
                    <th scope="row">' . $counter . '</th>
                    <td>' . $row['karyawan_nama'] . '</td>
                    <td>' . $row['tanggal'] . '</td>
                    <td>' . $row['jam_masuk'] . '</td>
                    <td>' . $row['jam_keluar'] . '</td>
                    <td><a href="view_absensi.php?id=' . $row['id'] . '">View</a></td>
                  </tr>';

            $counter++;
        }

        echo '</tbody></table>';
        echo '</div></div>';
    } else {
        echo 'Tidak ada data absensi pada tanggal ' . $waktu_server;
    }
} else {
    echo 'Error executing query: ' . $conn->error;
}
?>


<?php

// Menghitung bulan dan tahun saat ini
$currentMonth = date('m');
$currentYear = date('Y');

// Mendapatkan bulan dan tahun sebelumnya (tanggal 27)
$lastMonth = date('m', strtotime('-1 month', strtotime('27-' . date('m-Y'))));
$lastYear = date('Y', strtotime('-1 month', strtotime('27-' . date('m-Y'))));

// Query untuk mengambil data absensi dari awal bulan hingga akhir bulan saat ini
$sql_absensi = "SELECT absensi.id, users_k.nama AS karyawan_nama, absensi.tanggal, absensi.jam_masuk, absensi.jam_keluar, absensi.keterangan FROM absensi 
                JOIN users_k ON absensi.karyawan_id = users_k.id_karyawan
                WHERE (MONTH(absensi.tanggal) = $lastMonth AND YEAR(absensi.tanggal) = $lastYear AND DAY(absensi.tanggal) >= 27)
                OR (MONTH(absensi.tanggal) = $currentMonth AND YEAR(absensi.tanggal) = $currentYear)";
$result_absensi = $conn->query($sql_absensi);

if ($result_absensi) {
    if ($result_absensi->num_rows > 0) {
        echo '<div class="card">
                <div class="card-body">
                  <h5 class="card-title">Data Absensi Bulan Ini</h5>';

        // Table header
        echo '<table class="table datatable table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Karyawan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jam Masuk</th>
                    <th scope="col">Jam Keluar</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>';

        $counter = 1;

        while ($row = $result_absensi->fetch_assoc()) {
            // Table rows
            echo '<tr>
                    <th scope="row">' . $counter . '</th>
                    <td>' . $row['karyawan_nama'] . '</td>
                    <td>' . $row['keterangan'] . '</td>
                    <td>' . $row['tanggal'] . '</td>
                    <td>' . $row['jam_masuk'] . '</td>
                    <td>' . $row['jam_keluar'] . '</td>
                    <td><a href="view_absensi.php?id=' . $row['id'] . '">View</a></td>
                  </tr>';

            $counter++;
        }

        echo '</tbody></table>';
        echo '</div></div>';
    } else {
        echo 'Tidak ada data absensi pada bulan ini.';
    }
} else {
    echo 'Error executing query: ' . $conn->error;
}
?>




    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <?php include 'root/footer.php'; ?>
</body>

</html>
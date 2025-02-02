<!DOCTYPE html>
<html lang="en">
<?php include 'root/head.php'; ?>


<body>

    <?php include 'root/navbar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $username; ?></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="row">
            <div class="col-md-12">
            <?php
// Assume $conn is your database connection

if (isset($_GET['id'])) {
    $id_absensi = $_GET['id'];

    // Query untuk mengambil detail absensi berdasarkan ID
    $sql_detail_absensi = "SELECT users_k.nama AS karyawan_nama, absensi.tanggal, absensi.jam_masuk, absensi.jam_keluar, absensi.keterangan, absensi.latitude_masuk, absensi.longitude_masuk, absensi.latitude_pulang, absensi.longitude_pulang, absensi.foto_selfie_pulang, absensi.foto_selfie_masuk FROM absensi 
                            JOIN users_k ON absensi.karyawan_id = users_k.id_karyawan 
                            WHERE absensi.id = $id_absensi";
    $result_detail_absensi = $conn->query($sql_detail_absensi);

    if ($result_detail_absensi->num_rows > 0) {
        $row_detail_absensi = $result_detail_absensi->fetch_assoc();
    
        // Hitung total jam
        $jam_masuk = new DateTime($row_detail_absensi['jam_masuk']);
        $jam_keluar = new DateTime($row_detail_absensi['jam_keluar']);
        $diff = $jam_masuk->diff($jam_keluar);
        $total_jam = $diff->format('%H.%I');
        // Tampilkan detail absensi dalam tabel
        echo '<div class="card">
                <div class="card-body">
                  <h5 class="card-title">Detail Absensi</h5>';

        // Table untuk menampilkan detail absensi
        echo '<table class="table table-bordered">
                <tr>
                    <th>Nama Karyawan</th>
                    <td>' . $row_detail_absensi['karyawan_nama'] . '</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>' . $row_detail_absensi['tanggal'] . '</td>
                </tr>
                <tr>
               
                <th>Total Jam Bekerja</th>
                <td><b> ' . $total_jam . ' Jam</b></td>
            </tr>
                <tr>
                    <th>Jam Masuk</th>
                    <td>' . $row_detail_absensi['jam_masuk'] . '</td>
                </tr>
                <tr>
                    <th>Jam Keluar</th>
                    <td>' . $row_detail_absensi['jam_keluar'] . '</td>
                </tr>
                <tr>
                    <th>Status Absensi</th>
                    <td>' . $row_detail_absensi['keterangan'] . '</td>
                </tr>
                <tr>
                    <th>Latitude Masuk</th>
                    <td>' . $row_detail_absensi['latitude_masuk'] . '</td>
                </tr>
                <tr>
                    <th>Longitude Masuk</th>
                    <td>' . $row_detail_absensi['longitude_masuk'] . '</td>
                </tr>
                <tr>
                    <th>Latitude Pulang</th>
                    <td>' . $row_detail_absensi['latitude_pulang'] . '</td>
                </tr>
                <tr>
                    <th>Longitude Pulang</th>
                    <td>' . $row_detail_absensi['longitude_pulang'] . '</td>
                </tr>
                <tr>
                    <th>Foto Selfie Masuk</th>
                    <td><img src="' . $row_detail_absensi['foto_selfie_masuk'] . '" alt="Foto Selfie Masuk" style="max-width: 100px;"></td>
                </tr>
                <tr>
                    <th>Foto Selfie Pulang</th>
                    <td><img src="foto/' . $row_detail_absensi['foto_selfie_pulang'] . '" alt="Foto Selfie Pulang" style="max-width: 100px;"></td>
                </tr>
                <tr>
                <td>
                <a href="javascript:history.back()">Kembali</a>
                </td>
                </tr>
                
              </table>';

        echo '</div></div>';
      
    } else {
        echo "Data absensi tidak ditemukan.";
    }
} else {
    echo "ID absensi tidak valid.";
}
?>


                </div>

                
            </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <?php include 'root/footer.php'; ?>
</body>

</html>
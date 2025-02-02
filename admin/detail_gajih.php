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

                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="row">
            <div class="col-md-12">
                <section class="section profile">
                    <div class="row">
                        <div class="col-xl-4">

                            <?php

include '../koneksi/koneksi.php';

// Periksa apakah ada parameter ID_gaji yang dikirim dari tombol Detail
if (isset($_GET['id_gaji'])) {
    $id_gaji = $_GET['id_gaji'];

    // Query untuk mendapatkan detail gaji dan informasi users_k
    $sql = "SELECT gaji.*, users_k.nama, users_k.jabatan, users_k.departemen
            FROM gaji
            JOIN users_k ON gaji.ID_karyawan = users_k.id_karyawan
            WHERE gaji.ID_Gaji = $id_gaji";

    // Eksekusi query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
                            <div class="card">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                    <img src="assets/img/profile.png" alt="Profile" class="rounded-circle">
                                    <h2><?php echo $row['nama']; ?></h2>
                                    <h3><?php echo $row['jabatan']; ?></h3>
                                    <p>Departemen: <?php echo $row['departemen']; ?></p>

                                  
                                </div>
                            </div>
                            <?php
    } else {
        echo 'Tidak dapat menemukan detail gaji.';
    }

 
} else {
    echo 'ID gaji tidak valid.';
}
?>


                        </div>

                        <div class="col-xl-8">

                            <div class="card">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered">

                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#profile-overview">Penggajihan</button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#profile-edit">Absensi</button>
                                        </li>


                                    </ul>
                                    <div class="tab-content pt-2">

                                        <?php
// Sertakan koneksi ke database di sini
include '../koneksi/koneksi.php';

// Periksa apakah ID gaji telah dikirimkan melalui parameter GET
if (isset($_GET['id_gaji'])) {
    $id_gaji = $_GET['id_gaji'];

    // Query untuk mengambil data gaji berdasarkan ID
    $sql = "SELECT gaji.*, users_k.nama, users_k.jabatan, users_k.departemen
            FROM gaji
            JOIN users_k ON gaji.id_karyawan = users_k.id_karyawan
            WHERE gaji.id_gaji = $id_gaji";

    // Eksekusi query
    $result = $conn->query($sql);

    // Periksa apakah data ditemukan
    if ($result->num_rows > 0) {
        // Ambil data dari hasil query
        $row = $result->fetch_assoc();
?>
                                        <!-- Tambahkan kode HTML di sini untuk tata letak detail gaji -->
                                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                            <h5 class="card-title">Gaji</h5>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Gaji Pokok</div>
                                                <div class="col-lg-9 col-md-8">Rp
                                                    <?php echo number_format($row['Gaji_Pokok']); ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Bonus</div>
                                                <div class="col-lg-9 col-md-8">Rp
                                                    <?php echo number_format($row['Bonus']); ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Potongan</div>
                                                <div class="col-lg-9 col-md-8">Rp
                                                    <?php echo number_format($row['Potongan']); ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Cuti</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $row['Cuti']; ?> Hari</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Ijin</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $row['Izin']; ?> Hari</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Tidak Masuk</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $row['Tidak_Masuk']; ?> Hari
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Total Gaji</div>
                                                <div class="col-lg-9 col-md-8">Rp
                                                    <?php echo number_format($row['Total_Gaji']); ?></div>
                                            </div>

                                        </div>
                                        <?php
    } else {
        // Jika data tidak ditemukan, tampilkan pesan error atau redirect ke halaman lain
        echo 'Data tidak ditemukan.';
    }
} else {
    // Jika ID gaji tidak ada, tampilkan pesan error atau redirect ke halaman lain
    echo 'ID Gaji tidak valid.';
}
?>


                                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                        <?php

// Menghitung bulan dan tahun saat ini
$currentMonth = date('m');
$currentYear = date('Y');

// Mendapatkan bulan dan tahun sebelumnya (tanggal 27)
$lastMonth = date('m', strtotime('-1 month', strtotime('27-' . date('m-Y'))));
$lastYear = date('Y', strtotime('-1 month', strtotime('27-' . date('m-Y'))));

// Query untuk mengambil data absensi dari awal bulan hingga akhir bulan saat ini
$sql_absensi = "SELECT absensi.id, users_k.nama AS karyawan_nama, absensi.tanggal, absensi.jam_masuk, absensi.jam_keluar FROM absensi 
                JOIN users_k ON absensi.karyawan_id = users_k.id_karyawan
                WHERE (MONTH(absensi.tanggal) = $lastMonth AND YEAR(absensi.tanggal) = $lastYear AND DAY(absensi.tanggal) >= 27)
                OR (MONTH(absensi.tanggal) = $currentMonth AND YEAR(absensi.tanggal) = $currentYear)";
$result_absensi = $conn->query($sql_absensi);

if ($result_absensi) {
    if ($result_absensi->num_rows > 0) {
        echo '<div class="card">
                <div class="card-body">
                  <h5 class="card-title">Data Absensi </h5>';

        // Table header
        echo '<table class="table datatable table-striped">
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
        echo 'Tidak ada data absensi pada bulan ini.';
    }
} else {
    echo 'Error executing query: ' . $conn->error;
}
?>




                                        </div>

                                    </div><!-- End Bordered Tabs -->

                                </div>
                            </div>

                        </div>
                    </div>
                </section>

            </div>


        </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <?php include 'root/footer.php'; ?>
</body>

</html>
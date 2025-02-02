<!DOCTYPE html>
<html lang="en">
<?php include 'root/head.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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




            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Gajih Bulan Ini</h5>
                    <!-- Table with stripped rows -->
                    <?php

include '../koneksi/koneksi.php';

// Ambil id_karyawan dari sesi atau cara lain yang sesuai
$karyawan_id =$karyawan_id; 

// Query untuk mengambil data gaji untuk semua karyawan
$sql = "SELECT gaji.*, users_k.nama, users_k.jabatan, users_k.departemen
        FROM gaji
        JOIN users_k ON gaji.ID_Karyawan = users_k.id_karyawan
        WHERE users_k.id_karyawan = '$karyawan_id'";

// Eksekusi query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Tampilkan data dalam tabel HTML
    echo '<table class="table datatable">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th><b>Name</b></th>
                    <th>Jabatan</th>
                    <th>Gajih</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['Bulan'] . '</td>        
                <td>' . $row['nama'] . '</td>
                <td>' . $row['jabatan'] . '</td>
                <td>' . $row['Total_Gaji'] . '</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" onclick="showDetail(' . $row['ID_Gaji'] . ')">Lihat Gajih</button>
                </td>
              </tr>';
    }

    echo '</tbody></table>';
} else {
    echo 'Tidak ada data gajih untuk karyawan ini.';
}
?>


                    <!-- End Table with stripped rows -->

                </div>
            </div>



        </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <script>
    function showDetail(id_gaji) {
        // Redirect ke halaman detail gajih dengan menyertakan parameter id_gaji
        window.location.href = 'detail_gajih.php?id_gaji=' + id_gaji;
    }


    </script>

    <?php include 'root/footer.php'; ?>
</body>

</html>
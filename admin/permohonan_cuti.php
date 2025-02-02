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
           
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Permohonan Cuti</h5>


                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>
                                    <b>N</b>ame
                                </th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Alasan</th>
                                <th>Acc</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php

// Query untuk mengambil data permohonan cuti dengan join tabel users_k
$sql_permohonan_cuti = "SELECT permohonan_cuti.id, users_k.nama AS karyawan_nama, permohonan_cuti.tanggal_mulai, permohonan_cuti.tanggal_selesai, permohonan_cuti.penjelasan, permohonan_cuti.acc FROM permohonan_cuti JOIN users_k ON permohonan_cuti.karyawan_id = users_k.id_karyawan";
// Eksekusi query
$result_permohonan_cuti = $conn->query($sql_permohonan_cuti);

// Periksa hasil query
if ($result_permohonan_cuti) {
    // Periksa jumlah baris hasil query
    if ($result_permohonan_cuti->num_rows > 0) {
        echo '<tbody>';

        while ($row_permohonan_cuti = $result_permohonan_cuti->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row_permohonan_cuti['karyawan_nama'] . '</td>
                    <td>' . $row_permohonan_cuti['tanggal_mulai'] . '</td>
                    <td>' . $row_permohonan_cuti['tanggal_selesai'] . '</td>
                    <td>' . $row_permohonan_cuti['penjelasan'] . '</td>
                    <td>' . $row_permohonan_cuti['acc'] . '</td>
                    <td><a href="view_permohonan_cuti.php?id=' . $row_permohonan_cuti['id'] . '">View</a></td>
                  </tr>';
        }

        echo '</tbody>';
    } else {
        echo '<tbody>
                <tr>
                  <td colspan="6">Tidak ada data permohonan cuti.</td>
                </tr>
              </tbody>';
    }
} else {
    echo 'Error executing query: ' . $conn->error;
}
?>

                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <?php include 'root/footer.php'; ?>
</body>

</html>
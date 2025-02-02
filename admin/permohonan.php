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
                    <div class="card-title">
                        <h4>Data Permohonan Ijin Hari Ini</h4>
                    </div>
                    <?php include 'view/permohonan_ijin.php' ?>


                </div>
            </div>
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Permohonan ijin Tidak masuk Kerja</h5>
            

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <b>N</b>ame
                    </th>
                    <th>Tanggal</th>
                    <th>Alasan</th>
                    <th >Perijinan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <?php

// Query untuk mengambil data permohonan dengan join tabel users_k
$sql_permohonan = "SELECT permohonan.id, users_k.nama AS karyawan_nama, permohonan.tanggal,  permohonan.penjelasan,  permohonan.ketentuan_keterangan, permohonan.acc FROM permohonan JOIN users_k ON permohonan.karyawan_id = users_k.id_karyawan";
$result_permohonan = $conn->query($sql_permohonan);

if ($result_permohonan->num_rows > 0) {
    echo '<tbody>';

    while ($row_permohonan = $result_permohonan->fetch_assoc()) {
        echo '<tr>
                <td>' . $row_permohonan['karyawan_nama'] . '</td>
                <td>' . $row_permohonan['tanggal'] . '</td>
             
                <td>' . $row_permohonan['penjelasan'] . '</td>
              
                <td>' . $row_permohonan['acc'] . '</td>
                <td><a href="view_permohonan.php?id=' . $row_permohonan['id'] . '">View</a></td>
              </tr>';
    }

    echo '</tbody>';
} else {
    echo '<tbody>
            <tr>
              <td colspan="8">Tidak ada data permohonan.</td>
            </tr>
          </tbody>';
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
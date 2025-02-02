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
                <div class="card">
                    <div class="card-body">
                        
                    <?php
// view_permohonan.php

if (isset($_GET['id'])) {
    $id_permohonan = $_GET['id'];

    // Query untuk mengambil detail permohonan berdasarkan ID
    $sql_detail_permohonan = "SELECT users_k.nama, permohonan.tanggal, permohonan.keterangan, permohonan.penjelasan, permohonan.file FROM permohonan JOIN users_k ON permohonan.karyawan_id = users_k.id_karyawan WHERE permohonan.id = $id_permohonan";
    $result_detail_permohonan = $conn->query($sql_detail_permohonan);

    if ($result_detail_permohonan->num_rows > 0) {
        $row_detail_permohonan = $result_detail_permohonan->fetch_assoc();

        // Tampilkan detail permohonan
      
        
 
        echo "<table class='table table-striped'>
                <tr>
                    <th>Nama</th>
                    <td>{$row_detail_permohonan['nama']}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{$row_detail_permohonan['tanggal']}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{$row_detail_permohonan['keterangan']}</td>
                </tr>
                <tr>
                    <th>Penjelasan</th>
                    <td>{$row_detail_permohonan['penjelasan']}</td>
                </tr>
                <tr>
                    <th>Bukti</th>
                    <td>
                        <iframe src='../karyawan/file_permohonan/{$row_detail_permohonan['file']}' width='100%' height='500px'></iframe>
                    </td>
                </tr>
                <tr>
                    <th>Beri Izin</th>
                    <td><button type='button' class='btn btn-outline-primary' onclick=\"location.href='proses_permohonan.php?id={$id_permohonan}&action=approve'\">Izin</button></td>
                </tr>
                <tr>
                    <th>Tolak Izin</th>
                    <td><button type='button' class='btn btn-outline-primary' onclick=\"location.href='proses_permohonan.php?id={$id_permohonan}&action=reject'\">Tolak</button></td>
                </tr>
              </table>";

        // Tombol untuk kembali ke halaman sebelumnya
        echo "<a href='javascript:history.back()'>Kembali</a>";
    } else {
        echo "Data permohonan tidak ditemukan.";
    }
} else {
    echo "ID permohonan tidak valid.";
}
?>

                    </div>
                </div>
            </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <?php include 'root/footer.php'; ?>
</body>

</html>
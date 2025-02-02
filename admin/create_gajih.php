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

            <?php

// Mendapatkan ID karyawan dari parameter URL
$employeeId = isset($_GET['id']) ? $_GET['id'] : null;

// Query untuk mendapatkan data karyawan dan golongan dari tabel users_k dan golongan_gajih
$sqlEmployee = "SELECT u.id_karyawan, u.nama, g.nama_golongan, g.gaji_pokok, g.tunjangan, g.potongan
                FROM users_k u
                INNER JOIN golongan_gajih g ON u.golongan = g.golongan_id
                WHERE u.id_karyawan = '$employeeId'";
$resultEmployee = $conn->query($sqlEmployee);

// Mengecek apakah data karyawan ditemukan
if ($resultEmployee->num_rows > 0) {
    $employee = $resultEmployee->fetch_assoc();
}
?>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Create Gaji Form</h5>

                    <!-- Create Gaji Form -->
                    <form action="process_create_gajih.php" method="post">
                        <!-- Kolom Karyawan -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Karyawan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_karyawan" readonly
                                    value="<?= $employee['nama']; ?>">
                                <input type="hidden" name="id_karyawan" value="<?= $employee['id_karyawan']; ?>">
                            </div>
                        </div>

                        <!-- Kolom Bulan dan Tahun -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Bulan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="bulan" placeholder="Bulan">
                            </div>
                            <label class="col-sm-2 col-form-label">Tahun</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tahun" placeholder="Tahun">
                            </div>
                        </div>

                        <!-- Kolom Golongan -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Golongan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="golongan" readonly
                                    value="<?= $employee['nama_golongan']; ?>">
                            </div>
                        </div>

                        <!-- Kolom Gaji Pokok, Tunjangan, Potongan, dan Bonus -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Gaji Pokok</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="gaji_pokok" readonly
                                    value="<?= $employee['gaji_pokok']; ?>">
                            </div>
                            <label class="col-sm-2 col-form-label">Tunjangan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tunjangan" readonly
                                    value="<?= $employee['tunjangan']; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Potongan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="potongan" readonly
                                    value="<?= $employee['potongan']; ?>">
                            </div>
                            <label class="col-sm-2 col-form-label">Bonus</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="bonus" placeholder="Bonus">
                            </div>
                        </div>

                        <!-- Kolom Cuti, Izin, dan Tidak Masuk -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Cuti</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="cuti" placeholder="Cuti">
                            </div>
                            <label class="col-sm-2 col-form-label">Izin</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="izin" placeholder="Izin">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Tidak Masuk</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tidak_masuk" placeholder="Tidak Masuk">
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Create Gaji Form -->

                </div>
            </div>


        </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <?php include 'root/footer.php'; ?>
</body>

</html>
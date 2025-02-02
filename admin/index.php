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

            <?php include 'view/jumlah.php'; ?>
            <div class="col-xxl-1 col-md-3">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Karyawan</h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <h3><?php echo "{$total_karyawan} Orang"; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-1 col-md-3">
                <div class="card info-card sales-card">


                    <div class="card-body">
                        <h5 class="card-title">jumlah Hadir Hari Ini </h5>

                        <div class="d-flex align-items-center">

                            <div class="ps-3">
                                <h3><?php echo "{$jumlah_absensi} Karyawan"; ?></h3>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xxl-1 col-md-3">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">jumlah Ijin Hari Ini </h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <h3><?php echo "{$jumlah_permohonan} orang"; ?></h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Data Permohonan Ijin</h4>
                    </div>
                    <?php include 'view/permohonan_ijin.php' ?>


                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Data Permohonan Cuti</h4>
                    </div>
                    <?php include 'view/permohonan_cuti.php' ?>
                </div>
            </div>
        </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <?php include 'root/footer.php'; ?>
</body>

</html>
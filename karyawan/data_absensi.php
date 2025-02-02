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
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $username; ?></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title"><?php include 'view/view_cuti.php' ?></h5> <hr>
                        <h5 class="card-title">Data Absensi</h5>
                        <?php include 'view/view_data_absensi.php' ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Permohonan Ijin</h5>
                        <?php include 'view/view_permohonan_ijin_diterima.php' ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Permohonan Cuti</h5>
                        <?php include 'view/view_permohonan_cuti_proses.php' ?>
                    </div>
                </div>
            </div>


        </div>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include 'root/footer.php'; ?>


</body>

</html>
<!DOCTYPE html>
<html lang="en">
<?php include 'root/head.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<body>

    <?php include 'root/navbar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Golongan</h1>
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
                    <h5 class="card-title">Tambah Golongan</h5>

                    <form action="proses_tamnbah_golongan.php" method="POST">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Nama Golongan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputText" name="nama_golongan" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Gaji Pokok</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail" name="gaji_pokok" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tunjangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword" name="tunjangan" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Potongan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword" name="potongan" value="">
                            </div>
                        </div>

                        <div class="text-center">

                            <button type="submit" class="btn btn-primary" name="submit">Kirim</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>





        </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <?php include 'root/footer.php'; ?>
</body>

</html>
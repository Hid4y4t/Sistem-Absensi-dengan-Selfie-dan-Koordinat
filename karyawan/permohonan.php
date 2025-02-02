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


                        <h5 class="card-title">Permohonan Tidak Hadir</h5>
                        <form action="proses_tambah_data.php" method="POST" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="keterangan">
                                        <option selected>Open this select menu</option>
                                        <option value="ijin">Ijin</option>
                                        <option value="sakit">Sakit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Text</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" style="height: 100px" name="penjelasan"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">File Ijin</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="formFile" name="file">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Submit Button</label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit Form</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <hr>
                        <h5 class="card-title">Daftar Pengajuan</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th>ID</th>

                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Penjelasan</th>


                                <th>Status</th>
                            </tr>
                            <?php include 'view/view_data_pemohonan.php' ?>

                        </table>
                    </div>
                </div>
            </div>


        </div>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include 'root/footer.php'; ?>


</body>

</html>
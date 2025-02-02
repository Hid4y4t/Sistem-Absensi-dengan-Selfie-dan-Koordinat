<!DOCTYPE html>
<html lang="en">
<?php include 'root/head.php'; ?>


<body>

    <?php include 'root/navbar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">

            <h1>Identitas Intansi</h1>
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


                            <div class="card">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                    <img src="../assets/img/<?php echo $data['logo']; ?>" alt="Profile"
                                        class="rounded-circle">
                                    <h2><?php echo $data['nama_perusahaan']; ?></h2>



                                    <!-- Tautan untuk kembali ke halaman sebelumnya -->
                                    <a href="data_karyawan.php" class="btn btn-outline-success">Kembali</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered">
                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#profile-overview">Identitas</button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#profile-edit">edit</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-2">
                                        <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label ">nama Intansi</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $data['nama_perusahaan']; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label ">Alamat</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $data['alamat']; ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label ">Kota</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $data['kota']; ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Telpon</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $data['telepon']; ?>
                                                </div>
                                            </div>
                                             
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Email</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $data['email']; ?>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Website</div>
                                                <div class="col-lg-9 col-md-8"><?php echo $data['website']; ?>
                                                </div>
                                            </div>

                                            <!-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#verticalycentered">
                                                Atur Lokasi Absensi
                                            </button> -->
                                            <div class="modal fade" id="verticalycentered" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Lokasi Absensi </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <?php
include '../koneksi/koneksi.php';


// Fetch data from the lokasi table
$sql = "SELECT * FROM lokasi";
$result = $conn->query($sql);

// Check if there is data to display
if ($result->num_rows > 0) {
    // Display data in the form
    while ($row = $result->fetch_assoc()) {
        echo '<form class="row g-3" action="proses_edit_lokasi.php" method="POST">';
        echo '<div class="col-md-12">';
        echo '<label for="inputLatitude" class="form-label">Latitude</label>';
        echo '<input type="text" class="form-control" id="inputLatitude" name="latitude" value="' . $row['latitude'] . '">';
        echo '</div>';
        echo '<div class="col-md-12">';
        echo '<label for="inputLongitude" class="form-label">Longitude</label>';
        echo '<input type="text" class="form-control" id="inputLongitude" name="longitude" value="' . $row['longitude'] . '">';
        echo '</div>';
        echo '<div class="text-center">';
        echo '<button type="submit" class="btn btn-primary">Edit</button>';
        echo '<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>';
        echo '</div>';
        echo '</form>';
    }
} else {
    echo "No data found";
}

// Close the database connection
$conn->close();
?>
<!-- End Multi Columns Form -->


                                                        <div class="modal-footer">


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                      
                                    </div><!-- End Bordered Tabs -->







                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                        <form class="row g-3" action="proses_edit_intansi.php"
                                            enctype="multipart/form-data" method="POST">
                                            <div class="col-md-12">
                                                <label for="inputName5" class="form-label">Nama Instansi</label>
                                                <input type="hidden" class="form-control" id="inputName5"
                                                    name="id_perusahaan" value="<?php echo $data['id_perusahaan']; ?>">
                                                <input type="text" class="form-control" id="inputName5" name="nama"
                                                    value="<?php echo $data['nama_perusahaan']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail5" class="form-label">Alamat</label>
                                                <input type="text" class="form-control" id="inputEmail5" name="alamat"
                                                    value="<?php echo $data['alamat']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputPassword5" class="form-label">Kota</label>
                                                <input type="text" class="form-control" id="inputPassword5" name="kota"
                                                    value="<?php echo $data['kota']; ?>">
                                            </div>
                                            <div class="col-6">
                                                <label for="inputAddress5" class="form-label">Telepon</label>
                                                <input type="text" class="form-control" id="inputAddres5s"
                                                    name="telepon" value="<?php echo $data['telepon']; ?>">
                                            </div>
                                            <div class="col-6">
                                                <label for="inputAddress2" class="form-label">email</label>
                                                <input type="disabled" class="form-control" id="inputAddress2"
                                                    name="email" value="<?php echo $data['email']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputCity" class="form-label">Website</label>
                                                <input type="text" class="form-control" id="inputCity" name="website"
                                                    value="<?php echo $data['website']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputCity" class="form-label">Logo intansi</label>
                                                <input type="file" class="form-control" id="inputCity" name="logo">
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>

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
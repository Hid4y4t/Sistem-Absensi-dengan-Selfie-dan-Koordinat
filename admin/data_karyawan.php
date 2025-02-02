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

                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="row">
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Datar Karyawan</h5>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#verticalycentered">
                                    tambah Karyawan
                                </button> <form action="proses_toexcel.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
        <button type="submit" name="submit">Upload</button>
    </form>
                                <!-- modal -->

                                <?php

include '../koneksi/koneksi.php';

// Fetch data from the golongan_gajih table
$sql = "SELECT * FROM golongan_gajih";
$result = $conn->query($sql);
?>

                                <div class="modal fade" id="verticalycentered" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah Karyawan </h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <form class="row g-3" action="proses_regis.php" method="POST">
                                                    <div class="col-md-12">
                                                        <label for="inputName5" class="form-label">Nama Karyawan</label>
                                                        <input type="text" class="form-control" id="inputName5"
                                                            name="nama" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputEmail5" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="inputEmail5"
                                                            name="username" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputPassword5" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="inputPassword5"
                                                            name="password" required>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputAddress5" class="form-label">Departemen</label>
                                                        <input type="text" class="form-control" id="inputAddres5s"
                                                            name="departemen" placeholder="" required>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputAddress2" class="form-label">Jabatan</label>
                                                        <input type="text" name="jabatan" class="form-control" id="inputAddress2"
                                                            placeholder="">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputCity" class="form-label">Tanggal
                                                            Bergabung</label>
                                                        <input type="date" class="form-control" id="inputCity"
                                                            name="tanggal_bergabung">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputState" class="form-label">Golongan</label>
                                                        <select id="inputState" class="form-select" name="golongan">
                                                            <option selected>Golongan</option>

                                                            <?php
        // Generate options from the fetched data
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['golongan_id'] . "'>" . $row['nama_golongan'] . "</option>";
        }
        ?>

                                                        </select>
                                                    </div>
                                                    <?php
// Close the database connection
$conn->close();
?>
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                    </div>
                                                </form>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        <?php

include '../koneksi/koneksi.php';

// Query untuk mengambil data dari tabel users_k
$sql = "SELECT * FROM users_k";

// Eksekusi query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Tampilkan data dalam tabel HTML
    echo '<table class="table datatable">
            <thead>
              <tr>
                <th><b>ID</b>Karyawan</th>
                <th>Nama</th>
                <th>Departemen</th>
                <th data-type="date" data-format="YYYY/DD/MM">Tanggal Bergabung</th>
                <th>Golongan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['id_karyawan'] . '</td>
                <td>' . $row['nama'] . '</td>
                <td>' . $row['departemen'] . '</td>
                <td>' . $row['tanggal_bergabung'] . '</td>
                <td>' . $row['golongan'] . '</td>
                <td>
                    <a href="edit_user.php?id=' . $row['id_karyawan'] . '" class="btn btn-warning btn-sm">Edit</a>
                    <a href="lihat_user.php?id=' . $row['id_karyawan'] . '" class="btn btn-info btn-sm">Lihat</a>
                    <a href="hapus_user.php?id=' . $row['id_karyawan'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data?\')">Hapus</a>
                </td>
              </tr>';
    }

    echo '</tbody></table>';
} else {
    echo 'Tidak ada data users_k.';
}

// Tutup koneksi ke database
$conn->close();
?>

                        <!-- End Table with stripped rows -->

                    </div>
                </div>

        </div>
        </div>
        </section>
        </div>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <?php include 'root/footer.php'; ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<?php include 'root/head.php'; ?>


<body>

    <?php include 'root/navbar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Karyawan</h1>
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

                        <?php
 
include '../koneksi/koneksi.php';


if (isset($_GET['id'])) {
    $id_karyawan = $_GET['id'];

    // Query untuk mengambil data karyawan berdasarkan ID
    $sql_karyawan = "SELECT * FROM users_k WHERE id_karyawan = '$id_karyawan'";
    $result = $conn->query($sql_karyawan);


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <img src="assets/img/profile.png" alt="Profile" class="rounded-circle">
                <h2><?php echo $row['nama']; ?></h2>
                <h3><?php echo $row['jabatan']; ?></h3>
                <p>Departemen: <?php echo $row['departemen']; ?></p>

                
                <!-- Tautan untuk kembali ke halaman sebelumnya -->
                <a href="data_karyawan.php" class="btn btn-outline-success">Kembali</a>
            </div>
        </div>
        <?php
    } else {
        echo 'Tidak dapat menemukan detail gaji.';
    }

} else {
    echo 'ID karyawan tidak valid.';
}
?>



                        </div>

                        <div class="col-xl-8">

                            <div class="card">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered">

                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#profile-overview">Edit</button>
                                        </li>




                                    </ul>
                                    <div class="tab-content pt-2">

                                    <?php
// Sertakan koneksi ke database di sini
include '../koneksi/koneksi.php';

if (isset($_GET['id'])) {
    $id_karyawan = $_GET['id'];

    // Query untuk mengambil data karyawan berdasarkan ID
    $sql_karyawan = "SELECT * FROM users_k WHERE id_karyawan = '$id_karyawan'";
    $result_karyawan = $conn->query($sql_karyawan);

    // Query untuk mengambil data golongan
    $sql_golongan = "SELECT * FROM golongan_gajih";
    $result_golongan = $conn->query($sql_golongan);

    if ($result_karyawan->num_rows > 0 && $result_golongan->num_rows > 0) {
        $row_karyawan = $result_karyawan->fetch_assoc();

        // Tampilkan data pada form edit
        echo '<form class="row g-3" action="proses_edit_user.php" method="POST">
                <div class="col-md-12">
                    <label for="inputName5" class="form-label">Nama Karyawan</label>
                    <input type="hidden" class="form-control" id="inputName5" name="id_karyawan" value="' . $row_karyawan['id_karyawan'] . '">
                    <input type="text" class="form-control" id="inputName5" name="nama" value="' . $row_karyawan['nama'] . '">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail5" class="form-label">Username</label>
                    <input type="text" class="form-control" id="inputEmail5" name="username" value="' . $row_karyawan['username'] . '">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Password Baru</label>
                    <input type="password" class="form-control" id="inputPassword5" name="password_baru">
                </div>
                <div class="col-12">
                    <label for="inputAddress5" class="form-label">Departemen</label>
                    <input type="text" class="form-control" id="inputAddres5s" name="departemen" value="' . $row_karyawan['departemen'] . '">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="inputAddress2" name="jabatan" value="' . $row_karyawan['jabatan'] . '">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Tanggal Bergabung</label>
                    <input type="text" class="form-control" id="inputCity" name="tanggal_bergabung" value="' . $row_karyawan['tanggal_bergabung'] . '">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Golongan</label>
                    <select class="form-select" id="inputCity" name="golongan">';
                    
        // Loop untuk menampilkan pilihan golongan
        while ($row_golongan = $result_golongan->fetch_assoc()) {
            $selected = ($row_golongan['golongan_id'] == $row_karyawan['golongan']) ? 'selected' : '';
            echo '<option value="' . $row_golongan['golongan_id'] . '" ' . $selected . '>' . $row_golongan['nama_golongan'] . '</option>';
        }

        echo '</select>
        </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>';
    } else {
        echo 'Data karyawan tidak ditemukan.';
    }
} else {
    echo 'ID Karyawan tidak valid.';
}

// Tutup koneksi ke database
$conn->close();
?>



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
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
                    <h5 class="card-title">Edit Golongan</h5>
                    <?php
 
include '../koneksi/koneksi.php';

// Periksa apakah ada parameter ID yang dikirim dari URL
if (isset($_GET['id'])) {
    $golongan_id = $_GET['id'];

    // Query untuk mengambil data golongan berdasarkan ID
    $sql_select = "SELECT * FROM golongan_gajih WHERE golongan_id = $golongan_id";

    // Eksekusi query
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row_golongan = $result->fetch_assoc();
        ?>
        <form action="proses_edit_golongan.php" method="POST">
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Nama Golongan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText" name="nama_golongan" value="<?php echo $row_golongan['nama_golongan']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail" class="col-sm-2 col-form-label">Gaji Pokok</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="gaji_pokok" value="<?php echo $row_golongan['gaji_pokok']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Tunjangan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword" name="tunjangan" value="<?php echo $row_golongan['tunjangan']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Potongan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword" name="potongan" value="<?php echo $row_golongan['potongan']; ?>">
                </div>
            </div>

            <div class="text-center">
                <input type="hidden" name="golongan_id" value="<?php echo $golongan_id; ?>">
                <button type="submit" class="btn btn-primary" name="submit">Kirim</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
        <?php
    } else {
        echo 'Data golongan tidak ditemukan.';
    }
} else {
    echo 'ID golongan tidak valid.';
}

// Tutup koneksi ke database
$conn->close();
?>

                </div>
            </div>





        </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <?php include 'root/footer.php'; ?>
</body>

</html>
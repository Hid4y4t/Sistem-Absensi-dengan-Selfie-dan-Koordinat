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
                        <div class="card-title"></div>
                        <center>
                            <video style="border-radius: 10px; margin-top: 20px; width: 50%; height: 50%;" id="videoElement" autoplay></video>
                            
                            <h3 id="notification" class="card-title"></h3>
                            <canvas  id="canvas" style="display: none; width: 50%; height: 50%;"></canvas> <br>
                            <button class="btn btn-primary" type="button" id="startButton">Start Camera</button>
                            <button class="btn btn-success" type="button" id="captureButton">Simpan</button>
                            <!-- Menambahkan elemen untuk menampilkan latitude dan longitude -->
                            <br>
                            
                            <h5 class="card-title">Lokasi</h5>
                            <form>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Latitude</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="latitude" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Longitude</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="longitude" readonly>
                                    </div>
                                </div>

                            </form>
                        </center>
                    </div>
                </div>
            </div>


        </div>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include 'root/footer.php'; ?>
    <?php
// Mendapatkan karyawan_id dari data pengguna yang masuk (sesuaikan dengan cara Anda)
$karyawan_id = $_SESSION["karyawan_id"];
?>

    <script>
    // Gunakan nilai karyawan_id dari PHP
    const karyawan_id = <?php echo json_encode($karyawan_id); ?>;
    </script>

    <script src="absen_masuk.js"></script>
    <script>

    </script>
</body>

</html>
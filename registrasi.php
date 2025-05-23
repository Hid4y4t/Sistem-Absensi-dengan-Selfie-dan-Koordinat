<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Registrasi</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">


                            <?php
            include 'koneksi/koneksi.php';
            // Fetch data from the perusahaan table
            $sql = "SELECT * FROM perusahaan";
            $result = $conn->query($sql);
            
            // Check if there is data to display
            if ($result->num_rows > 0) {
                // Display data
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='d-flex justify-content-center py-4'>";
                    echo "<a href='index.php' class='logo d-flex align-items-center w-auto'>";
                    echo "<img src='assets/img/" . $row['logo'] . "' alt=''>";
                    echo "<span class='d-none d-lg-block'>" . $row['nama_perusahaan'] . "</span>";
                    echo "</a>";
                    echo "</div>";
                }
            } else {
                echo "No data found";
            }
            
            // Close the database connection
            // $conn->close();
            ?>

                                <div class="card mb-3">

                                    <div class="card-body">

                                        <div class="pt-4 pb-2">
                                            <h5 class="card-title text-center pb-0 fs-4">Buat Akun </h5>
                                            <p class="text-center small">Masukan Identitas Untuk membuat Akun</p>
                                        </div>

                                        <form class="row g-3 needs-validation" novalidate action="proses_regis.php" method="POST">
                                            <div class="col-12">
                                                <label for="yourName" class="form-label">Nama Lengkap</label>
                                                <input type="text" name="nama" class="form-control" id="yourName" required>
                                                <div class="invalid-feedback">Masukan Nama Lengkap!</div>
                                            </div>

                                            <div class="col-12">
                                                <label for="yourEmail" class="form-label">Username</label>
                                                <input type="text" name="username" class="form-control" id="yourEmail" required>
                                                <div class="invalid-feedback">Masukan Username</div>
                                            </div>

                                            <div class="col-12">
                                                <label for="yourUsername" class="form-label">Passoword</label>
                                                <div class="input-group has-validation">
                                                   
                                                    <input type="password" name="password" class="form-control" id="yourUsername" required>
                                                    <div class="invalid-feedback">masukan password</div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="yourPassword" class="form-label">Departemen</label>
                                                <input type="text" name="departemen" class="form-control" id="yourPassword" required>
                                                <input type="hidden" name="jabatan" class="form-control" >
                                                <div class="invalid-feedback">Masukan Departemen anda</div>
                                            </div>
                                            <div class="col-12">
                                                <label for="yourEmail" class="form-label">Tanggal Bergabung</label>
                                                <input type="date" name="tanggal_bergabung" class="form-control" id="yourEmail" required>
                                                <div class="invalid-feedback">kapana nda bergabung</div>
                                            </div>
                                            

<!-- Bagian HTML Form -->
<div class="col-12">
    <label for="yourEmail" class="form-label">Golongan</label>
    <select name="golongan" class="form-control" id="yourEmail" required>
        <?php
        // Koneksi ke database (gantilah dengan informasi koneksi sesuai dengan konfigurasi server Anda)
        include 'koneksi/koneksi.php';
        // Lakukan kueri untuk mengambil daftar golongan
        $query = "SELECT golongan_id, nama_golongan FROM golongan_gajih";
        $result = mysqli_query($conn, $query);
        
        // Tampilkan hasil kueri sebagai opsi dalam elemen select
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['golongan_id'] . '">' . $row['nama_golongan'] . '</option>';
        }
        
        // Tutup koneksi
        mysqli_close($conn);
        ?>
    </select>
    <div class="invalid-feedback">Pilih Golongan Anda</div>
</div>

                                            <div class="col-12">
                                                <button class="btn btn-primary w-100" type="submit">Buat Akun</button>
                                            </div>
                                            <div class="col-12">
                                                <p class="small mb-0">Sudah Memiliki Akun ? <a href="index.php">Log in</a></p>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                             
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
    <!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<?php include 'root/head.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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



            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#verticalycentered">
                        Lihat Golongan
                    </button>



                    <!-- modal -->
                    <div class="modal fade" id="verticalycentered" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Jenis Golongan Karyawan </h5> 
                                    <a href="tambah_golongan.php"><button
                                        class="btn btn-outline-success"> Tambah Jenis Golongan</button></a>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php
 
include '../koneksi/koneksi.php';

// Query untuk mengambil data golongan dari tabel golongan_gajih
$sql_golongan = "SELECT * FROM golongan_gajih";
$result_golongan = $conn->query($sql_golongan);

if ($result_golongan->num_rows > 0) {
    echo '<table class="table">
            <thead>
                <tr>
                    <th scope="col">Golongan</th>
                    <th scope="col">Gaji Pokok</th>
                    <th scope="col">Tunjangan</th>
                    <th scope="col">Potongan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';

    while ($row_golongan = $result_golongan->fetch_assoc()) {
        echo '<tr>
                <td>' . $row_golongan['nama_golongan'] . '</td>
                <td>' . $row_golongan['gaji_pokok'] . '</td>
                <td>' . $row_golongan['tunjangan'] . '</td>
                <td>' . $row_golongan['potongan'] . '</td>
                <th scope="row"><a href="hapus_golongan.php?id=' . $row_golongan['golongan_id'] . '" class="btn btn-outline-danger">Hapus</a>
                <a href="edit_golongan.php?id=' . $row_golongan['golongan_id'] . '" class="btn btn-outline-warning">Edit</a>
                </th>

                </tr>';
    }

    echo '</tbody></table>';
} else {
    echo 'Tidak ada data golongan.';
}

// Tutup koneksi ke database
$conn->close();
?>

                                    </table>
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





            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Gajih Bulan Ini</h5>
                    <!-- Table with stripped rows -->
                    <?php
 
include '../koneksi/koneksi.php';

// Ambil bulan saat ini
$bulan_sekarang = date('n'); // Mengembalikan nilai bulan dalam format integer (1-12)

// Query untuk mengambil data gajih hanya untuk bulan ini dengan informasi dari tabel user_k
$sql = "SELECT gaji.*, users_k.nama, users_k.jabatan, users_k.departemen , gaji.id_gaji, gaji.total_gaji
        FROM gaji
        JOIN users_k ON gaji.id_karyawan = users_k.id_karyawan
        WHERE gaji.bulan = $bulan_sekarang";

// Eksekusi query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Tampilkan data dalam tabel HTML
    echo '<table class="table datatable">
            <thead>
                <tr>
                    <th><b>Name</b></th>
                    <th>Jabatan</th>
                    <th>Departemen</th>
                    <th>Gajih</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $row['nama'] . '</td>
                        <td>' . $row['jabatan'] . '</td>
                        <td>' . $row['departemen'] . '</td>
                        <td>' . $row['total_gaji'] . '</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" onclick="showDetail(' . $row['id_gaji'] . ')">Detail</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteGaji(' . $row['id_gaji'] . ')">Hapus</button>
                        </td>
                    </tr>';
            }
            

    echo '</tbody></table>';
} else {
    echo 'Tidak ada data gajih untuk bulan ini.';
}

 
?>

                    <!-- End Table with stripped rows -->

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Karyawan</h5>


                    <!-- Table with stripped rows -->
                    <?php
// Fungsi untuk mendapatkan data karyawan
function getEmployees($conn) {
    $sql = "SELECT id_karyawan, nama, departemen, golongan FROM users_k";

    $result = $conn->query($sql);

    $employees = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
    }

    return $employees;
}

// Ambil data karyawan
$employees = getEmployees($conn);

// Tampilkan data dalam format HTML
?>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th><b>Name</b></th>
                                <th>Departemen</th>
                                <th>Golongan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employees as $employee) : ?>
                            <tr>
                                <td><?= $employee['nama']; ?></td>
                                <td><?= $employee['departemen']; ?></td>
                                <td><?= $employee['golongan']; ?></td>
                                <td><button class="btn btn-success btn-sm"
                                        onclick="createGaji('<?= $employee['id_karyawan']; ?>')">Create
                                        Gaji</button></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <script>
                    // Fungsi untuk menangani pembuatan gaji dan pindah ke halaman create_gajih.php
                    function createGaji(employeeId) {
                        // Arahkan pengguna ke halaman create_gajih.php dengan menyertakan ID karyawan sebagai parameter
                        window.location.href = 'create_gajih.php?id=' + employeeId;
                    }
                    </script>

                    <?php
// Tutup koneksi database
$conn->close();
?>
                    

                </div>
            </div>




        </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <script>
    function showDetail(id_gaji) {
        // Redirect ke halaman detail gajih dengan menyertakan parameter id_gaji
        window.location.href = 'detail_gajih.php?id_gaji=' + id_gaji;
    }

    function deleteGaji(id_gaji) {
        // Konfirmasi penghapusan
        if (confirm('Apakah Anda yakin ingin menghapus data gajih ini?')) {
            // Kirim permintaan AJAX untuk penghapusan
            $.ajax({
                type: 'POST',
                url: 'delete_gajih.php',
                data: {
                    id_gaji: id_gaji
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Jika penghapusan berhasil, perbarui tampilan atau reload halaman
                        alert('Data gajih berhasil dihapus.');
                        location.reload();
                    } else {
                        // Jika terjadi kesalahan, tampilkan pesan error
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Tampilkan pesan error jika terjadi kesalahan AJAX
                    alert('Error: ' + error);
                }
            });
        }
    }
    </script>

    <?php include 'root/footer.php'; ?>
</body>

</html>
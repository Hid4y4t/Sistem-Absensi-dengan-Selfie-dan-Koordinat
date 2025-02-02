<!DOCTYPE html>
<html lang="en">
<?php
include 'root/head.php';

// Ambil ID dari query string
$absenId = $_GET['absen_id'];
?>
<?php include 'root/head.php'; ?>

<body>
    <?php include 'root/navbar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Absen Pulang</h1>
                    </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <video style="border-radius: 10px; margin-top: 20px; width: 50%; height: 50%;" id="videoElement" autoplay></video>
                            <canvas id="canvas" style="display: none; width: 50%; height: 50%;"></canvas>
                            <!-- <h3 id="result" class="card-title"></h3> -->
                            <h3 id="notification" class="card-title"></h3>
                            
                            <button id="startButton" class="btn btn-primary">Start Camera</button>
                            <button id="captureButton" class="btn btn-success">Simpan</button>
                            <input type="hidden" id="absenIdInput" value="<?= $absenId ?>">
                            <h3 id="notification2" class="card-title"></h3>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script src="absen_pulang.js"></script>

    <?php include 'root/footer.php'; ?>
</body>

</html>

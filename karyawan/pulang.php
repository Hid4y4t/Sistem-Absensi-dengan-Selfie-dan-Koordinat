<?php

$serverTime = date('Y-m-d H:i:s');


echo 'Server Time: ' . $serverTime;

// Tangkap data dari POST request
$data = json_decode(file_get_contents("php://input"), true);

// Gunakan nilai dari data JSON, jika tidak tersedia, gunakan nilai dari URL
$absenId = isset($data['absenId']) ? $data['absenId'] : $absenIdFromUrl;

// Hitung waktu jam keluar dengan menambahkan 6 jam dari waktu server
$jamKeluar = date('Y-m-d H:i:s', strtotime($serverTime . ' +6 hours'));
$latitudePulang = $data['latitudePulang'];
$longitudePulang = $data['longitudePulang'];
$fotoSelfiePulang = $data['fotoSelfiePulang'];

$keterangan = 'Absensi Lengkap';

// Simpan foto ke folder
$folderPath = 'foto/';
$fotoName = 'foto_' . $absenId . '_' . time() . '.png'; // Sesuaikan dengan kebutuhan Anda
$fotoPath = $folderPath . $fotoName;

// Decode dan simpan foto
$fotoData = base64_decode(str_replace('data:image/png;base64,', '', $fotoSelfiePulang));
file_put_contents($fotoPath, $fotoData);

// Simpan informasi ke database
include '../koneksi/koneksi.php';

// Set header JSON
header('Content-Type: application/json');

try {
    // Siapkan statement SQL untuk update berdasarkan ID
    $stmt = $conn->prepare('UPDATE absensi SET jam_keluar = ?, latitude_pulang = ?, longitude_pulang = ?, keterangan= ?, foto_selfie_pulang = ? WHERE id = ?');

    // Bind parameter ke statement
    $stmt->bind_param('sddssi', $jamKeluar, $latitudePulang, $longitudePulang, $keterangan, $fotoName, $absenId);

    // Eksekusi statement
    $stmt->execute();

    // Cek apakah eksekusi berhasil
    if ($stmt->affected_rows > 0) {
        // Eksekusi berhasil
        $response = ['status' => 'success', 'message' => 'Data berhasil diupdate. Foto berhasil disimpan.'];
    } else {
       
        $response = ['status' => 'error', 'message' => 'Data tidak diupdate. ID tidak ditemukan.'];
    }

    // Kirim respons kembali ke JavaScript
    echo json_encode($response);
} catch (Exception $e) {
    // Tangani kesalahan jika terjadi
    $response = ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
    echo json_encode($response);
} finally {
    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>

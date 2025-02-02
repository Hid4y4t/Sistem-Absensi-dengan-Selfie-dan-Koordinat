<?php
// Sertakan koneksi ke database di sini
include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir
    $id_karyawan = $_POST['id_karyawan'];
    $bulan = $_POST['bulan']; // Format: MM
    $tahun = $_POST['tahun']; // Format: YYYY
    $gaji_pokok = $_POST['gaji_pokok'];
    $tunjangan = $_POST['tunjangan'];
    $potongan = $_POST['potongan'];
    $bonus = $_POST['bonus'];
    $cuti = $_POST['cuti'];
    $izin = $_POST['izin'];
    $tidak_masuk = $_POST['tidak_masuk'];
    
    // Misal jumlah hari kerja sebulan adalah 22
    $jumlah_hari_kerja_sebulan = 22;
    
    // Hitung jumlah hari kerja (dikurangi dengan tidak_masuk)
    $jumlah_hari_kerja = $jumlah_hari_kerja_sebulan - $tidak_masuk;

    // Hitung total gaji tanpa memasukkan cuti dan izin dalam potongan
    $total_gaji = (($jumlah_hari_kerja) / $jumlah_hari_kerja_sebulan) * $gaji_pokok + $tunjangan + $bonus - $potongan;

    // Query untuk menyimpan data gaji ke dalam tabel gajih
    $sql = "INSERT INTO gaji (id_karyawan, bulan, tahun, gaji_pokok, tunjangan, potongan, bonus, cuti, izin, tidak_masuk, total_gaji)
            VALUES ('$id_karyawan', '$bulan', '$tahun', '$gaji_pokok', '$tunjangan', '$potongan', '$bonus', '$cuti', '$izin', '$tidak_masuk', '$total_gaji')";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        // Jika penyimpanan berhasil, arahkan kembali ke halaman sebelumnya
        header("Location: penggajihan.php");
        exit(); // Pastikan untuk keluar dari script setelah melakukan redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi ke database
    $conn->close();
}
?>

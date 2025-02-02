<?php
// Mengambil koneksi ke database dari file terpisah
require_once 'koneksi/koneksi.php';

// Mendapatkan ID karyawan berikutnya
$query = "SELECT MAX(id_karyawan) AS max_id FROM users_k";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$max_id = $row['max_id'];

// Mengambil nomor urut dari ID karyawan terakhir
$last_number = substr($max_id, 3);
$next_number = intval($last_number) + 1;

// Membuat format ID karyawan dengan padding 0
$next_id = 'KRY' . str_pad($next_number, 3, '0', STR_PAD_LEFT);

// Menyimpan data pengguna ke dalam tabel "users"
// Pastikan untuk mengganti variabel dan kolom sesuai dengan kebutuhan Anda
$id_karyawan = $next_id;
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$departemen = $_POST['departemen'];
$jabatan = 'karyawan';
$tanggal_bergabung = $_POST['tanggal_bergabung'];
$golongan = $_POST['golongan'];

// Mengenkripsi password menggunakan bcrypt
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Query untuk menyimpan data pengguna
$query = "INSERT INTO users_k (id_karyawan, nama, username, password, departemen, jabatan, tanggal_bergabung, golongan)
          VALUES ('$id_karyawan', '$nama', '$username', '$hashedPassword', '$departemen', '$jabatan', '$tanggal_bergabung', '$golongan')";
$result = $conn->query($query);

// Mengecek apakah penyimpanan data berhasil
if ($result) {
    header("Location: index.php");
} else {
    echo "Terjadi kesalahan saat menyimpan data pengguna.";
}
?>
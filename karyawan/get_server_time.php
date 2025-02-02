<?php
// Set zona waktu ke WIB (Indonesia Barat)
date_default_timezone_set('Asia/Jakarta');

// Set header JSON
header('Content-Type: application/json');

// Mendapatkan waktu server
$serverTime = date("H:i:s");

// Mengembalikan waktu server dalam respons JSON
echo json_encode(['serverTime' => $serverTime]);
?>

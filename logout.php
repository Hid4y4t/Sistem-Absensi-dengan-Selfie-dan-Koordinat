<?php
// Mulai session
session_start();

// Hapus semua data session
session_unset();
session_destroy();

// Alihkan ke halaman login
header("Location: index.php");
exit();
?>
<?php include 'root/data.php' ;


?>


<?php foreach ($perusahaan as $data) { ?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  
  <title><?php echo $data['nama_perusahaan']; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/<?php echo $data['logo']; ?>" rel="icon">
  <link href="../assets/img/<?php echo $data['logo']; ?>" rel="apple-touch-icon">

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

  <link href="assets/css/style.css" rel="stylesheet">
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

  <style>
/* Style tombol */
.custom-button {
    background-color: #007bff;
    /* Warna latar belakang */
    color: #fff;
    /* Warna teks */
    padding: 10px 20px;
    /* Padding tombol */
    border: none;
    /* Hapus border */
    cursor: pointer;
    font-size: 18px;
}

/* Style ikon */
.custom-button i {
    margin-right: 5px;
    /* Spasi antara ikon dan teks */
}

/* Style gambar yang diambil */
#capturedImage {
    display: block;
    margin: 0 auto;
    /* Mengatur gambar di tengah tombol */
    max-width: 100%;
    /* Gambar maksimal mengikuti lebar tombol */
    max-height: 150px;
    /* Batasan tinggi gambar */
    border: 2px solid #ccc;
    /* Border untuk gambar */
    border-radius: 5px;
    /* Border radius untuk gambar */
}
</style>
</head>  <?php } ?>
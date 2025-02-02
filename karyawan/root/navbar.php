<!-- ======= Header ======= --><?php foreach ($perusahaan as $data) { ?>
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="index.html" class="logo d-flex align-items-center">
    <img src="../assets/img/<?php echo $data['logo']; ?>" alt="">
    <span class="d-none d-lg-block"><?php echo $data['nama_perusahaan']; ?></span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->


<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

  <li class="nav-item dropdown pe-3">

<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
  <img src="assets/img/profile.png" alt="Profile" class="rounded-circle">
  <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $username; ?></span>
</a><!-- End Profile Iamge Icon -->

<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
  <li class="dropdown-header">
    <h6><?php echo $nama; ?></h6>
    
  </li>
  <li>
    <hr class="dropdown-divider">
  </li>

  <li>
    <a class="dropdown-item d-flex align-items-center" href="profile.php">
      <i class="bi bi-person"></i>
      <span>My Profile</span>
    </a>
  </li>
 
 
  <li>
    <hr class="dropdown-divider">
  </li>

  <li>
    <a class="dropdown-item d-flex align-items-center" href="../logout.php">
      <i class="bi bi-box-arrow-right"></i>
      <span>Log Out</span>
    </a>
  </li>

</ul><!-- End Profile Dropdown Items -->
</li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link collapsed" href="index.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="absensi_pulang.php">
      <i class="bi bi-clock-history"></i>
      <span>Absensi Pulang</span>
    </a>
  </li><!-- End Profile Page Nav -->


  <li class="nav-item">
    <a class="nav-link collapsed" href="data_absensi.php">
      <i class="bi bi-journal-bookmark"></i>
      <span>Data Absensi</span>
    </a>
  </li><!-- End Profile Page Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="permohonan.php">
      <i class="bi bi-calendar-range"></i>
      <span>Permohonan Ijin</span>
    </a>
  </li><!-- End F.A.Q Page Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="permohonan_cuti.php">
      <i class="bi bi-calendar-week"></i>
      <span>Permohonan Cuti</span>
    </a>
  </li><!-- End F.A.Q Page Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="penggajihan.php">
      <i class="bi bi-server"></i>
      <span>Penggajihan</span>
    </a>
  </li><!-- End F.A.Q Page Nav -->

  
  <li class="nav-item">
    <a class="nav-link collapsed" href="profile.php">
      <i class="bi bi-person"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Profile Page Nav -->
  <li>
          <a class="nav-link collapsed" href="../logout.php">
            <i class="bi bi-box-arrow-right"></i>
            <span>Log Out</span>
          </a>
        </li>
</ul>

</aside><!-- End Sidebar-->  <?php } ?>
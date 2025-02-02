-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2024 pada 12.30
-- Versi server: 10.3.15-MariaDB
-- Versi PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `karyawan_id` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `latitude_masuk` decimal(9,6) DEFAULT NULL,
  `longitude_masuk` decimal(9,6) DEFAULT NULL,
  `latitude_pulang` decimal(9,6) DEFAULT NULL,
  `longitude_pulang` decimal(9,6) DEFAULT NULL,
  `foto_selfie_masuk` varchar(255) DEFAULT NULL,
  `foto_selfie_pulang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `ID_Gaji` int(11) NOT NULL,
  `ID_Karyawan` varchar(20) DEFAULT NULL,
  `Bulan` int(11) DEFAULT NULL,
  `Tahun` year(4) DEFAULT NULL,
  `Gaji_Pokok` decimal(10,2) DEFAULT NULL,
  `Tunjangan` decimal(10,2) DEFAULT NULL,
  `Bonus` decimal(10,2) DEFAULT NULL,
  `Potongan` decimal(10,2) DEFAULT NULL,
  `Total_Gaji` decimal(10,2) DEFAULT NULL,
  `Cuti` int(11) DEFAULT NULL,
  `Izin` int(11) DEFAULT NULL,
  `Tidak_Masuk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongan_gajih`
--

CREATE TABLE `golongan_gajih` (
  `golongan_id` int(11) NOT NULL,
  `nama_golongan` varchar(50) NOT NULL,
  `gaji_pokok` decimal(10,2) NOT NULL,
  `tunjangan` decimal(10,2) DEFAULT NULL,
  `potongan` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `golongan_gajih`
--

INSERT INTO `golongan_gajih` (`golongan_id`, `nama_golongan`, `gaji_pokok`, `tunjangan`, `potongan`) VALUES
(1, 'a', '1000000.00', '2000.00', '1000.00'),
(2, 'baik', '2000000.00', '3000.00', '2000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`id`, `latitude`, `longitude`) VALUES
(1, '-8.446029713859907', '114.18157862030606');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan`
--

CREATE TABLE `permohonan` (
  `id` int(11) NOT NULL,
  `karyawan_id` char(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` enum('ijin','sakit') DEFAULT NULL,
  `penjelasan` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `ketentuan_keterangan` text DEFAULT NULL,
  `acc` enum('permohonan','ijin','tolak') DEFAULT 'permohonan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan_cuti`
--

CREATE TABLE `permohonan_cuti` (
  `id` int(11) NOT NULL,
  `karyawan_id` varchar(11) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `penjelasan` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `ketentuan_keterangan` text DEFAULT NULL,
  `acc` enum('permohonan','diterima','ditolak') DEFAULT 'permohonan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `permohonan_cuti`
--

INSERT INTO `permohonan_cuti` (`id`, `karyawan_id`, `tanggal_mulai`, `tanggal_selesai`, `penjelasan`, `file`, `ketentuan_keterangan`, `acc`) VALUES
(3, 'KRY001', '2023-09-24', '2023-09-26', 'pi', 'file_permohonan_cuti/laporan_merged.pdf', '', 'diterima'),
(4, 'KRY001', '2023-09-20', '2023-09-19', 'qweqwe', 'file_permohonan_cuti/13. JADWAL REMIDI DAN PENGAYAAN.pdf', '', 'diterima'),
(5, 'KRY001', '2024-01-15', '2024-01-17', 'ingin mengambil cuti', 'file_permohonan_cuti/perkelas.pdf', '', 'ditolak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `logo` varchar(10) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama_perusahaan`, `alamat`, `kota`, `logo`, `telepon`, `email`, `website`) VALUES
(1, 'Universitas Sahid Surakarta', 'Jl adi sucipto', 'Solo', '061033.jpg', '0258555', 'sahid@gmail.com', 'www.sahid.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_k`
--

CREATE TABLE `users_k` (
  `id_karyawan` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tanggal_bergabung` date NOT NULL,
  `golongan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users_k`
--

INSERT INTO `users_k` (`id_karyawan`, `nama`, `username`, `password`, `departemen`, `jabatan`, `tanggal_bergabung`, `golongan`) VALUES
('KRY001', 'hendi', 'h', '$2y$10$7MYLkBSdN0MnM9FdH2Mo7Oz3ImaxkX2oFomJkoWsmggzrmuDL2/7S', 'Rektorat', 'karyawan', '2023-05-10', '1'),
('KRY002', 'hidayat', 'q', '$2y$10$zwrEdEHhava2jiEFBxHBHeO1cPYrBjSTmvQyQ5aDt68.TaL9vHfna', 'Personalia', 'admin', '2023-09-05', '2'),
('KRY003', 'muamin', 'zz', '$2y$10$LnM2Vf1ysIItoMTTZqRI2OJMLwvDEul1RJdUa4jO5QP2Czc97keHa', 'dosen', 'karyawan', '2024-01-03', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`ID_Gaji`);

--
-- Indeks untuk tabel `golongan_gajih`
--
ALTER TABLE `golongan_gajih`
  ADD PRIMARY KEY (`golongan_id`);

--
-- Indeks untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permohonan`
--
ALTER TABLE `permohonan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permohonan_cuti`
--
ALTER TABLE `permohonan_cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indeks untuk tabel `users_k`
--
ALTER TABLE `users_k`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT untuk tabel `gaji`
--
ALTER TABLE `gaji`
  MODIFY `ID_Gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `golongan_gajih`
--
ALTER TABLE `golongan_gajih`
  MODIFY `golongan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `permohonan`
--
ALTER TABLE `permohonan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `permohonan_cuti`
--
ALTER TABLE `permohonan_cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

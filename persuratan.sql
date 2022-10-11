-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2022 at 04:25 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `persuratan`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` int(11) NOT NULL,
  `kode_surat` varchar(200) NOT NULL,
  `jenis_surat` varchar(200) NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `kode_surat`, `jenis_surat`, `created_at`, `updated_at`) VALUES
(1, '2', 'Siswa', '2022-09-04 18:32:04', '2022-09-04 18:39:49'),
(2, '1', 'Dinas', '2022-09-04 18:42:19', '2022-09-04 18:42:19'),
(4, '3', 'PKL', '2022-09-08 09:50:14', '2022-09-08 09:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `nama_lembaga` varchar(200) NOT NULL,
  `kode_lembaga` varchar(200) NOT NULL,
  `kepala_lembaga` varchar(200) NOT NULL,
  `nip` varchar(200) NOT NULL,
  `kop_surat` varchar(200) NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama_lembaga`, `kode_lembaga`, `kepala_lembaga`, `nip`, `kop_surat`, `created_at`, `updated_at`) VALUES
(1, 'SMKS Riyadlul Qur\'an Ngajum', 'SMKS.RQ', 'Mufarrozi, S.Pd', '-', '1662395935kop.jpg', '', '2022-09-05 23:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `perihal`
--

CREATE TABLE `perihal` (
  `kode` varchar(20) NOT NULL,
  `perihal` varchar(200) NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perihal`
--

INSERT INTO `perihal` (`kode`, `perihal`, `created_at`, `updated_at`) VALUES
('P', 'Pemberitahuan', '2022-09-04 18:51:14', '2022-09-04 18:51:14'),
('U', 'Undangan', '2022-09-04 18:51:02', '2022-09-04 18:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `jenis_surat` varchar(200) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `lampiran` int(12) NOT NULL,
  `isi` text NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tujuan_surat` varchar(255) NOT NULL,
  `file_surat` varchar(255) NOT NULL,
  `jumlah_ttd` int(12) NOT NULL,
  `ttd_1` varchar(200) NOT NULL,
  `nama_1` varchar(200) NOT NULL,
  `nip_1` varchar(200) NOT NULL,
  `ttd_2` varchar(200) NOT NULL,
  `nama_2` varchar(200) NOT NULL,
  `nip_2` varchar(200) NOT NULL,
  `ttd_3` varchar(200) NOT NULL,
  `nama_3` varchar(200) NOT NULL,
  `nip_3` varchar(200) NOT NULL,
  `ttd_4` varchar(200) NOT NULL,
  `nama_4` varchar(200) NOT NULL,
  `nip_4` varchar(200) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `tanggal_surat` varchar(100) NOT NULL,
  `tanggal_terima` varchar(100) NOT NULL,
  `asal_surat` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `file_surat` varchar(255) NOT NULL,
  `penerima` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `foto` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `status`, `foto`, `created_at`, `updated_at`) VALUES
(93, 'admin', 'admin', NULL, '$2y$10$V5hAToLDePYvtkGdsJbQ3uJMWupkUH7WkO.PpXQ705rHCo.W/t4Vm', NULL, 'admin', 1, 'default.jpg', NULL, '2022-06-02 08:19:10'),
(94, 'Kepala Sekolah', 'kepsek', NULL, '$2y$10$.Pw9Iivi.kYEjaKDKpYiCujXkVJNxrM97E.jsBzmwEsOtaqsXO6E2', NULL, 'kepsek', 1, 'default.jpg', '2022-06-02 07:13:06', '2022-09-01 01:13:20'),
(97, 'Rijalul Baqi', 'rijalulb31@gmail.com', NULL, '$2y$10$uX1NYLns.xEHm3aG98MgYuTC1iOKSrUU71vTzrHAtnASodo12Frv6', NULL, 'admin', 1, 'default.jpg', '2022-09-06 08:54:49', '2022-09-06 08:54:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perihal`
--
ALTER TABLE `perihal`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

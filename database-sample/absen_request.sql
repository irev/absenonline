-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Okt 2022 pada 14.22
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobileabsensipas_pasbar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_request`
--

CREATE TABLE `absen_request` (
  `id` bigint(11) NOT NULL,
  `id_admin_instansi` int(11) NOT NULL,
  `admin_instansi` varchar(300) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_panjang` varchar(250) NOT NULL,
  `tgl_absen` date NOT NULL,
  `masuk` datetime NOT NULL,
  `pulang` datetime NOT NULL,
  `status_absen` int(11) NOT NULL DEFAULT 1,
  `parent` bigint(20) NOT NULL,
  `approv` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen_request`
--
ALTER TABLE `absen_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen_request`
--
ALTER TABLE `absen_request`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

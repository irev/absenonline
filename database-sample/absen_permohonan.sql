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
-- Struktur dari tabel `absen_permohonan`
--

CREATE TABLE `absen_permohonan` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(500) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `ttd` varchar(100) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `file` longblob DEFAULT NULL,
  `status` int(11) NOT NULL,
  `admin_instansi` varchar(255) NOT NULL,
  `tgl` date DEFAULT NULL,
  `c_date` datetime NOT NULL DEFAULT current_timestamp(),
  `up_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen_permohonan`
--
ALTER TABLE `absen_permohonan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen_permohonan`
--
ALTER TABLE `absen_permohonan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 05, 2016 at 07:26 AM
-- Server version: 10.1.9-MariaDB-log
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repository_tmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `penelitian`
--

CREATE TABLE `penelitian` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `ref_kelompok_penelitian_id` int(11) NOT NULL,
  `ringkasan` text NOT NULL,
  `tujuan` text NOT NULL,
  `tahun` varchar(200) NOT NULL,
  `jabatan_peneliti` enum('ketua','wakil','anggota','sekre','lainnya') NOT NULL,
  `jabatan_fungsional` enum('utama','madya','muda','pertama','non') NOT NULL,
  `instansi` varchar(200) NOT NULL,
  `kelompok_bidang` enum('kp','mek','ppk','ls') NOT NULL,
  `background` text NOT NULL,
  `conclusion` text NOT NULL,
  `recomendation` text NOT NULL,
  `filename` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_data`
--

CREATE TABLE `penelitian_data` (
  `id` int(11) NOT NULL,
  `data_id` int(11) NOT NULL,
  `penelitian_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_kelompok`
--

CREATE TABLE `penelitian_kelompok` (
  `id` int(11) NOT NULL,
  `penelitian_id` int(11) NOT NULL,
  `id_ref_kelompok_penelitian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_users`
--

CREATE TABLE `penelitian_users` (
  `id` int(11) NOT NULL,
  `penelitian_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi`
--

CREATE TABLE `publikasi` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `tahun` int(11) NOT NULL,
  `ringkasan` int(11) NOT NULL,
  `kategori` enum('jurnal','prosiding','lainnya') NOT NULL,
  `ref_kelompok_penelitian_id` int(11) NOT NULL,
  `penulis` enum('penulis1','penulis2','penulis3','penulis4','penulis5') NOT NULL,
  `instansi` varchar(200) NOT NULL,
  `abstract` text NOT NULL,
  `conclusion` text NOT NULL,
  `recomendation` text NOT NULL,
  `filename` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_users`
--

CREATE TABLE `publikasi_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `publikasi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ref_additional_skills`
--

CREATE TABLE `ref_additional_skills` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `waktu_pelaksanaan` date NOT NULL,
  `type` enum('diklat','seminar') NOT NULL,
  `nameplace` varchar(200) NOT NULL,
  `sertifikat` enum('ya','tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ref_data_pendukung`
--

CREATE TABLE `ref_data_pendukung` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `tahun` varchar(200) NOT NULL,
  `bentuk_file` enum('soft','hard') NOT NULL,
  `filename` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ref_jabatan`
--

CREATE TABLE `ref_jabatan` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ref_kelompok_kepakaran`
--

CREATE TABLE `ref_kelompok_kepakaran` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ref_kelompok_penelitian`
--

CREATE TABLE `ref_kelompok_penelitian` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ref_seminar`
--

CREATE TABLE `ref_seminar` (
  `id` int(11) NOT NULL,
  `judul` int(11) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `type` enum('akun','peneliti','penulis') NOT NULL,
  `status` int(11) NOT NULL,
  `tempat_lahir` varchar(200) NOT NULL,
  `datebirth` date NOT NULL,
  `ref_jabatan_id` int(11) NOT NULL,
  `golongan` varchar(200) NOT NULL,
  `ref_kelompok_penelitian_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `nohp` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `education` varchar(200) NOT NULL,
  `experience` text NOT NULL,
  `ref_kelompok_kepakaran_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_additional_skills`
--

CREATE TABLE `user_additional_skills` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ref_additional_skill_id` int(11) NOT NULL,
  `type` enum('diklat','seminar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

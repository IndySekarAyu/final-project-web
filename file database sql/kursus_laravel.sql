-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221031.25fe766a26
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 11:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kursus_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `akuninternal`
--

CREATE TABLE `akuninternal` (
  `idakuninternal` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(25) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akuninternal`
--

INSERT INTO `akuninternal` (`idakuninternal`, `nama`, `email`, `password`, `level`, `status`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', 'Admin', 'Aktif'),
(16, 'Fahrul Adib', 'fahruladib9@gmail.com', '123', 'Siswa', 'Aktif'),
(18, 'Feby Saputra', 'feby@gmail.com', '123', 'Guru', 'Aktif'),
(19, 'M. Ridwan Tri Saputra', 'ridwan@gmail.com', '123', 'Siswa', 'Aktif'),
(21, 'Aldo Iqbal Dhamoro', 'aldo@gmail.com', '123', 'Siswa', 'Aktif'),
(22, 'Pian', 'pian@gmail.com', '123', 'Guru', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `idguru` int(11) NOT NULL,
  `idakuninternal` int(11) NOT NULL,
  `namaguru` varchar(255) NOT NULL,
  `jeniskelamin` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `notelp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`idguru`, `idakuninternal`, `namaguru`, `jeniskelamin`, `alamat`, `notelp`) VALUES
(1, 18, 'Feby Saputra', 'Laki-laki', 'Kenten Laut', '082273829383'),
(2, 22, 'Pian', 'Laki-laki', 'rumah', '082738928333');

-- --------------------------------------------------------

--
-- Table structure for table `kursus`
--

CREATE TABLE `kursus` (
  `idkursus` int(11) NOT NULL,
  `idguru` int(11) NOT NULL,
  `namakursus` varchar(100) NOT NULL,
  `deskripsikursus` longtext NOT NULL,
  `tanggalawal` date NOT NULL DEFAULT current_timestamp(),
  `tanggalakhir` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kursus`
--

INSERT INTO `kursus` (`idkursus`, `idguru`, `namakursus`, `deskripsikursus`, `tanggalawal`, `tanggalakhir`) VALUES
(12, 1, 'Microsoft Office', 'test', '2024-12-01', '2024-12-31'),
(13, 2, 'Web Programming', 'test', '2024-12-01', '2024-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `idmateri` int(11) NOT NULL,
  `idkursus` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `deskripsi` text NOT NULL,
  `file` text DEFAULT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`idmateri`, `idkursus`, `judul`, `deskripsi`, `file`, `created_by`) VALUES
(1, 12, 'testing', 'asddas', '1732147936_inf.png', 1),
(2, 13, 'Html Dasar', 'disini mempelajari tentang html dasar', '1732183857_jurnal-referensi-tugas-web.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `idpendaftaran` int(11) NOT NULL,
  `idkursus` int(11) NOT NULL,
  `idakuninternal` int(11) NOT NULL,
  `namalengkap` text NOT NULL,
  `tanggallahir` date NOT NULL,
  `tempatlahir` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tanggalpendaftaran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`idpendaftaran`, `idkursus`, `idakuninternal`, `namalengkap`, `tanggallahir`, `tempatlahir`, `alamat`, `nohp`, `status`, `tanggalpendaftaran`) VALUES
(1, 12, 16, 'Fahrul Adib', '2000-11-01', 'Musi Banyuasin', 'asdads', '082282076702', 'Diterima', '2024-11-21'),
(4, 12, 21, 'Aldo Iqbal Damoro', '2000-11-11', 'Banyuasin', 'Camerun', '082783928399', 'Diterima', '2024-11-21'),
(5, 13, 19, 'M. Ridwan Tri Saputra', '2024-11-01', 'asdads', 'sadasd', '082938293833', 'Diterima', '2024-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `progress_materi`
--

CREATE TABLE `progress_materi` (
  `idprogressmateri` int(11) NOT NULL,
  `idmateri` int(11) NOT NULL,
  `idakuninternal` int(11) NOT NULL,
  `status` varchar(250) DEFAULT NULL,
  `markasdone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `progress_materi`
--

INSERT INTO `progress_materi` (`idprogressmateri`, `idmateri`, `idakuninternal`, `status`, `markasdone`) VALUES
(1, 1, 16, '10%', 'Selesai'),
(3, 1, 21, '100%', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `idsiswa` int(11) NOT NULL,
  `idakuninternal` int(11) NOT NULL,
  `namasiswa` varchar(50) NOT NULL,
  `alamat` text DEFAULT NULL,
  `tempatlahir` varchar(250) NOT NULL,
  `tanggallahir` date DEFAULT NULL,
  `notelp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`idsiswa`, `idakuninternal`, `namasiswa`, `alamat`, `tempatlahir`, `tanggallahir`, `notelp`, `email`) VALUES
(14, 16, 'Fahrul Adib', 'asdsadsad', 'adsad', '2024-11-01', '082282076702', 'fahruladib9@gmail.com'),
(15, 19, 'M. Ridwan Tri Saputra', 'sadasd', 'asdads', '2024-11-01', '082938293833', 'ridwan@gmail.com'),
(17, 21, 'Aldo Iqbal Dhamoro', 'camerun', 'Banyuasin', '2000-11-11', '082738922993', 'aldo@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akuninternal`
--
ALTER TABLE `akuninternal`
  ADD PRIMARY KEY (`idakuninternal`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`idguru`);

--
-- Indexes for table `kursus`
--
ALTER TABLE `kursus`
  ADD PRIMARY KEY (`idkursus`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`idmateri`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`idpendaftaran`);

--
-- Indexes for table `progress_materi`
--
ALTER TABLE `progress_materi`
  ADD PRIMARY KEY (`idprogressmateri`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`idsiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akuninternal`
--
ALTER TABLE `akuninternal`
  MODIFY `idakuninternal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `idguru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kursus`
--
ALTER TABLE `kursus`
  MODIFY `idkursus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `idmateri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `idpendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `progress_materi`
--
ALTER TABLE `progress_materi`
  MODIFY `idprogressmateri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `idsiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

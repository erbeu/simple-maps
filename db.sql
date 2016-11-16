-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2016 at 06:18 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `tugas_gis_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Admina', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'Sukijan', 'sukijan', 'a627fd5294a84ec54c91d3eacab0860b');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `icon`) VALUES
(1, 'SPBU', 'SPBU648.png'),
(2, 'Kampus', 'Kampus715.png'),
(3, 'Rumah Sakit', 'Rumah Sakit360.png'),
(5, 'Polisi', 'Polisi860.png'),
(6, 'Rumah Makan', 'Rumah Makan747.png'),
(7, 'Hotel', 'Sutan Raja576.png'),
(8, 'Kantor Pemerintahan', 'Kantor Pemerintahan382.png'),
(9, 'Masjid', 'Masjid167.png');

-- --------------------------------------------------------

--
-- Table structure for table `kotakab`
--

CREATE TABLE `kotakab` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `id_provinsi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kotakab`
--

INSERT INTO `kotakab` (`id`, `nama`, `lat`, `lng`, `id_provinsi`) VALUES
(2, 'Kota Cirebon', -6.732023, 108.552316, 1),
(3, 'Kab Cirebon', -6.710641714937644, 108.4707349589844, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(50) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `id_kotakab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `id_kategori`, `nama`, `alamat`, `foto`, `lat`, `lng`, `id_kotakab`) VALUES
(7, 2, 'IAIN Cirebon', 'lkasjdklasjdlaskd', '2 - IAIN Cirebon968.jpg', -6.73477011665956, 108.53379905734255, 2),
(8, 3, 'RS Gunung Jati', 'Jl. Kesambi No. 56, Kesambi, Cirebon, Jawa Barat 45134, Indonesia', '3 - RS Gunung Jati292.jpg', -6.730380317766447, 108.554591541626, 2),
(9, 6, 'Sumpit (Ramen & Sea Food)', 'Jl. Tuparev No.64, Kedungjaya, Kedawung, Cirebon, Jawa Barat 45153, Indonesia', '6 - Sumpit (Ramen & Sea Food)365.jpg', -6.710162224743369, 108.53754342112734, 3),
(10, 6, 'Empal Gentong Pak Egiet', 'Jl. Raya Plered-Cirebon, Kedawung, Cirebon, Jawa Barat 45153, Indonesia', '6 - Empal Gentong Pak Egiet701.jpeg', -6.709621, 108.529247, 3),
(11, 6, 'Empal Gentong Dan Empal Asem H. ', 'Jl. Raya Ir. H. Djuanda No. 24, Battembat, Tengah Tani, Battembat, Tengah Tani, Cirebon, Jawa Barat, Indonesia', '6 - Empal Gentong Dan Empal Asem H. Apud477.jpg', -6.707681, 108.51787, 3),
(12, 6, 'Waroeng Kupi Aceh', 'Plumbon, Cirebon, West Java, Indonesia', '6 - Waroeng Kupi Aceh40.jpeg', -6.7023738, 108.4711637, 3),
(13, 8, 'Kantor Imigrasi Kelas II Cirebon', 'Jl. Sultan Ageng Tirtayasa No. 51, RT/RW 03/04, Kedungdawa, Kedawung, Kedungdawa, Cirebon, Jawa Barat, 45153, Indonesia', '8 - Kantor Imigrasi Kelas II Cirebon333.jpg', -6.724855720765381, 108.52114975962832, 3),
(14, 8, 'Dinas Pendidikan Kabupaten Cireb', 'No.10, Jl. Sunan Drajat, Sumber, Cirebon, Jawa Barat 45611, Indonesia', '8 - Dinas Pendidikan Kabupaten Cirebon625.jpg', -6.762157515008903, 108.47781599078371, 3),
(15, 7, 'Sutan Raja', 'JL. Tuparev No. 33, Kedungjaya, Kedawung, Cirebon, Jawa Barat 415154, Indonesia', ' - Sutan Raja602.jpg', -6.711025306753123, 108.54537547145082, 3),
(16, 7, 'Zamrud Hotel & Convention', 'Jl. Dr. Wahidin Sudirohusodo No. 46-A, Sukapura, Cirebon, Kota Cirebon, Jawa Barat 45122, Indonesia', '7 - Zamrud Hotel & Convention54.jpg', -6.708394, 108.550538, 2),
(17, 7, 'Tryas', 'Jalan Kartini No.86, Panjunan, Lemahwungkuk, Sukapura, Cirebon, Kota Cirebon, Jawa Barat 45112, Indonesia', '7 - Tryas175.jpg', -6.711755, 108.551334, 2),
(18, 7, 'Grage Hotel Cirebon', 'Jalan R.A. Kartini No. 77, Sukapura, Kejaksan, Kota Cirebon, Jawa Barat 45123, Indonesia', '7 - Grage Hotel Cirebon536.jpg', -6.712747, 108.552779, 2),
(19, 6, 'Nasi Jamblang Ibu Nur', 'Jalan Cangkring II No. 34, Kejaksan, Kota Cirebon, Jawa Barat 45154, Indonesia', '7 - Nasi Jamblang Ibu Nur632.jpg', -6.7138978, 108.5571993, 2),
(20, 6, 'Nasi Jamblang Mang Dul', 'Jalan Doktor Cipto Mangunkusumo No. 8, Pekiringan, Kesambi, Cirebon, Jawa Barat, Indonesia', '7 - Nasi Jamblang Mang Dul127.jpg', -6.7151544, 108.5479346, 2),
(21, 9, 'At Taqwa', 'Jl. Kartini', '9 - At Taqwa742.jpg', -6.71008414017556, 108.55859236909487, 2);

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `nama`, `lat`, `lng`) VALUES
(1, 'Jawa Barat', -7.085623, 107.66811899999993),
(3, 'Jawa Tengah', -7.142796506193841, 110.16400278125002);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kotakab`
--
ALTER TABLE `kotakab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_provinsi` (`id_provinsi`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_wilayah` (`id_kotakab`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `kotakab`
--
ALTER TABLE `kotakab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `kotakab`
--
ALTER TABLE `kotakab`
  ADD CONSTRAINT `kotakab_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

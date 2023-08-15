-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2022 at 06:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_sistem_ta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `Password`) VALUES
(0, 'admin', '6f372c90822f7de721f3e6edc42653a746e81d90'),
(1, 'admin2', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'admin3', '8cb2237d0679ca88db6464eac60da96345513964');

-- --------------------------------------------------------

--
-- Table structure for table `bidangminat`
--

CREATE TABLE `bidangminat` (
  `IDBidangMinat` int(11) NOT NULL,
  `IDProgramStudiKsn` int(11) NOT NULL,
  `IDDosen` bigint(20) NOT NULL,
  `BidangMinat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidangminat`
--

INSERT INTO `bidangminat` (`IDBidangMinat`, `IDProgramStudiKsn`, `IDDosen`, `BidangMinat`) VALUES
(1, 1, 1, 'RPKK'),
(2, 2, 1, 'RPLK'),
(3, 2, 3, 'RSK');

-- --------------------------------------------------------

--
-- Table structure for table `idetugasakhir`
--

CREATE TABLE `idetugasakhir` (
  `IDIde` bigint(20) NOT NULL,
  `IDIdeMahasiswa` bigint(20) NOT NULL,
  `JudulIde` varchar(100) NOT NULL,
  `FileICP` varchar(200) NOT NULL,
  `TanggalIde` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kartubimbingan`
--

CREATE TABLE `kartubimbingan` (
  `IDKartu` int(11) NOT NULL,
  `IDKartuMahasiswa` bigint(30) NOT NULL,
  `IDDosenPembimbing` varchar(30) NOT NULL,
  `Catatan` text NOT NULL,
  `TanggalBimbingan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `IDKegiatan` int(11) NOT NULL,
  `IDUsers` bigint(20) NOT NULL,
  `Kegiatan` varchar(100) NOT NULL,
  `Tempat` varchar(100) NOT NULL,
  `JamKegiatan` time NOT NULL,
  `TanggalKegiatan` date NOT NULL,
  `Finish` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kodeotp`
--

CREATE TABLE `kodeotp` (
  `id_kodeotp` int(11) NOT NULL,
  `tanggal_buat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(150) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `tanggal_kadaluarsa` datetime NOT NULL,
  `status` char(1) NOT NULL COMMENT 'Y=Aktif,N=Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kodeotp`
--

INSERT INTO `kodeotp` (`id_kodeotp`, `tanggal_buat`, `email`, `kode`, `tanggal_kadaluarsa`, `status`) VALUES
(51, '2022-08-09 03:37:06', 'farras@gmail.com', '572139', '2022-08-09 09:59:25', 'N'),
(52, '2022-08-09 03:06:50', 'cahyantoirfan@gmail.com', '012684', '2022-08-09 10:16:33', 'N'),
(53, '2022-08-09 03:08:19', 'cahyantoirfan@gmail.com', '739086', '2022-08-09 10:18:06', 'N'),
(54, '2022-08-09 03:09:20', 'cahyantoirfan@gmail.com', '906384', '2022-08-09 10:19:07', 'N'),
(55, '2022-08-09 03:10:39', 'cahyantoirfan@gmail.com', '239154', '2022-08-09 10:20:24', 'N'),
(56, '2022-08-09 03:37:06', 'farras@gmail.com', '392174', '2022-08-09 10:46:40', 'N'),
(57, '2022-08-09 03:37:46', 'farras@gmail.com', '347908', '2022-08-09 10:47:41', 'N'),
(58, '2022-08-09 03:38:12', 'farras@gmail.com', '352768', '2022-08-09 10:47:53', 'N'),
(59, '2022-08-09 03:45:00', 'adipati@gmail.com', '296784', '2022-08-09 10:54:51', 'N'),
(60, '2022-08-09 03:45:23', 'adipati@gmail.com', '189720', '2022-08-09 10:55:04', 'N'),
(61, '2022-08-09 03:57:43', 'tes@gmail.com', '690382', '2022-08-09 11:07:11', 'N'),
(62, '2022-08-09 03:58:09', 'tes@gmail.com', '170432', '2022-08-09 11:07:51', 'N'),
(63, '2022-08-09 03:58:41', 'cahyantoirfan@gmail.com', '730512', '2022-08-09 11:08:27', 'N'),
(64, '2022-08-09 03:59:36', 'adipati@gmail.com', '932058', '2022-08-09 11:09:13', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `IDNotifikasi` int(11) NOT NULL,
  `Notifikasi` varchar(300) NOT NULL,
  `Catatan` text NOT NULL,
  `TanggalNotifikasi` varchar(40) NOT NULL,
  `IDPenerima` bigint(20) NOT NULL,
  `IDPengirim` bigint(20) NOT NULL,
  `StatusNotifikasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`IDNotifikasi`, `Notifikasi`, `Catatan`, `TanggalNotifikasi`, `IDPenerima`, `IDPengirim`, `StatusNotifikasi`) VALUES
(65, 'Sistem Bagus', 'oke', '2022-08-09', 1817101438, 1, 'Ditolak'),
(66, 'Sistem TA', 'okee', '2022-08-09', 1817101438, 1, 'Ditolak'),
(67, 'Sistem Jos', 's', '2022-08-09', 1817101438, 1, 'Ditolak'),
(68, 'Sistem Jos', 's', '2022-08-09', 1817101438, 1, 'Ditolak'),
(69, 'coba', 'Anda Di Tetapkan Sebagai Dosen Pembimbing Muhammad Irfan Anda sekarang bisa menyetujui proposal maupun tugas akhir Muhammad Irfandan juga menambah kartu bimbingan ', '2022-08-09', 101, 1, 'Informasi'),
(70, 'coba', 'okee', '2022-08-09', 1817101438, 1, 'Diterima'),
(71, 'Sistem Tes', 'okee', '2022-08-09', 1817101401, 1, 'Ditolak'),
(72, 'cobs', 'Anda Di Tetapkan Sebagai Dosen Pembimbing Farras Ahmad Anda sekarang bisa menyetujui proposal maupun tugas akhir Farras Ahmaddan juga menambah kartu bimbingan ', '2022-08-09', 101, 1, 'Informasi'),
(73, 'cobs', 'sip', '2022-08-09', 1817101401, 1, 'Diterima'),
(74, 'Proposal cobs Telah Di ACC', 'Proposal Telah Di ACC Oleh : <br>Adi Pati Sebagai Pembimbing ', '2022-08-09', 1817101401, 101, 'Proposal'),
(75, 'TA Last', 'Anda Di Tetapkan Sebagai Dosen Pembimbing Last Test Anda sekarang bisa menyetujui proposal maupun tugas akhir Last Testdan juga menambah kartu bimbingan ', '2022-08-09', 101, 1, 'Informasi'),
(76, 'TA Last', 'mantap', '2022-08-09', 1817101500, 1, 'Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE `pembimbing` (
  `IDPembimbing` int(11) NOT NULL,
  `IDDosenPmb` bigint(20) NOT NULL,
  `IDTugasAkhirPmb` int(11) NOT NULL,
  `StatusProposal` tinyint(1) NOT NULL,
  `StatusTugasAkhir` tinyint(1) NOT NULL,
  `StatusPembimbing` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembimbing`
--

INSERT INTO `pembimbing` (`IDPembimbing`, `IDDosenPmb`, `IDTugasAkhirPmb`, `StatusProposal`, `StatusTugasAkhir`, `StatusPembimbing`) VALUES
(20, 101, 1660015748, 0, 0, 1),
(21, 101, 1660016370, 1, 0, 1),
(22, 101, 1660017502, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `programstudi`
--

CREATE TABLE `programstudi` (
  `IDProgramStudi` bigint(20) NOT NULL,
  `ProgramStudi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programstudi`
--

INSERT INTO `programstudi` (`IDProgramStudi`, `ProgramStudi`) VALUES
(1, 'Rk Perangkat Keras Kriptografi'),
(2, 'Rekayasa Kriptografi');

-- --------------------------------------------------------

--
-- Table structure for table `tugasakhir`
--

CREATE TABLE `tugasakhir` (
  `IDTugasAkhir` int(20) NOT NULL,
  `IDMahasiswaTugasAkhir` bigint(20) NOT NULL,
  `JudulTugasAkhir` varchar(200) NOT NULL,
  `QRCode` varchar(100) NOT NULL,
  `FileICP` varchar(100) NOT NULL,
  `FileProposal` varchar(100) NOT NULL,
  `FileTugasAkhir` varchar(100) NOT NULL,
  `Uploader` bigint(20) DEFAULT NULL,
  `Deskripsi` text NOT NULL,
  `Tanggal` date NOT NULL,
  `Nilai` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tugasakhir`
--

INSERT INTO `tugasakhir` (`IDTugasAkhir`, `IDMahasiswaTugasAkhir`, `JudulTugasAkhir`, `QRCode`, `FileICP`, `FileProposal`, `FileTugasAkhir`, `Uploader`, `Deskripsi`, `Tanggal`, `Nilai`) VALUES
(1660015748, 1817101438, 'coba', '1817101438.png', '1817101438.pdf', '', '', NULL, '', '2022-08-09', 0),
(1660016370, 1817101401, 'cobs', '1817101401.png', '1817101401.pdf', '', '', NULL, '', '2022-08-09', 0),
(1660017502, 1817101500, 'TA Last', '1817101500.png', '1817101500.pdf', '', '', NULL, '', '2022-08-09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` bigint(20) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `IDProgramStudiUser` bigint(20) NOT NULL,
  `IDBidangMinatUser` bigint(20) NOT NULL,
  `NoHP` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Foto` varchar(30) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Nama`, `Password`, `IDProgramStudiUser`, `IDBidangMinatUser`, `NoHP`, `Email`, `Foto`, `Status`) VALUES
(1, 'Admin RPLK', '8cb2237d0679ca88db6464eac60da96345513964', 2, 2, '', 'cahyantoirfan@gmail.com', '', 'Dosen'),
(101, 'Adi Pati', '8cb2237d0679ca88db6464eac60da96345513964', 2, 2, '', 'adipati@gmail.com', '', 'Dosen'),
(1817101400, 'Muhamad Saleh', '827ccb0eea8a706c4c34a16891f84e7b', 2, 2, '', 'm.saleh@gmail.com', '', 'Mahasiswa'),
(1817101401, 'Farras Ahmad', '8cb2237d0679ca88db6464eac60da96345513964', 2, 2, '', 'farras@gmail.com', '', 'TugasAkhir'),
(1817101402, 'Budi', '$2y$10$PhQlB2yNi27CJwz.P0RHWeVh2qaYEiCyUsyRxjQeB763n4R.17M8W', 2, 2, '', 'budi@gmail.com', '', 'Mahasiswa'),
(1817101438, 'Muhammad Irfan', '8cb2237d0679ca88db6464eac60da96345513964', 2, 2, '', 'cahyantoirfan@gmail.com', '', 'TugasAkhir'),
(1817101500, 'Last Test', '8cb2237d0679ca88db6464eac60da96345513964', 2, 2, '', 'tes@gmail.com', '', 'TugasAkhir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bidangminat`
--
ALTER TABLE `bidangminat`
  ADD PRIMARY KEY (`IDBidangMinat`);

--
-- Indexes for table `idetugasakhir`
--
ALTER TABLE `idetugasakhir`
  ADD PRIMARY KEY (`IDIde`);

--
-- Indexes for table `kartubimbingan`
--
ALTER TABLE `kartubimbingan`
  ADD PRIMARY KEY (`IDKartu`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`IDKegiatan`);

--
-- Indexes for table `kodeotp`
--
ALTER TABLE `kodeotp`
  ADD PRIMARY KEY (`id_kodeotp`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`IDNotifikasi`);

--
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`IDPembimbing`);

--
-- Indexes for table `programstudi`
--
ALTER TABLE `programstudi`
  ADD PRIMARY KEY (`IDProgramStudi`);

--
-- Indexes for table `tugasakhir`
--
ALTER TABLE `tugasakhir`
  ADD PRIMARY KEY (`IDTugasAkhir`),
  ADD KEY `nim_mhs_skripsi` (`IDMahasiswaTugasAkhir`),
  ADD KEY `uploader` (`Uploader`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_jurusan_mhs` (`IDProgramStudiUser`),
  ADD KEY `id_konsentrasi_mhs` (`IDBidangMinatUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidangminat`
--
ALTER TABLE `bidangminat`
  MODIFY `IDBidangMinat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kartubimbingan`
--
ALTER TABLE `kartubimbingan`
  MODIFY `IDKartu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `IDKegiatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kodeotp`
--
ALTER TABLE `kodeotp`
  MODIFY `id_kodeotp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `IDNotifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `IDPembimbing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tugasakhir`
--
ALTER TABLE `tugasakhir`
  ADD CONSTRAINT `uploader` FOREIGN KEY (`Uploader`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

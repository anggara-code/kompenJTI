-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2018 at 10:17 AM
-- Server version: 10.1.35-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kompenjt_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` int(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `prodi` varchar(10) NOT NULL,
  `tahun_masuk` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nomor_telepon` varchar(250) NOT NULL,
  `foto_profil` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama_lengkap`, `prodi`, `tahun_masuk`, `username`, `password`, `nomor_telepon`, `foto_profil`, `email`) VALUES
(1531140001, 'Indah Rachma', 'D3 MI', '2015', 'indah', 'f3385c508ce54d577fd205a1b2ecdfb7', '085735538263', 'dosen1.png', 'indahrachma@gmail.com'),
(1531140002, 'M. Rifqi Kevin', 'D3 MI', '2015', 'kevin', '9d5e3ecdeb4cdb7acfd63075ae046672', '085735538263', 'dosen1.png', 'kadeksuarjuna87@gmail.com'),
(1531140003, 'M. Rifqi Keenan', 'D3 MI', '2015', 'keenan', '6420e72c312bbc881cd01b734f5c6b7d', '0895342688799', 'dosen1.png', 'kadeksuarjuna87@gmail.com'),
(1531140004, 'Fandhi Fajar Pratama', 'D3 MI', '2015', 'fandi', '9bb773615bccfc87168aa059884ca038', '08950000000', 'dosen1.png', 'saptaahmada@gmail.com'),
(1531140005, 'Deni Chandra Wahyudi', 'D3 MI', '2015', 'decan', '5d9e545fe454484c77c66babd608f094', '08953535353535', 'dosen1.png', 'dimazchandra31@gmail.com'),
(1531140008, 'Sofia Falah', 'D3 MI', '2015', 'sofia', '17da1ae431f965d839ec8eb93087fb2b', '085735538263', 'dosen1.png', 'kadeksuarjuna87@gmail.com'),
(1531140009, 'Afrilian Nuraini', 'D3 MI', '2015', 'afrilian', '14858e0204a599ce15e5b3ebb1d4e432', '085735538263', 'dosen1.png', 'kadeksuarjuna87@gmail.com'),
(1531140011, 'Medana Putri', 'D3 MI', '2015', 'medana', '620f6cb82894a24564021822cafe9ef6', '0895342688799', 'dosen1.png', 'kadeksuarjuna87@gmail.com'),
(1531140012, 'Ninda Arani', 'D3 MI', '2015', 'ninda', '70090d3b9c2cc498a35a8a93c2a5b4b1', '08950000000', 'dosen1.png', 'kadeksuarjuna87@gmail.com'),
(1531140013, 'Estiti Hariadi', 'D3 MI', '2015', 'estiti', '3c2c329587e38f4df6a189bf6343c4f9', '08953535353535', 'dosen1.png', 'dimazchandra31@gmail.com'),
(1531140014, 'Siti Robi\'us Septya Wulandari', 'D3 MI', '2015', 'siti', 'db04eb4b07e0aaf8d1d477ae342bdff9', '0895342688799', 'dosen1.png', 'kadeksuarjuna87@gmail.com'),
(1531140042, 'Deni Pratama', 'D3 MI', '2015', 'depra', 'e0cd0084beceb32568fe03ced1197d24', '08950000000', 'dosen1.png', 'saptaahmada@gmail.com'),
(1531140043, 'Sapta Ahmad Afrizal', 'D3 MI', '2015', 'sapta', '4c63094cc2231780565c49c1badf9b2c', '0895342688799', 'mahasiswa1.png', 'saptaahmada@gmail.com'),
(1531140044, 'Ana Khuroida Pratiwi', 'D3 MI', '2015', 'kuro', '53861aa015b53456915f6a6ccf8456f5', '08953535353535', 'dosen1.png', 'dimazchandra31@gmail.com'),
(1531140076, 'MUHAMMAD RIFKY PRAYANTA', 'D3 MI', '2015', 'rifky', 'c7606d21629a29f87ddff80ca16d5219', '08950000000', 'dosen1.png', 'saptaahmada@gmail.com'),
(1531140091, 'Cinta dan kasih sayang', 'D4 TI', '2015', 'cinta', 'c3653e4408832e6611f37dcd90544de8', '0895342688799', 'mahasiswa12.png', 'saptaahmada@gmail.com'),
(1531140107, 'Dimas Chandra Kusumawardana', 'D3 MI', '2015', 'dimasck', 'b96dd8d14b692cfea796f9f3c9cf1b3d', 'c8f2ca798d72ad726b68a5ef5ba03de9', 'dosen1.png', 'dimazchandra31@gmail.com'),
(1531140111, 'Fita', 'D3 MI', '2015', 'fita', '52998c670d491bebb072923b8f7ccecb', '0895342688799', 'admin2.png', 'kadeksuarjuna87@gmail.com'),
(1531140112, 'Zahrotul Jannah', 'D4 TI', '2015', 'iza', '127e633f8c5b2a4f867049116b6bc9ea', '0895342688799', 'admin1.png', 'kadeksuarjuna87@gmail.com'),
(1641720110, 'Fajar Audi', 'D4 TI', '2016', 'fajar', '24bc50d85ad8fa9cda686145cf1f8aca', '0895342688799', 'image1.png', 'saptaahmada@gmail.com'),
(1641720179, 'Nadya Disty', 'D4 TI', '2016', 'nadya', '1e6eb2590ee576e8f788729ad596403a', '0895342688799', 'image.png', 'saptaahmada@gmail.com'),
(1731710096, 'lukman hakim saputra', 'D3 MI', '2017', 'lukman', 'b5bbc8cf472072baffe920e4e28ee29c', '082234011975', 'mahasiswa14.png', 'hakim2225saputra@gmail.com'),
(1741727002, 'ABDUL JABBAR', 'D4 TI', '2014', 'abdul', '82027888c5bb8fc395411cb6804a066c', '0895342688799', 'logo-for-print-new.png', 'saptaahmada@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pemberi_tugas`
--

CREATE TABLE `pemberi_tugas` (
  `nip` bigint(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nomor_telepon` varchar(50) NOT NULL,
  `foto_profil` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` enum('dosen','admin') NOT NULL,
  `super_admin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemberi_tugas`
--

INSERT INTO `pemberi_tugas` (`nip`, `nama_lengkap`, `username`, `password`, `nomor_telepon`, `foto_profil`, `email`, `level`, `super_admin`) VALUES
(3510, 'kadek suarjuna batubulan', 'kadek', 'e9feb314cc7b95ee66261e84bcf7eca4', '085369199997', '200.jpg', 'kadeksuarjuna87@gmail.com', 'admin', 1),
(197710302005012001, 'Mungki Astiningrum, ST., M.Kom', 'mungki', 'bc6c7570b266bce36b60fb6c3c6e96e6', '08950000001', 'admin21.png', 'bumungki@gmail.com', 'dosen', 0),
(198211302014041001, 'Hendra Pradibta', 'hendra', 'a04cca766a885687e33bc6b114230ee9', '085369199997', '2001.jpg', 'hendra@polinema.ac.id', 'dosen', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_tugas`
--

CREATE TABLE `transaksi_tugas` (
  `id` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `jam_kompen` int(11) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `tanggal_input` varchar(50) NOT NULL,
  `tanggal_validasi` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(50) NOT NULL,
  `nip` bigint(50) NOT NULL,
  `judul_tugas` varchar(50) NOT NULL,
  `tipe_tugas` enum('penugasan','pembelian') NOT NULL,
  `kuota` int(11) NOT NULL,
  `jumlah_kompen` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `ditutup` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `nip`, `judul_tugas`, `tipe_tugas`, `kuota`, `jumlah_kompen`, `date`, `deskripsi`, `ditutup`) VALUES
(6, 3510, 'Stempel', 'penugasan', 6, 10, '30-10-2018 07:30:21', 'stempel laporan', 0),
(7, 197710302005012001, 'beli sapu', 'pembelian', 20, 10, '31-10-2018 22:56:57', 'Beli sapu untuk nyapu', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `pemberi_tugas`
--
ALTER TABLE `pemberi_tugas`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `transaksi_tugas`
--
ALTER TABLE `transaksi_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`),
  ADD KEY `id_tugas` (`id_tugas`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_tugas` (`id_tugas`),
  ADD KEY `nip_2` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi_tugas`
--
ALTER TABLE `transaksi_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi_tugas`
--
ALTER TABLE `transaksi_tugas`
  ADD CONSTRAINT `transaksi_tugas_ibfk_1` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_tugas_ibfk_2` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

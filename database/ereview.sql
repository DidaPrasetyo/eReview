-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2020 at 01:17 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ereview`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id_assign` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `id_pembayaran` int(11) NOT NULL,
  `id_reviewer` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `price` float NOT NULL,
  `tgl_assign` date DEFAULT NULL,
  `tgl_deadline` date DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_assign` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id_assign`, `id_task`, `id_pembayaran`, `id_reviewer`, `status`, `price`, `tgl_assign`, `tgl_deadline`, `date_created`, `date_updated`, `sts_assign`) VALUES
(64, 7, 0, 1, 1, 300000, '2020-05-13', '2020-06-02', '2020-05-12 23:14:46', '2020-05-12 23:14:46', 1),
(65, 7, 0, 2, 1, 300000, '2020-05-13', '2020-06-02', '2020-05-12 23:14:47', '2020-05-12 23:14:47', 1),
(66, 7, 0, 6, 1, 300000, '2020-05-13', '2020-06-02', '2020-05-12 23:14:47', '2020-05-12 23:14:47', 1),
(67, 7, 0, 7, 1, 300000, '2020-05-13', '2020-06-02', '2020-05-12 23:14:47', '2020-05-12 23:14:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `editor`
--

CREATE TABLE `editor` (
  `id_editor` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_editor` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `editor`
--

INSERT INTO `editor` (`id_editor`, `id_user`, `nama`, `date_created`, `date_updated`, `sts_editor`) VALUES
(1, 6, 'Dida Prasetyo Rahmat', '2020-02-28 08:09:56', '0000-00-00 00:00:00', 1),
(2, 12, 'Si Bambang', '2020-04-27 23:15:04', '2020-04-27 23:15:04', 1),
(6, 16, 'si siti', '2020-05-07 23:09:34', '2020-05-07 23:09:34', 1),
(7, 17, 'jangkrik', '2020-05-08 01:31:36', '2020-05-08 01:31:36', 1),
(8, 18, 'duar', '2020-05-10 00:46:50', '2020-05-10 00:46:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE `grup` (
  `id_grup` int(11) NOT NULL,
  `nama_grup` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_grup` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`id_grup`, `nama_grup`, `date_created`, `date_updated`, `sts_grup`) VALUES
(1, 'editor', '2020-03-12 05:56:08', '2020-03-12 05:57:48', 1),
(2, 'reviewer', '2020-03-12 05:56:08', '2020-03-12 05:57:48', 1),
(3, 'makelar', '2020-03-12 05:56:19', '2020-03-12 05:57:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `makelar`
--

CREATE TABLE `makelar` (
  `id_makelar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_makelar` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `id_grup` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_member` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `id_grup`, `id_user`, `date_created`, `date_updated`, `sts_member`) VALUES
(1, 1, 6, '2020-03-12 06:48:49', '2020-03-12 06:48:49', 1),
(2, 2, 7, '2020-03-12 06:56:12', '2020-03-12 06:56:12', 1),
(3, 3, 11, '2020-03-26 15:12:27', '2020-03-26 15:12:27', 1),
(4, 1, 12, '2020-04-27 23:15:04', '2020-04-27 23:15:04', 1),
(5, 2, 12, '2020-04-27 23:15:04', '2020-04-27 23:15:04', 1),
(6, 1, 13, '2020-05-07 23:02:33', '2020-05-07 23:02:33', 1),
(7, 2, 13, '2020-05-07 23:02:33', '2020-05-07 23:02:33', 1),
(8, 1, 14, '2020-05-07 23:04:09', '2020-05-07 23:04:09', 1),
(9, 2, 14, '2020-05-07 23:04:09', '2020-05-07 23:04:09', 1),
(10, 1, 15, '2020-05-07 23:04:44', '2020-05-07 23:04:44', 1),
(11, 2, 15, '2020-05-07 23:04:44', '2020-05-07 23:04:44', 1),
(12, 1, 16, '2020-05-07 23:09:34', '2020-05-07 23:09:34', 1),
(13, 2, 16, '2020-05-07 23:09:34', '2020-05-07 23:09:34', 1),
(14, 1, 17, '2020-05-08 01:31:36', '2020-05-08 01:31:36', 1),
(15, 1, 18, '2020-05-10 00:46:50', '2020-05-10 00:46:50', 1),
(16, 2, 18, '2020-05-10 00:46:50', '2020-05-10 00:46:50', 1),
(17, 1, 19, '2020-05-10 00:53:54', '2020-05-10 00:53:54', 1),
(18, 2, 19, '2020-05-10 00:53:54', '2020-05-10 00:53:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `amount` float NOT NULL,
  `bukti` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `id_task` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_payment` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `amount`, `bukti`, `status`, `id_task`, `date_created`, `date_updated`, `sts_payment`) VALUES
(15, 1200000, '1589325384_index.jpg', 1, 7, '2020-05-12 23:14:47', '2020-05-12 23:14:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviewer`
--

CREATE TABLE `reviewer` (
  `id_reviewer` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_rek` int(11) NOT NULL,
  `kompetensi` text NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviewer`
--

INSERT INTO `reviewer` (`id_reviewer`, `id_user`, `no_rek`, `kompetensi`, `date_created`, `date_updated`) VALUES
(1, 7, 0, '', '2020-03-12 06:16:32', '2020-03-12 06:16:32'),
(2, 12, 0, '', '2020-04-27 23:15:04', '2020-04-27 23:15:04'),
(6, 16, 0, '', '2020-05-07 23:09:34', '2020-05-07 23:09:34'),
(7, 18, 1234567890, 'pro, banget, sangat pro', '2020-05-10 00:46:50', '2020-05-10 00:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id_task` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `authors` varchar(300) DEFAULT NULL,
  `keywords` varchar(300) DEFAULT NULL,
  `file_loc` varchar(300) DEFAULT NULL,
  `page` int(11) NOT NULL,
  `id_editor` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_uploaded` timestamp NULL DEFAULT NULL,
  `sts_task` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id_task`, `judul`, `authors`, `keywords`, `file_loc`, `page`, `id_editor`, `date_created`, `date_uploaded`, `sts_task`) VALUES
(7, 'buku', 'bambang', 'baru', '1589325265_05311940000019_Dida_Prasetyo_Rahmat_Kelas_Agama_Kristen_3_Tugas_2.docx', 20, 2, '2020-05-12 23:14:25', '2020-05-12 23:14:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(256) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  `sts_user` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `email`, `photo`, `date_created`, `date_updated`, `sts_user`) VALUES
(6, 'didapras', 'abf4b25615c2e7d7d179458bf791e9ba', 'Dida Prasetyo Rahmat', 'didaprasetyorahmat@gmail.com', '', '2020-03-12 06:16:32', '2020-03-12 06:16:32', 1),
(7, 'dida', 'b9343bdbf698cbc25b1528b0512e6210', 'Si Dida Lagi', 'didaprasetyorahmat@gmail.com', '', '2020-03-12 06:53:37', '2020-03-12 06:53:37', 1),
(11, 'didapras231', 'ef8961d24bdfaff391c292cd82fd3bed', 'dida trus', 'didaprasetyorahmat@gmail.com', '', '2020-04-15 18:02:02', '2020-04-15 18:02:02', 1),
(12, 'bambang', 'a9711cbb2e3c2d5fc97a63e45bbe5076', 'Si Bambang', 'bambang@bambang.bang', 'bambang.png', '2020-04-27 23:15:04', '2020-04-27 23:15:04', 1),
(16, 'nurjanah', 'd1828192d6f3a0599e751d35d78807ee', 'si siti', 'nuraeni@ae.com', NULL, '2020-05-07 23:09:34', '2020-05-07 23:09:34', 1),
(17, 'boss', 'ceb8447cc4ab78d2ec34cd9f11e4bed2', 'jangkrik', 'jangkrik@boss.com', NULL, '2020-05-08 01:31:36', '2020-05-08 01:31:36', 1),
(18, 'duar', '64089e9dfb3d51ea8e7fd688037fa9f3', 'duar', 'duar@duar.duar', 'duarbambang.png', '2020-05-10 00:53:54', '2020-05-10 00:53:54', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id_assign`);

--
-- Indexes for table `editor`
--
ALTER TABLE `editor`
  ADD PRIMARY KEY (`id_editor`) USING BTREE;

--
-- Indexes for table `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`id_grup`);

--
-- Indexes for table `makelar`
--
ALTER TABLE `makelar`
  ADD PRIMARY KEY (`id_makelar`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `reviewer`
--
ALTER TABLE `reviewer`
  ADD PRIMARY KEY (`id_reviewer`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id_task`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id_assign` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `editor`
--
ALTER TABLE `editor`
  MODIFY `id_editor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `id_grup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `makelar`
--
ALTER TABLE `makelar`
  MODIFY `id_makelar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reviewer`
--
ALTER TABLE `reviewer`
  MODIFY `id_reviewer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

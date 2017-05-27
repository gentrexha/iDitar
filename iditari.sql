-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2017 at 11:50 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iditari`
--

-- --------------------------------------------------------

--
-- Table structure for table `ditari`
--

CREATE TABLE `ditari` (
  `did` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `nota` varchar(10) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ditari`
--

INSERT INTO `ditari` (`did`, `sid`, `lid`, `uid`, `nota`, `data`) VALUES
(1, 1, 0, 4, '5', '2017-05-08 00:00:00'),
(2, 3, 0, 4, '3', '2017-05-01 00:00:00'),
(3, 7, 0, 4, '2', '2017-05-23 00:00:00'),
(4, 4, 0, 4, '4', '2017-05-02 00:00:00'),
(5, 5, 0, 4, '1', '2017-05-22 05:00:00'),
(6, 2, 1, 4, '5', '2017-05-26 18:14:50'),
(7, 7, 1, 0, '4', '2017-05-26 19:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `lendet`
--

CREATE TABLE `lendet` (
  `lid` int(11) NOT NULL,
  `Emri` varchar(50) NOT NULL,
  `NrOreve` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lendet`
--

INSERT INTO `lendet` (`lid`, `Emri`, `NrOreve`) VALUES
(1, 'Fizike', '20'),
(2, 'Biologji', '24');

-- --------------------------------------------------------

--
-- Table structure for table `proflende`
--

CREATE TABLE `proflende` (
  `plid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `Orari` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proflende`
--

INSERT INTO `proflende` (`plid`, `lid`, `uid`, `Orari`) VALUES
(1, 2, 4, 'Merkure 10:00-10:45');

-- --------------------------------------------------------

--
-- Table structure for table `studentet`
--

CREATE TABLE `studentet` (
  `sid` int(11) NOT NULL,
  `Emri` varchar(20) NOT NULL,
  `Mbiemri` varchar(20) NOT NULL,
  `Klasa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentet`
--

INSERT INTO `studentet` (`sid`, `Emri`, `Mbiemri`, `Klasa`) VALUES
(1, 'Agron', 'Gashi', '9/1'),
(2, 'Arsim', 'Thaci', '9/1'),
(3, 'Besa', 'Gashi', '9/1'),
(4, 'Besnik', 'Beqiraj', '9/2'),
(5, 'Adea', 'Hoxha', '9/2'),
(6, 'Afrim', 'Gola', '9/3'),
(7, 'Endrit', 'Peja', '9/4'),
(8, 'Rinor', 'Haziri', '9/4'),
(9, 'Kadri', 'Kolshi', '9/4'),
(10, 'Nora', 'Brovina', '9/5'),
(11, 'Blerta', 'Rexha', '9/4'),
(12, 'Besart', 'Abazi', '9/1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `Emri` varchar(20) NOT NULL,
  `Mbiemri` varchar(20) NOT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `User` varchar(30) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `SaltedHashPwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `Emri`, `Mbiemri`, `Email`, `User`, `salt`, `SaltedHashPwd`) VALUES
(4, 'Gent', 'Rexha', 'gent.rexha@gmail.com', 'genti', '40f462a1ab037f2110fa9b6b1d007c21', '0a7d33109e96df47ab04221031208a28bc20519e52a99825a49094a0fd276dfa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ditari`
--
ALTER TABLE `ditari`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `lendet`
--
ALTER TABLE `lendet`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `proflende`
--
ALTER TABLE `proflende`
  ADD PRIMARY KEY (`plid`);

--
-- Indexes for table `studentet`
--
ALTER TABLE `studentet`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `User` (`User`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ditari`
--
ALTER TABLE `ditari`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `lendet`
--
ALTER TABLE `lendet`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `proflende`
--
ALTER TABLE `proflende`
  MODIFY `plid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `studentet`
--
ALTER TABLE `studentet`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

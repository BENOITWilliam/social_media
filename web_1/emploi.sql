-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2024 at 09:41 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `likedin`
--

-- --------------------------------------------------------

--
-- Table structure for table `emploi`
--

CREATE TABLE `emploi` (
  `ID_Emploi` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Desc_courte` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emploi`
--

INSERT INTO `emploi` (`ID_Emploi`, `Nom`, `Desc_courte`, `Description`, `Image`) VALUES
(1, 'Jungler', 'courte', 'Cherche jungler qui n\'est pas un teemo qui flash pour ks', ''),
(3, 'Pilote F1', 'Cherche Pilote de F1', 'Cherche un pilote de F1 pour remplacer Ocon. Ce pilote doit avoir un talent et des sponsors qui le suivent. On cherche quelqu\'un qui suis les consignes d\'équipes et qui de dive pas par folie son coéquipier car on aimerait gagner des points.', 'documents/emploi/alpine.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emploi`
--
ALTER TABLE `emploi`
  ADD PRIMARY KEY (`ID_Emploi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emploi`
--
ALTER TABLE `emploi`
  MODIFY `ID_Emploi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2024 at 05:05 PM
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
  `Nom` varchar(255) NOT NULL,
  `Desc_courte` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL DEFAULT 'documents/site/emploi.jpg',
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emploi`
--

INSERT INTO `emploi` (`ID_Emploi`, `Nom`, `Desc_courte`, `Description`, `Image`, `Date`) VALUES
(1, 'Jgl teemo', 'simple teemo flash', 'un ptit demon', 'documents/emploi/teemo.png', '2024-05-30'),
(3, 'Pilote F1', 'Cherche Pilote de F1', 'Cherche un pilote de F1 pour remplacer Ocon. Ce pilote doit avoir un talent et des sponsors qui le suivent. On cherche quelqu\'un qui suis les consignes d\'équipes et qui ne dive pas par folie son coéquipier car on aimerait gagner des points.', 'documents/emploi/alpine.png', '2024-05-30'),
(8, 'ingénieur', 'efé', 'éea', 'documents/site/emploi.jpg', '2024-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `ID_Event` int(11) NOT NULL,
  `ID_Emetteur` int(11) NOT NULL,
  `Lien` varchar(255) NOT NULL DEFAULT 'documents/event/event.jpg',
  `Nom` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Date` varchar(255) NOT NULL,
  `Heure` varchar(255) NOT NULL,
  `Lieu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`ID_Event`, `ID_Emetteur`, `Lien`, `Nom`, `Description`, `Date`, `Heure`, `Lieu`) VALUES
(3, 1, 'documents/event/17018.jpg', 'test', '', '2024-05-31', '', ''),
(4, 5, 'documents/event/event.jpg', 'TestFinal', 'TestFinal', '2024-06-02', '', ''),
(5, 2, 'documents/event/Capture d\'écran 2023-03-08 012515.png', 'RDV CINE', 'On va voir le dernier James Bond', '2024-06-13', '03:41', 'Cinéma Beaugrenelle');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `Message` text,
  `id_Destinataire` int(11) DEFAULT NULL,
  `id_Auteur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id_message`, `Message`, `id_Destinataire`, `id_Auteur`) VALUES
(21, 'Salut tu joues', 1, 2),
(22, '?', 1, 2),
(23, 'oui et toi', 2, 1),
(24, 'perso teemo jungle', 2, 1),
(25, 'et kayle supp', 2, 1),
(26, 'pourquoi pas un yummi top ?', 2, 1),
(47, 'En vrai', 1, 2),
(52, 'flash q et frist blood ', 1, 2),
(53, 'salut', 1, 3),
(54, 'noob', 1, 2),
(55, 'coucou', 1, 2),
(56, 'comment tu vas\r\n', 1, 3),
(57, 'tu fais quoi ?', 2, 1),
(58, 'merci pour le canon', 2, 1),
(59, 'tu touches ?\r\n', 1, 2),
(60, 're', 1, 2),
(61, 're', 1, 2),
(62, 're', 2, 1),
(63, 'cq', 1, 2),
(64, 'coucou', 2, 1),
(65, 'salut teemo !!!', 1, 2),
(66, 'Coucou', 2, 1),
(67, 'slt', 2, 1),
(68, 'slt', 2, 1),
(69, 'ds', 1, 2),
(70, 'slt', 2, 1),
(71, 'de\r\n', 1, 2),
(72, 'fr', 1, 2),
(73, 'la putain de sa mère\r\n', 2, 1),
(74, 'fr', 1, 2),
(75, 'la putain de sa mère\r\n', 2, 1),
(76, 'a', 2, 1),
(77, 'z', 1, 2),
(78, 'a', 2, 1),
(79, 'VICTOIRE', 2, 1),
(80, 'VICTOIRE', 2, 1),
(81, 'VICTOIRE', 2, 1),
(82, 'VICTOIRE', 2, 1),
(83, 'VICTOIRE', 2, 1),
(84, 'VICTOIRE', 2, 1),
(85, 'VICTOIRE', 2, 1),
(86, 'VICTOIRE', 2, 1),
(87, 'VICTOIRE', 2, 1),
(88, 'VICTOIRE', 2, 1),
(89, 'VICTOIRE', 2, 1),
(90, 'VICTOIRE', 2, 1),
(91, 'VICTOIRE', 2, 1),
(92, 'VICTOIRE', 2, 1),
(93, 'VICTOIRE', 2, 1),
(94, 'VICTOIRE', 2, 1),
(95, 'VICTOIRE', 2, 1),
(96, 'VICTOIRE', 2, 1),
(97, 'nsm', 2, 1),
(98, 'on game ce soir ', 2, 1),
(99, 'ntm\r\n', 1, 2),
(100, 'je te prends toi et ta maman sur le vieux port', 2, 1),
(101, 'slt', 2, 1),
(102, 'ta mère', 2, 1),
(103, 'slt comment tu vas', 2, 1),
(104, 'salut faisons connaissance', 2, 3),
(105, 'ntm', 1, 2),
(106, 'slt', 1, 2),
(107, 'ntm', 2, 1),
(108, 'lmp', 2, 1),
(109, '55', 1, 2),
(110, 'j', 1, 2),
(111, 'jk', 1, 2),
(112, 'perso ca va', 1, 3),
(113, 'je mange', 1, 3),
(114, ' ', 1, 2),
(115, 'hyiizea', 2, 1),
(116, 'salit', 2, 1),
(117, 's', 2, 1),
(118, 's', 2, 1),
(119, 's', 2, 1),
(120, 's', 1, 2),
(121, 'comment tu vas', 1, 2),
(122, 'ça va', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `ID_Post` int(11) NOT NULL,
  `ID_Emetteur` int(11) NOT NULL,
  `Lien` text NOT NULL,
  `Description` text,
  `Date` text,
  `Lieu` text,
  `Heure` text,
  `Privé` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`ID_Post`, `ID_Emetteur`, `Lien`, `Description`, `Date`, `Lieu`, `Heure`, `Privé`) VALUES
(1, 1, 'documents/emploi/did.mp4', 'Une image de paysage et je test des choses comme ça pour savoir si ça marche lalalilalaire', '', 'ECE', '11:28', 0),
(2, 2, '2', '2', '2', '222', '2', 0),
(3, 1, 'documents/post/post.jpg', 'z', 'z', 'z', 'z', 0),
(4, 1, 'documents/post/post.jpg', '', '', '', '', 0),
(5, 1, 'documents/emploi/teemo.png', '1', '', '1', '', 0),
(8, 1, 'documents/emploi/mc.png', 'Vieille photo de mon monde MC sur un serveur qui n\'existe plus. ', '2024-06-01', 'Serveur Mc', '13:33', 1),
(9, 3, 'documents/post/teemo.png', '', '', '', '', 1),
(10, 1, 'documents/post/fond2.png', 'test', '', '', '', 0),
(11, 5, 'documents/post/photo1 (2).jpg', '', '', '', '', 0),
(12, 5, 'documents/post/did.mp4', '', '', '', '', 1),
(14, 1, 'documents/post/5472d1b09d3d724228109d381d617326.jpg', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reaction`
--

CREATE TABLE `reaction` (
  `ID` int(11) NOT NULL,
  `ID_Post` int(11) NOT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `ID_Emetteur` int(11) NOT NULL,
  `aime` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reaction`
--

INSERT INTO `reaction` (`ID`, `ID_Post`, `Description`, `ID_Emetteur`, `aime`) VALUES
(1, 8, 'super', 1, 0),
(2, 1, NULL, 1, 0),
(3, 8, NULL, 2, 0),
(4, 3, NULL, 1, 0),
(5, 14, NULL, 1, 0),
(6, 3, NULL, 2, 0),
(7, 4, NULL, 2, 0),
(8, 1, NULL, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `relation`
--

CREATE TABLE `relation` (
  `ID_relation` int(11) NOT NULL,
  `ID_demandeur_ami` int(11) DEFAULT NULL,
  `ID_ami` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `relation`
--

INSERT INTO `relation` (`ID_relation`, `ID_demandeur_ami`, `ID_ami`) VALUES
(13, 1, 2),
(14, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ID` int(11) NOT NULL,
  `Pseudo` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `MDP` varchar(255) DEFAULT NULL,
  `NC` int(11) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`ID`, `Pseudo`, `Email`, `MDP`, `NC`, `Image`, `Photo`, `Description`) VALUES
(1, 'Sowgan', 's.g@gmail.com', '123', 1, 'documents/fond/fond1.jpeg', 'documents/photo/photo1.jpg', ''),
(2, 'Teemo', 'Teemo.demon@faille.invocateur', '456', 0, 'documents/fond/teemo.png', 'documents/photo/teemo.png', ''),
(3, 'Zoro', 'chiot@edu.fr', '741', 0, NULL, NULL, NULL),
(4, 'yas', '123@mp.fr', '789', 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emploi`
--
ALTER TABLE `emploi`
  ADD PRIMARY KEY (`ID_Emploi`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`ID_Event`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID_Post`);

--
-- Indexes for table `reaction`
--
ALTER TABLE `reaction`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`ID_relation`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emploi`
--
ALTER TABLE `emploi`
  MODIFY `ID_Emploi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `ID_Event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `ID_Post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reaction`
--
ALTER TABLE `reaction`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `relation`
--
ALTER TABLE `relation`
  MODIFY `ID_relation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : ven. 31 mai 2024 à 15:21
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `likedin`
--

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `ID_Post` int NOT NULL AUTO_INCREMENT,
  `ID_Emetteur` int NOT NULL,
  `Lien` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Date` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Lieu` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Heure` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`ID_Post`)
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`ID_Post`, `ID_Emetteur`, `Lien`, `Description`, `Date`, `Lieu`, `Heure`) VALUES
(1, 18, 'documents/fond/test.jpg', 'L\'Union européenne (UE)Note 3 est une union politico-économique sui generis de vingt-sept États européens qui délèguent ou transmettent par traité l’exercice de certaines compétences à des organes communautaires4,5. Elle s\'étend sur un territoire de 4,2 millions de kilomètres carrés6, est peuplée de plus de 447 millions d\'habitants et est la troisième puissance économique mondiale par son PIB nominal derrière les États-Unis et la Chine. L’Union européenne est régie par le traité de Maastricht (TUE) et le traité de Rome (TFUE), dans leur version actuelle, depuis le 1er décembre 2009 et l\'entrée en vigueur du traité de Lisbonne. Sa structure institutionnelle est en partie supranationale et en partie intergouvernementale : le Parlement européen est élu au suffrage universel direct, tandis que le Conseil européen et le Conseil de l\'Union européenne (informellement le « Conseil » ou « Conseil des ministres ») sont composés de représentants des États membres. Le président de la Commission européenne est pour sa part élu par le Parlement sur proposition du Conseil européen. La Cour de justice de l\'Union européenne est chargée de veiller à l\'application du droit de l\'Union européenne.\r\nÉvolution territoriale de l\'Union européenne.\r\n', '29/05/2024', 'Google la ville', '12h'),
(3, 2, 'documents/fond/fond3.jpg', 'Event est un mot anglais qui signifie événement. Utilisé, en français dans le domaine de l\'art, il prend un sens particulier et précis.\r\n\r\nL\'event, en art contemporain, désigne une œuvre qui se caractérise par le fait que c\'est le spectateur qui la constitue. L\'artiste ou le groupe d\'artistes dispose et utilise dans un lieu des objets, des peintures mais aussi des sons, des films que le spectateur va s\'approprier pour créer lui-même une œuvre.\r\n\r\nLe premier event, organisé par John Cage, eut lieu au Black Moutain College en 1952. Il y avait des peintures de Robert Rauschenberg, une danse de Merce Cunningham, des films, des projections de diapositives, des\r\n\r\ndisques, de la radio, des poésies et une composition de Cage Causerie Julliard. Le public se trouvait au centre de tout cela.\r\n\r\nSelon Robert Rauschenberg : ', '30/05/2024', 'Issy', '18h00'),
(4, 19, 'documents/fond/fond.jpg', 'ca va gris je deveinde od epodjap en eiv e de map epte mon c(ane niet sce uq ec(e ', '1/489/48', 'zda', 'dada'),
(222, 1, 'documents/fond/fond.jpg', '\r\nLa déclaration du 9 mai 1950 de Robert Schuman, alors ministre français des Affaires étrangères, est considérée comme le texte fondateur de la construction européenne. Sous l’impulsion de personnalités politiques surnommées les « pères de l\'Europe »7, comme Konrad Adenauer, Jean Monnet et Alcide De Gasperi, six États créent en 1951 la Communauté européenne du charbon et de l\'acier (CECA). Après l’échec d\'une Communauté européenne de défense en 1954, une Communauté économique européenne (CEE) est instaurée en 1957 par le traité de Rome. La coopération économique est approfondie par l’Acte unique européen en 1986. En 1992, le traité de Maastricht prend la suite de l’Acte unique et institue une union politique qui prend le nom d’Union européenne et qui prévoit la création d\'une union économique et monétaire dotée d’une monnaie unique, l’euro (€). Instituée en 1999, la zone euro compte vingt États en 2023. De nouvelles réformes institutionnelles sont introduites en 1997 et en 2001. À la suite de l’échec d’un projet de constitution européenne après le refus par référendum des peuples français et néerlandais, les institutions sont à nouveau réformées en 2009 par le traité de Lisbonne pour y intégrer certaines mesures prévues par ce projet de constitution, à l\'exclusion de ses éléments les plus fédéraux. ', '29/08/2024', 'new york', '16h');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

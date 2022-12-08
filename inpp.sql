-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 08:35 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inpp`
--

-- --------------------------------------------------------

--
-- Table structure for table `branche`
--

CREATE TABLE `branche` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branche`
--

INSERT INTO `branche` (`id`, `nom`) VALUES
(1, 'Technique'),
(2, 'Informatique'),
(3, 'Art');

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `type_compte` varchar(45) NOT NULL,
  `utilisateur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `compte`
--

INSERT INTO `compte` (`id`, `username`, `password`, `type_compte`, `utilisateur_id`) VALUES
(1, 'youri', '0000', 'candidat', 1),
(2, 'eliezer', '0000', 'candidat', 2),
(3, 'dan', '0000', 'candidat', 3),
(4, 'emma', '0000', 'finance', 4),
(5, 'nambe', '0000', 'admin', 5),
(6, '@Jemimah', '@Jemimah2022', 'finance', 6),
(7, '@junior', '@junior2022', 'finance', 7);

-- --------------------------------------------------------

--
-- Table structure for table `detail_formation`
--

CREATE TABLE `detail_formation` (
  `id` int(11) NOT NULL,
  `date_debut` varchar(45) DEFAULT NULL,
  `date_fin` varchar(45) DEFAULT NULL,
  `etat` varchar(11) DEFAULT 'ongoing',
  `formation_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_formation`
--

INSERT INTO `detail_formation` (`id`, `date_debut`, `date_fin`, `etat`, `formation_id`, `utilisateur_id`) VALUES
(1, NULL, NULL, 'ongoing', 2, 3),
(2, NULL, NULL, 'ongoing', 1, 2),
(3, NULL, NULL, 'ongoing', 3, 2),
(4, NULL, NULL, 'ongoing', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `nom_fichier` varchar(255) NOT NULL,
  `type` varchar(45) NOT NULL,
  `utilisateur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `nom_fichier`, `type`, `utilisateur_id`) VALUES
(1, 'fichier5dcf6a1dcb2d004910fca3c5017b5f41_ProgrammingSteps.png', 'lettre', 2),
(2, 'fichier5dcf6a1dcb2d004910fca3c5017b5f41_1200px-MVC-Process.svg.png', 'identite', 2),
(3, 'fichierfbfa67aef81be6cdf8db08693c87b808_OneFamily_(1).png', 'lettre', 3),
(4, 'fichierfbfa67aef81be6cdf8db08693c87b808_OneFamily_(1).jpg', 'identite', 3);

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

CREATE TABLE `formation` (
  `id` int(11) NOT NULL,
  `intitule` varchar(100) NOT NULL,
  `duree` varchar(45) NOT NULL,
  `tarif` float DEFAULT NULL,
  `branche_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `formation`
--

INSERT INTO `formation` (`id`, `intitule`, `duree`, `tarif`, `branche_id`) VALUES
(1, 'Electronique', '6 mois', 70, 1),
(2, 'Musique', '4 mois', 50, 3),
(3, 'MS Excel', '3 mois', 60, 2);

-- --------------------------------------------------------

--
-- Table structure for table `paiement`
--

CREATE TABLE `paiement` (
  `id` int(11) NOT NULL,
  `date` varchar(45) NOT NULL,
  `montant` varchar(45) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `formation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paiement`
--

INSERT INTO `paiement` (`id`, `date`, `montant`, `utilisateur_id`, `formation_id`) VALUES
(2, '28-11-2022', '50', 3, 2),
(3, '08-12-2022', '70', 2, 1),
(4, '08-12-2022', '60', 2, 3),
(5, '08-12-2022', '46', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom_complet` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `adresse` varchar(45) NOT NULL,
  `genre` varchar(8) DEFAULT NULL,
  `matricule` varchar(45) DEFAULT NULL,
  `type_candidat` varchar(45) DEFAULT NULL,
  `poste` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom_complet`, `email`, `phone`, `adresse`, `genre`, `matricule`, `type_candidat`, `poste`) VALUES
(1, 'KATOMB MUKAZ YOURI', '16kk112@esisalama.org', '+260772630674', 'Lubumbashi', 'Male', NULL, 'personel', NULL),
(2, 'BWANA WA BWANA ELIEZER', 'kazembe@gmail.com', '+260772630674', 'kansenshi', 'Male', NULL, 'eleve', NULL),
(3, 'Kyungu Daniel', 'kazembe@gmail.com', '+260 772630674', 'kansenshi', 'Male', NULL, 'personel', NULL),
(4, 'Emmauel Musongo', 'emma@gmail.com', '+260 777500200', 'Lubumbashi', 'male', '1234em22', NULL, 'Finance'),
(5, 'Bianca Nambe', 'nambe@gmail.com', '+260 971944299', 'Lubumbashi', 'female', '1234em20', NULL, 'admin'),
(6, 'Jemimah Kalonje', 'surmpy.engineering@yahoo.com', '+260 765 721 319', 'Lubumbashi', 'female', '22JK426', NULL, 'Financier'),
(7, 'Junior Kasenda', 'kazembe@gmail.com', '+260 971944299', 'kansenshi', 'male', '22JK133', NULL, 'Financier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branche`
--
ALTER TABLE `branche`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ufk_idx` (`utilisateur_id`);

--
-- Indexes for table `detail_formation`
--
ALTER TABLE `detail_formation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fmfk_idx` (`formation_id`),
  ADD KEY `ufkk_idx` (`utilisateur_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utfk_idx` (`utilisateur_id`);

--
-- Indexes for table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brchfk_idx` (`branche_id`);

--
-- Indexes for table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usrfk_idx` (`utilisateur_id`),
  ADD KEY `formation_fk` (`formation_id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branche`
--
ALTER TABLE `branche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_formation`
--
ALTER TABLE `detail_formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `ufk` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_formation`
--
ALTER TABLE `detail_formation`
  ADD CONSTRAINT `fmfk` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ufkk` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `utfk` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `brchfk` FOREIGN KEY (`branche_id`) REFERENCES `branche` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `formation_fk` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usrfk` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2022 at 06:49 PM
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
(5, 'nambe', '0000', 'admin', 5),
(7, '@junior', '@junior2022', 'finance', 7),
(10, '@bwana', '@bwana2022', 'candidat', 10);

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
(2, NULL, NULL, 'ongoing', 2, 10),
(3, NULL, NULL, 'finished', 1, 10);

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
(3, 'fichierfbfa67aef81be6cdf8db08693c87b808_OneFamily_(1).png', 'lettre', 3),
(4, 'fichierfbfa67aef81be6cdf8db08693c87b808_OneFamily_(1).jpg', 'identite', 3),
(7, 'fichier51502c9784d3e4807222fd42743c34f4_Canevas_à_suivre_pour_le_TFC_2022-1.pdf', 'lettre', 10),
(8, 'fichier51502c9784d3e4807222fd42743c34f4_profile.jpeg', 'identite', 10);

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
(3, 'MS Excel', '3 mois', 60, 2),
(4, 'Mecanique', '9 mois', 200, 1);

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
(3, '11-12-2022', '50', 10, 2),
(4, '11-12-2022', '70', 10, 1);

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
  `poste` varchar(45) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom_complet`, `email`, `phone`, `adresse`, `genre`, `matricule`, `type_candidat`, `poste`, `created_at`) VALUES
(3, 'Kyungu Daniel', 'kazembe@gmail.com', '+260 772630674', 'kansenshi', 'male', NULL, 'personel', NULL, NULL),
(5, 'Bianca Nambe', 'nambe@gmail.com', '+260 971944299', 'Lubumbashi', 'female', '1234em20', NULL, 'admin', NULL),
(7, 'Junior Kasenda', 'kazembe@gmail.com', '+260 971944299', 'kansenshi', 'male', '22JK133', NULL, 'Financier', NULL),
(10, 'BWANA WA BWANA ELIEZER', '16kk112@esisalama.org', '+260772630674', 'Lubumbashi', 'male', NULL, 'personel', NULL, '10-12-2022');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `detail_formation`
--
ALTER TABLE `detail_formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 16 jan. 2019 à 07:42
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `connexion`
--

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

DROP TABLE IF EXISTS `connexion`;
CREATE TABLE IF NOT EXISTS `connexion` (
  `mail` varchar(40) NOT NULL,
  `mdp` varchar(8) NOT NULL,
  `dernierdonsang` date DEFAULT NULL,
  `dernierdonplasma` date DEFAULT NULL,
  `dernierdonplaquette` date DEFAULT NULL,
  `donsang` date DEFAULT NULL,
  `donplasma` date DEFAULT NULL,
  `donplaquette` date DEFAULT NULL,
  UNIQUE KEY `adressemail` (`mail`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`mail`, `mdp`, `dernierdonsang`, `dernierdonplasma`, `dernierdonplaquette`, `donsang`, `donplasma`, `donplaquette`) VALUES
('efs@efs.fr', '1234', NULL, NULL, NULL, NULL, NULL, NULL),
('test@test.fr', '1234', '2018-12-01', NULL, NULL, '2019-01-13', '2019-01-14', '2019-01-12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

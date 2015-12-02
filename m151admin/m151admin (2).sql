-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 02 Décembre 2015 à 15:54
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `m151admin`
--

-- --------------------------------------------------------

--
-- Structure de la table `choix`
--

CREATE TABLE IF NOT EXISTS `choix` (
  `id_sports` int(11) NOT NULL,
  `id_utilisateurs` int(11) NOT NULL,
  `ordre_choix` int(11) NOT NULL,
  PRIMARY KEY (`id_sports`,`id_utilisateurs`),
  KEY `id_utilisateurs` (`id_utilisateurs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `choix`
--

INSERT INTO `choix` (`id_sports`, `id_utilisateurs`, `ordre_choix`) VALUES
(1, 10, 1),
(2, 10, 2);

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id_classes` int(11) NOT NULL AUTO_INCREMENT,
  `nom_classes` text NOT NULL,
  PRIMARY KEY (`id_classes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `classes`
--

INSERT INTO `classes` (`id_classes`, `nom_classes`) VALUES
(1, 'INP-4B'),
(2, 'IFA-P3B');

-- --------------------------------------------------------

--
-- Structure de la table `sports`
--

CREATE TABLE IF NOT EXISTS `sports` (
  `id_sports` int(11) NOT NULL AUTO_INCREMENT,
  `nom_sports` text NOT NULL,
  PRIMARY KEY (`id_sports`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `sports`
--

INSERT INTO `sports` (`id_sports`, `nom_sports`) VALUES
(1, 'Hockey sur glace'),
(2, 'Football'),
(3, 'Basketball'),
(4, 'Baseball'),
(5, 'Tennis'),
(6, 'Petanque'),
(7, 'Echecs'),
(8, 'Football americain');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateurs` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateurs` varchar(50) NOT NULL,
  `prenom_utilisateurs` varchar(50) NOT NULL,
  `date_de_naissance_utilisateurs` date NOT NULL,
  `description_utilisateurs` varchar(200) DEFAULT NULL,
  `email_utilisateurs` varchar(50) NOT NULL,
  `pseudo_utilisateurs` varchar(50) NOT NULL,
  `mot_de_passe_utilisateurs` varchar(50) NOT NULL,
  `statut_utilisateurs` tinyint(1) NOT NULL DEFAULT '0',
  `id_classes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateurs`),
  UNIQUE KEY `pseudo` (`pseudo_utilisateurs`),
  KEY `id_classes` (`id_classes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateurs`, `nom_utilisateurs`, `prenom_utilisateurs`, `date_de_naissance_utilisateurs`, `description_utilisateurs`, `email_utilisateurs`, `pseudo_utilisateurs`, `mot_de_passe_utilisateurs`, `statut_utilisateurs`, `id_classes`) VALUES
(10, 'Boccard', 'Nicolas  ', '1997-02-09', 'Je suis nicolas boccard', 'nico.boccard.cfpt@gmail.com', 'nico.boccard', '0ce3266d4eb71ad50f7a90aee6d21dcd', 1, NULL),
(14, 'bla', 'bla          ', '2010-07-29', 'bla', 'bla@bla.com', 'bla', '128ecf542a35ac5270a87dc740918404', 0, 2),
(19, 'test', 'test   ', '2006-07-27', 'test', 'test@gmail.com', 'test', '098f6bcd4621d373cade4e832627b4f6', 0, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `choix`
--
ALTER TABLE `choix`
  ADD CONSTRAINT `choix_ibfk_5` FOREIGN KEY (`id_utilisateurs`) REFERENCES `utilisateurs` (`id_utilisateurs`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `choix_ibfk_6` FOREIGN KEY (`id_sports`) REFERENCES `sports` (`id_sports`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`id_classes`) REFERENCES `classes` (`id_classes`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

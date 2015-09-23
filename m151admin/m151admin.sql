-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 23 Septembre 2015 à 12:55
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
  PRIMARY KEY (`id_utilisateurs`),
  UNIQUE KEY `pseudo` (`pseudo_utilisateurs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateurs`, `nom_utilisateurs`, `prenom_utilisateurs`, `date_de_naissance_utilisateurs`, `description_utilisateurs`, `email_utilisateurs`, `pseudo_utilisateurs`, `mot_de_passe_utilisateurs`) VALUES
(2, 'Boccard', 'Nicolas', '1997-02-09', 'Je suis informaticien', 'nico.boccard.cfpt@gmail.com', '8056f3bec438a368bdb31d8cc202bda2', 'super'),
(3, 'test', 'test', '2015-09-15', 'test', 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'test'),
(4, 'ewger', 'gwergew', '2015-09-07', 'erwgerw', 'test@gmail.com', 'da3afeb73b05f887a98f709568b15183', 'effew'),
(5, 'gg', 'ggg', '2015-09-10', 'ggg', 'test@gmail.com', 'ba248c985ace94863880921d8900c53f', 'gggg'),
(6, 'kkkk', 'kkkk', '2015-09-03', 'kkkkk', 'test@gmail.com', 'cb42e130d1471239a27fca6228094f0e', 'kkkkk'),
(7, 'erwgew', 'ergjhrz', '2015-02-04', 'rtrj8z', 'test@gmail.com', '050c2a6d9b7d25caefa36a990db0b640', 'ztjet');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

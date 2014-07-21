-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 22 Juillet 2014 à 01:14
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `memberspace`
--

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  PRIMARY KEY (`id1`,`id2`),
  KEY `fk_friends_user_idx` (`id1`),
  KEY `fk_friends_user1_idx` (`id2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `friends`
--

INSERT INTO `friends` (`id1`, `id2`) VALUES
(1, 2),
(2, 5),
(4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `gender` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `firstname` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `job` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `registerdate` datetime DEFAULT NULL,
  `avatar` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`email`, `gender`, `firstname`, `lastname`, `password`, `job`, `registerdate`, `avatar`, `id`) VALUES
('jean.yvest@laposte.net', 'homme', 'Jean', 'Yvest', '9c51ad8660eaae45f7965cd83d1f447cf6378547', 'WebDesigner', '2014-07-21 10:33:36', 'images/base_avatar.jpg', 1),
('marie.montant@orange.fr', 'homme', 'Marie', 'Montant', '1382244e1784be148fb78b24983c206ebc95928f', 'Enseignant', '2014-07-21 10:35:57', 'images/m1.jpg', 2),
('remi@lebig.re', 'homme', 'Rémi', 'Lebigre', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'WebDesigner', '2014-07-21 12:31:41', 'images/remi.jpg', 4),
('eric.mathous@gmail.com', 'homme', 'Eric', 'Mathous', '96f164ad4d9b2b0dacf8ebee2bb1eeb3aa69adf1', 'Consultant', '2014-07-21 20:19:12', 'images/base_avatar.jpg', 5),
('pierre@gmail.com', 'homme', 'Pierre', 'Minon', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Artisan', '2014-07-21 23:36:02', 'images/base_avatar.jpg', 11);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`id2`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`id1`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

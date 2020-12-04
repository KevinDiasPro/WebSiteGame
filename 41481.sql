-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 14 Décembre 2015 à 15:38
-- Version du serveur :  5.5.20-log
-- Version de PHP :  5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `41481`
--

-- --------------------------------------------------------




--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `jeu`
--

INSERT INTO `jeu` (`id`, `titre`, `description`, `image`) VALUES
(1, 'Sacred', 'Excellent jeu', 'images/sacred.jpg'),
(2, 'Sacred2', 'Action', 'images/sacred2.jpg'),
(3, 'Starcraft 2', 'Jeu de strategie', 'images/starcraft.jpg'),
(4, 'CounterStrike Source', 'FPS', 'images/cs_source.jpg'),
(5, 'CounterStrike Global Offensive', 'FPS ', 'images/go.jpg'),
(6, 'CounterStrike 1.6', 'Excellent', 'images/cs.jpg'),
(7, 'Battlefield3', 'FPS', 'images/bf3.jpg'),
(8, 'Battlefield4', 'FPS, suite de Battlefield 3', 'images/battlefield.png'),
(9, 'Thief', 'Jeu PS3\r\nArcade', 'images/thief.jpg'),
(10, 'GTA5', 'Open-world', 'images/gta.jpg'),
(11, 'Skyrim', 'Dans ce jeu extrêmement réaliste, vous incarnez le dovahkin, le fils de dragon.  Vous pouvez choisir entre huit races au début du jeu; Argonien, Bréton, Elfe des bois, Elfe noirs, haut elfe, Khajiit, Nordique, Orc et Rougegarde.  ', 'images/skyrim.jpg'),
(12, 'Final Fantasy 7', ' jeu vidéo de rôle', 'images/ff.jpg'),
(13, 'Starcraft 2', 'Jeu de strategie', 'images/starcraft.jpg'),
(14, 'Assassin''s Creed 3 ', 'jeu vidéo d''action-aventure et d''infiltration développé par Ubisoft Montréal', 'images/assassin.jpg'),
(15, 'Far cry 3', ' jeu vidéo de tir en vue subjective se déroulant dans un monde ouvert ', 'images/farcry.jpg'),
(16, 'Infamous: second son ', 'jeu vidéo d''action-aventure en monde ouvert développé par Sucker Punch Productions', 'images/infamous.jpg'),
(17, 'Fifa 14', 'Jeu sport', 'images/fifa.jpg'),
(18, 'Crash Bandicoot 3', 'Crash Bandicoot 3: Warped est un jeu vidéo de plates-formes développé par Naughty Dog et édité par Sony Computer Entertainment en 1998 sur PlayStation.', 'images/crash.png'),
(19, 'Diablo 3', 'Diablo III est un jeu vidéo de type hack''n slash développé par Blizzard Entertainment. Il constitue le troisième opus de la série, succédant à Diablo et à Diablo II. ', 'images/diablo3.jpeg');

-- --------------------------------------------------------


--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` int(11) NOT NULL,
  `id_jeu` int(11) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
   PRIMARY KEY(`id_commentaires`),
  FOREIGN KEY(`id_jeu`)REFERENCES jeu(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `id_jeu`, `commentaire`, `pseudo`, `date`) VALUES
(1, 1, 'bien', 'hello', ''),
(2, 2, 'gtrezg', 'rrrr', ''),
(3, 3, 'Alfred', 'Alfred', ''),
(4, 1, 'Brillianty', 'Nul ce jeu', ''),
(5, 4, 'Hasbeen', 'Bof', ''),
(6, 4, 'Excellent', 'LAfred', ''),
(7, 5, 'Excellent', 'Jack', ''),
(8, 6, 'A jouer', 'Genezo', ''),
(9, 6, 'Un Must have', 'Wilou', ''),
(10, 6, 'Excellent', 'Mluffy', ''),
(11, 7, 'Bof', 'KIKOOLOLDU28', ''),
(12, 7, 'Excellent', 'Emelyne', ''),
(13, 8, 'Bof', 'Jackie', ''),
(14, 10, 'Excellent', 'Michel', ''),
(15, 11, 'Pas apprecié', 'Racaille', ''),
(16, 5, 'WESH IL EST KRO BIEN', 'JAIMEPASLESESPACES', ''),
(17, 12, 'Excellent', 'Fredo', ''),
(18, 13, 'Bof', 'Fred', ''),
(19, 14, 'Excellent', 'Willy', ''),
(20, 14, 'Moyen', 'Tupac', ''),
(21, 15, 'Bien', 'Mr.Bean', ''),
(22, 16, 'Excellent', 'Has', ''),
(23, 18, 'Bof', 'Bernard', ''),
(24, 18, 'Bof', 'Bernard', ''),
(25, 19, 'Sans plus', 'Bernard', ''),
(26, 19, 'Marrant', 'Hilla', '');

-----------------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id_note` int(11) NOT NULL,
  `id_jeu` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  PRIMARY KEY(`id_note`),
  FOREIGN KEY(`id_jeu`)REFERENCES jeu(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `notes`
--

INSERT INTO `notes` (`id_note`, `id_jeu`, `note`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 1, 5),
(4, 1, 6),
(5, 2, 5),
(6, 3, 5),
(7, 5, 10),
(8, 6, 8),
(9, 6, 7),
(10, 8, 8),
(11, 7, 9),
(12, 7, 6),
(13, 5, 9),
(14, 7, 6),
(15, 9, 7),
(16, 8, 10),
(17, 4, 6);

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

CREATE TABLE `prix` (
  `id_prix` int(11) NOT NULL,
  `id_jeu` int(11) NOT NULL,
  `prix` varchar(10) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `date` varchar(10) NOT NULL,
   PRIMARY KEY(`id_prix`),
   FOREIGN KEY(`id_jeu`)REFERENCES jeu(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `prix`
--

INSERT INTO `prix` (`id_prix`, `id_jeu`, `prix`, `pseudo`, `date`) VALUES
(1, 2, '10', 'coucou', ''),
(2, 4, '50', 'Hasbeen', ''),
(3, 5, '45', 'aze', ''),
(4, 5, '50', 'eza', '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `no` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `valide` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`no`, `login`, `mdp`, `valide`) VALUES
(1, 'hasbeen', 'd3f1b68b99932a70c35b5374edb176a0f29cae64', 1);


CREATE TABLE IF NOT EXISTS `userPwd` (
  `uId` int(11) NOT NULL,
  `uMdp` varchar(255) NOT NULL,
  PRIMARY KEY (`uId`),
  FOREIGN KEY (`uId`) REFERENCES user(`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `userPwd` (`uId`,`uMdp`) VALUES
(1,'d3f1b68b99932a70c35b5374edb176a0f29cae64');






--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `prix`
--
ALTER TABLE `prix`
  MODIFY `id_prix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

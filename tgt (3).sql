-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 25 fév. 2020 à 15:52
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tgt`
--

-- --------------------------------------------------------

--
-- Structure de la table `appreciation`
--

DROP TABLE IF EXISTS `appreciation`;
CREATE TABLE IF NOT EXISTS `appreciation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `dislike` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5CD4DEABA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `appreciation`
--

INSERT INTO `appreciation` (`id`, `user_id`, `dislike`, `likes`) VALUES
(1, NULL, 1, -2);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `texte` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F91ABF0A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nomc`) VALUES
(1, 'Cat');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `panier_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6EEAA67DF77D927C` (`panier_id`),
  KEY `IDX_6EEAA67DA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `user_id`, `panier_id`, `date`, `etat`) VALUES
(1, 1, 1, '2015-01-01', 'ec');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dateC` datetime NOT NULL,
  `publication_id` int(11) DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67F068BC38B217A7` (`publication_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `texte`, `dateC`, `publication_id`, `author`) VALUES
(1, 'Waouh magifique', '2020-02-20 07:32:19', 7, '');

-- --------------------------------------------------------

--
-- Structure de la table `discussion`
--

DROP TABLE IF EXISTS `discussion`;
CREATE TABLE IF NOT EXISTS `discussion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `texte` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lienImg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C0B9F90F4B89032C` (`post_id`),
  KEY `IDX_C0B9F90FA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `discussion`
--

INSERT INTO `discussion` (`id`, `post_id`, `user_id`, `titre`, `texte`, `lienImg`) VALUES
(1, 1, NULL, 'dede', 'dede', 'dede'),
(2, 1, 1, 'dede1', 'dede22', 'dede15');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `Duree` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MaxParticipants` int(11) NOT NULL,
  `Date_d` date NOT NULL,
  `Date_f` date NOT NULL,
  `Gagnant` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Etat` int(11) NOT NULL,
  `Nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B26681E98260155` (`region_id`),
  KEY `IDX_B26681EA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id`, `region_id`, `user_id`, `Duree`, `MaxParticipants`, `Date_d`, `Date_f`, `Gagnant`, `Etat`, `Nom`) VALUES
(1, 1, 1, '12', 12, '2015-01-01', '2015-01-01', 'hahhah', 1, ''),
(9, 3, 1, '4', 44, '2015-01-01', '2015-01-01', 'amin', 3, '');

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `region_origine` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jury` tinyint(1) NOT NULL DEFAULT '0',
  `participant` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `region_origine`, `jury`, `participant`) VALUES
(1, 'achraf', 'achraf', 'achrafchourabi@esprit.tn', 'achrafchourabi@esprit.tn', 1, NULL, '$2y$13$eZEmkOkdljL7Yk7DcwO9tu8lbw.BVXXuEgpAZGLj127rOy.IRBNdK', '2020-02-19 11:58:58', NULL, NULL, 'a:0:{}', 'Tunis', 1, 0),
(2, 'gth', 'gth', 'hadrien11@gmail.com', 'hadrien11@gmail.com', 1, NULL, '$2y$13$fnvw6E2/GdelD8qHO6.pbuB3p0MGPvjQHG32IWJxJsaU4skUQFLma', '2020-02-25 12:56:54', NULL, NULL, 'a:0:{}', '', 0, 1),
(3, 'ben', 'ben', 'ben@gmail.com', 'ben@gmail.com', 1, NULL, '$2y$13$D3sGgppITEEBNL1XtoM6NecOuX8m9SMs6Sj8rdGgQ7EiZbyl5HcDG', '2020-02-19 13:59:35', NULL, NULL, 'a:0:{}', 'Sousse', 1, 0),
(4, 'ztf', 'ztf', 'ztfqxjiu@hi2.in', 'ztfqxjiu@hi2.in', 1, NULL, '$2y$13$kCaKjv4ofvmij5ElAWL2MeshciGV8pZu7i7zARQERRvWhW3Q02Gb2', NULL, 'vsGROb30anaNq75BmIEoCg6ThrotARjHH5wYTIx3o5k', NULL, 'a:0:{}', 'Tunis', 1, 0),
(5, 'admin', 'admin', 'gthadrien111@gmail.com', 'gthadrien111@gmail.com', 1, NULL, '$2y$13$fnvw6E2/GdelD8qHO6.pbuB3p0MGPvjQHG32IWJxJsaU4skUQFLma', '2020-02-19 15:55:39', '6wejVhuo06zn--6xWKDa5Wkk4PnYFkImop7qtx58WS0', NULL, 'a:0:{}', '', 0, 1),
(6, 'gth1', 'gth1', 'ben1@gmail.com', 'ben1@gmail.com', 1, NULL, '$2y$13$wI46zkMl5W3637xxSBJm5.Jy0Ax5QxXOIYDvpjk9dr/24oVDm.NAK', '2020-02-20 10:54:59', NULL, NULL, 'a:0:{}', '', 0, 1),
(8, 'gthAdmin', 'gthadmin', 'admin@admin.com', 'admin@admin.com', 1, NULL, '$2y$13$WHZw2P2a9tQcKRhajaPFJO6IE8oXI2ZXlLKJHH/U4/nX/qYPyvVWm', '2020-02-25 15:33:07', NULL, NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 'Gabes', 0, 0),
(9, 'benSirac', 'bensirac', 'gthgth@gth.com', 'gthgth@gth.com', 1, NULL, '$2y$13$.oljc53XQCPhIR1LmOsEku7sJzxGVrpRiKJaJKZhw9YYbiZxewWau', '2020-02-25 00:03:46', NULL, NULL, 'a:0:{}', 'Sfax', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_24CC0DF2F347EFB` (`produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `produit_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `lienFich` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5A8A6C8DA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `user_id`, `titre`, `date`, `lienFich`) VALUES
(1, NULL, 'ee', '2015-01-01 00:00:00', 'dde'),
(2, 1, 'ee', '2015-01-01 00:00:00', 'dde');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qte` int(11) NOT NULL,
  `prix` double NOT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC27E6ADA943` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `cat_id`, `nom`, `qte`, `prix`, `etat`, `size`) VALUES
(1, NULL, 'accggg', 3, 123, 'dispo', 'm');

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `categorie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `autheur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '0',
  `Nb_Vote` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`id`, `titre`, `categorie`, `description`, `updated_at`, `video`, `autheur`, `valide`, `Nb_Vote`) VALUES
(3, 'me', 'Chant', 'heum', '2020-02-19 22:31:07', 'C:\\wamp64\\www\\TGTOf/public/uploads/videos/publication\\original-turkish-man-yelling-meow-at-an-egg.mp4', '', 0, 0),
(4, 'gloire', 'Chant', 'aDieu', '2020-02-19 22:33:42', 'C:\\wamp64\\www\\TGTOf/public/uploads/videos/publication\\test.mp4', '', 0, 0),
(5, 'test2', 'Illusion', 'Le fameux', '2020-02-20 00:29:17', 'C:\\wamp64\\www\\TGTOf/public/uploads/videos/publication\\test.mp4', '', 1, 1),
(6, 'dzd', 'Illusion', 'dz', '2020-02-20 01:03:56', 'C:\\wamp64\\www\\TGTOf/public/uploads/videos/publication\\test.mp4', '', 0, 0),
(7, 'test3', 'Magie', 'ayioi', '2020-02-20 01:21:26', 'C:\\wamp64\\www\\TGTOf/public/uploads/videos/publication\\test.mp4', 'admin', 1, 1),
(8, 'testValide', 'Illusion', 'sd', '2020-02-20 01:33:45', 'C:\\wamp64\\www\\TGTOf/public/uploads/videos/publication\\test.mp4', 'admin', 1, 0),
(9, 'jour', 'Illusion', 'jour-j', '2020-02-20 08:26:45', 'C:\\wamp64\\www\\TGTOf/public/uploads/videos/publication\\test.mp4', 'gth', 1, 0),
(10, 'test2', 'Chant', 'sdsd', '2020-02-20 10:57:58', 'C:\\wamp64\\www\\TGTOf/public/uploads/videos/publication\\test.mp4', 'gth1', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `Nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Nb_villes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F62F17671F7E88B` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `region`
--

INSERT INTO `region` (`id`, `event_id`, `Nom`, `Nb_villes`) VALUES
(1, NULL, 'Gabes', 12),
(2, 1, 'Tunis', 12),
(3, NULL, 'Sfax', 250),
(4, NULL, 'Sousse', 2);

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE IF NOT EXISTS `vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`id`, `user_id`, `publication_id`) VALUES
(1, 8, 5),
(2, 2, 7);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appreciation`
--
ALTER TABLE `appreciation`
  ADD CONSTRAINT `FK_5CD4DEABA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_6EEAA67DF77D927C` FOREIGN KEY (`panier_id`) REFERENCES `panier` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC38B217A7` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`);

--
-- Contraintes pour la table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `FK_C0B9F90F4B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_C0B9F90FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `FK_B26681E98260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`),
  ADD CONSTRAINT `FK_B26681EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `FK_24CC0DF2F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_5A8A6C8DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC27E6ADA943` FOREIGN KEY (`cat_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `FK_F62F17671F7E88B` FOREIGN KEY (`event_id`) REFERENCES `evenement` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

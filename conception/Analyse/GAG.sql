-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 17 Février 2018 à 15:59
-- Version du serveur :  5.5.57-0+deb8u1
-- Version de PHP :  7.0.27-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `GAG`
--

-- --------------------------------------------------------

--
-- Structure de la table `Artiste`
--

CREATE TABLE IF NOT EXISTS `Artiste` (
`idArtiste` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptifFR` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Artiste`
--

INSERT INTO `Artiste` (`idArtiste`, `nom`, `prenom`, `tel`, `image`, `descriptifFR`, `email`) VALUES
(1, 'samantha', 'fox', '0512151515', 'artiste1.jpg', NULL, 'test@gmail.com'),
(2, 'Bibf', 'Ataf', '4644565465', 'artiste2.png', NULL, 'fdsfqd@fsdfd.com'),
(3, 'durand', 'charlotte', '0549000000', 'artiste3.jpg', 'youpla', 'moi@moi.fr'),
(43, 'bidi', 'ba', '0512144523', 'artiste43.png', 'bidibabidibou', 'fff@dsds.com'),
(63, '', '', '', '', '', ''),
(64, '', '', '', '', '', ''),
(65, 'Sans nom', 'dsfdsf', '4545454545', '', 'fsdfsdfsd', '5fgdg@sdfgdg.com'),
(67, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `ArtisteExpose`
--

CREATE TABLE IF NOT EXISTS `ArtisteExpose` (
  `idArtiste` int(11) NOT NULL,
  `idExpo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ArtisteExpose`
--

INSERT INTO `ArtisteExpose` (`idArtiste`, `idExpo`) VALUES
(1, 1),
(2, 1),
(3, 1),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Collectif`
--

CREATE TABLE IF NOT EXISTS `Collectif` (
`idCollectif` int(11) NOT NULL,
  `libelleCollectif` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptifFR` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Collectif`
--

INSERT INTO `Collectif` (`idCollectif`, `libelleCollectif`, `descriptifFR`, `email`, `tel`) VALUES
(1, 'bamako', 'test', 'test', '0515151515'),
(2, 'Peintre du dimanche', 'blabla', '', '0102000000'),
(47, 'Terrible', 'le plus terrible des collectifs', '', '4545454545'),
(48, 'fd', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `CollectifExpose`
--

CREATE TABLE IF NOT EXISTS `CollectifExpose` (
  `idCollectif` int(11) NOT NULL,
  `idExpo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `CollectifExpose`
--

INSERT INTO `CollectifExpose` (`idCollectif`, `idExpo`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Communaute`
--

CREATE TABLE IF NOT EXISTS `Communaute` (
  `idArtiste` int(11) NOT NULL,
  `idCollectif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Communaute`
--

INSERT INTO `Communaute` (`idArtiste`, `idCollectif`) VALUES
(1, 1),
(2, 1),
(3, 1),
(2, 2),
(2, 47);

-- --------------------------------------------------------

--
-- Structure de la table `Donnee_enrichie`
--

CREATE TABLE IF NOT EXISTS `Donnee_enrichie` (
`idDonneeEnrichie` int(11) NOT NULL,
  `urlFichier` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `libelleDonneeEnrichie` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idTypeDonneEnrichie` int(11) DEFAULT NULL,
  `idOeuvre` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Donnee_enrichie`
--

INSERT INTO `Donnee_enrichie` (`idDonneeEnrichie`, `urlFichier`, `libelleDonneeEnrichie`, `idTypeDonneEnrichie`, `idOeuvre`) VALUES
(2, 'seve.mp3', 'La sève qui fait glouglou', 2, 5),
(3, 'dodo.mpeg', 'la joconde qui fait dodo', 1, 5),
(4, 'test.jpg', 'test', 3, 3),
(6, 'dsdsd.jpg', 'dsdsd', 3, 3),
(10, 'qsd.png', 'qsd', 3, 2),
(12, 'test2.jpg', 'test2', 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Emplacement`
--

CREATE TABLE IF NOT EXISTS `Emplacement` (
`idEmplacement` int(11) NOT NULL,
  `coordLeft` float DEFAULT NULL,
  `coordTop` float DEFAULT NULL,
  `idExpo` int(11) DEFAULT NULL,
  `idOeuvreExposee` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Emplacement`
--

INSERT INTO `Emplacement` (`idEmplacement`, `coordLeft`, `coordTop`, `idExpo`, `idOeuvreExposee`) VALUES
(1, -378.544, 0, 1, 0),
(4, 71.0586, 11.7484, 1, 31),
(8, 12.5805, 56.1873, 1, 0),
(16, 36.5703, 17.8284, 1, 22),
(198, 51.6077, 28.8991, 1, 38),
(199, 50, 50, 76, 0),
(200, 50, 50, 4, 0),
(201, 50, 50, 8, 0),
(203, 50, 50, 1, 0),
(204, 50, 50, 6, 0),
(209, 50, 50, 7, 0),
(234, 36.4967, 15.6463, 2, 53),
(236, 50, 50, 2, 0),
(271, 50, 50, 124, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Exposition`
--

CREATE TABLE IF NOT EXISTS `Exposition` (
`idExpo` int(11) NOT NULL,
  `titre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `horaireO` time DEFAULT NULL,
  `horaireF` time DEFAULT NULL,
  `theme` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptifFR` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `frequentation` int(11) DEFAULT NULL,
  `dateDeb` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `teaser` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `affiche` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `couleurExpo` varchar(7) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Exposition`
--

INSERT INTO `Exposition` (`idExpo`, `titre`, `horaireO`, `horaireF`, `theme`, `descriptifFR`, `frequentation`, `dateDeb`, `dateFin`, `teaser`, `affiche`, `couleurExpo`) VALUES
(1, 'test', '00:00:10', '00:00:17', 't''est', 'test', NULL, '2018-02-15', '2018-02-22', NULL, NULL, '#18dbf2'),
(2, 'bada boum', '10:00:00', '18:30:00', 'trololo', 'badabim boum bouml badaboum help', NULL, '2018-01-30', '2018-02-06', 'teaser.jpg', 'affiche.png', '#8f33ec'),
(3, 'Chiquito Merdo', '00:00:00', '00:00:00', '', '', NULL, '2018-03-03', '2018-03-15', NULL, NULL, '#219570'),
(4, 'Hé vous là', NULL, NULL, NULL, NULL, NULL, '2018-01-03', '2018-01-06', NULL, NULL, '#2FC8EF'),
(5, 'Fatigué', NULL, NULL, NULL, NULL, NULL, '2017-12-24', '2018-01-01', NULL, NULL, '#DB1781'),
(6, 'Flic floc', NULL, NULL, NULL, NULL, NULL, '2018-01-08', '2018-01-10', NULL, NULL, '#1AE540'),
(7, 'crackboum u', '00:00:00', '00:00:00', '', '', NULL, '2018-03-18', '2018-03-25', NULL, NULL, '#ea064b'),
(8, 'Aspartam', NULL, NULL, NULL, NULL, NULL, '2018-01-12', '2018-01-15', NULL, NULL, '#C34132'),
(76, 'god zilla', '00:00:00', '00:00:00', '', '', NULL, '2018-01-18', '2018-01-26', 'teaser.jpg', 'affiche.png', '#d9e41c'),
(124, 'Pandas', '00:00:00', '00:00:00', 'Bebetes', 'maxi panda', NULL, '2018-02-08', '2018-02-09', 'teaser.jpg', 'affiche.jpg', '#499346');

-- --------------------------------------------------------

--
-- Structure de la table `Langue`
--

CREATE TABLE IF NOT EXISTS `Langue` (
`idLangue` int(11) NOT NULL,
  `nomLangue` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Langue`
--

INSERT INTO `Langue` (`idLangue`, `nomLangue`) VALUES
(1, 'Français'),
(2, 'Anglais'),
(3, 'Russe'),
(4, 'Allemand'),
(5, 'Chinois');

-- --------------------------------------------------------

--
-- Structure de la table `Langue_expo`
--

CREATE TABLE IF NOT EXISTS `Langue_expo` (
  `idExpo` int(11) NOT NULL,
  `idLangue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Langue_expo`
--

INSERT INTO `Langue_expo` (`idExpo`, `idLangue`) VALUES
(2, 1),
(2, 2),
(2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `Message_interne`
--

CREATE TABLE IF NOT EXISTS `Message_interne` (
`idMessage` int(11) NOT NULL,
  `dateMessage` date NOT NULL,
  `message` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `idUtilisateur` int(11) DEFAULT NULL,
  `idOeuvre` int(11) DEFAULT NULL,
  `idArtiste` int(11) DEFAULT NULL,
  `idExpo` int(11) DEFAULT NULL,
  `idCollectif` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Message_interne`
--

INSERT INTO `Message_interne` (`idMessage`, `dateMessage`, `message`, `idUtilisateur`, `idOeuvre`, `idArtiste`, `idExpo`, `idCollectif`) VALUES
(2, '2018-01-07', 'dsfgsdfgsdgfg', 1, 3, NULL, NULL, NULL),
(4, '2018-01-02', 'sdgsdfgsdfgsdfgsdfgsdfgsdfds', 1, NULL, NULL, 1, NULL),
(5, '2018-01-05', 'Oeuvre en cours d''acheminement. arrivera surement en cours de semaine prochaine le 08 ou 09 par ciblex', 1, 5, NULL, NULL, NULL),
(6, '2018-01-09', 'bbbbbbbbbb bbbbbbbbbb bbbbbbbbbbbbbbbb bbbbbbbbbbbbbbbb', 1, 3, NULL, NULL, NULL),
(7, '2018-01-08', 'ba si c''est pas beau ça', 2, 5, NULL, NULL, NULL),
(20, '2018-01-12', 'test nombre de message', 1, 5, NULL, NULL, NULL),
(21, '2018-01-12', 'c''est cool ca marche', 1, 5, NULL, NULL, NULL),
(22, '2018-01-12', 'on va tester si ca se vide', 1, 5, NULL, NULL, NULL),
(26, '2018-01-12', 'avec val() ?', 1, 5, NULL, NULL, NULL),
(27, '2018-01-12', 'ah oui ca fonctionne', 1, 5, NULL, NULL, NULL),
(28, '2018-01-15', 'test du pingouin reussi', 1, 3, NULL, NULL, NULL),
(37, '2018-01-19', 'rest', 1, 47, NULL, NULL, NULL),
(39, '2018-01-19', 'rest', 1, NULL, 3, NULL, NULL),
(40, '2018-01-25', 'test2', 2, NULL, 2, NULL, NULL),
(54, '2018-01-30', 'dsqdqsd', 1, NULL, 44, NULL, NULL),
(55, '2018-01-30', 'dqsd', 1, 3, NULL, NULL, NULL),
(56, '2018-01-30', 'vbnvbn', 1, 29, NULL, NULL, NULL),
(57, '2018-01-30', 'qsdsqdsqfsdaaaaaaaaaaaa', 1, 30, NULL, NULL, NULL),
(58, '2018-01-30', 'cxcwxcw', 1, 2, NULL, NULL, NULL),
(82, '2018-02-07', 'sdsd', 1, 2, NULL, NULL, NULL),
(86, '2018-02-07', 'df', 1, 2, NULL, NULL, NULL),
(98, '2018-02-07', 'jghj', 1, NULL, 2, NULL, NULL),
(109, '2018-02-07', ' cv c', 1, NULL, NULL, NULL, 47),
(110, '2018-02-11', 'dqsd', 1, NULL, NULL, NULL, 2),
(117, '2018-02-16', 'hello sam', 1, NULL, 1, NULL, NULL),
(119, '2018-02-16', 'csvwxv', 1, NULL, NULL, NULL, 47),
(120, '2018-02-16', 'hello cocotte', 1, 2, NULL, NULL, NULL),
(121, '2018-02-16', 'cocotte hello', 1, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Oeuvre`
--

CREATE TABLE IF NOT EXISTS `Oeuvre` (
`idOeuvre` int(11) NOT NULL,
  `titre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longueur` decimal(7,2) DEFAULT NULL,
  `hauteur` decimal(7,2) DEFAULT NULL,
  `etat` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qrcode` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptifFR` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idTypeOeuvre` int(11) DEFAULT NULL,
  `idArtiste` int(11) DEFAULT NULL,
  `idCollectif` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Oeuvre`
--

INSERT INTO `Oeuvre` (`idOeuvre`, `titre`, `longueur`, `hauteur`, `etat`, `image`, `qrcode`, `descriptifFR`, `idTypeOeuvre`, `idArtiste`, `idCollectif`) VALUES
(1, 'Bamako en feu', '100.00', '5.00', 'bon etat', 'oeuvre2.jpg', 'oeuvre2.png', 'teste', 1, 1, 1),
(2, 'Cocottes', '150.00', '100.00', 'bon', 'oeuvre1.jpg', 'oeuvre1.png', 'cocotte genial cocotte genialcocotte genialcocotte genialcocotte genialcocotte genialcocotte genialcocotte genialcocotte genialcocotte genialcocotte genialcocotte geniale', 2, 2, 1),
(3, 'Rouquine coquine', '132.00', '125.00', 'tres bon', 'oeuvre3.jpg', 'oeuvre3.png', 'tres belle oeuvre de maximilien maxime maximus decimus meridius qui aimait beaucoup les ptite rouquine coquine', 2, 2, NULL),
(4, 'tete de noeud', NULL, NULL, NULL, 'oeuvre4.jpg', 'oeuvre4.png', 'tete de noeud', 1, 1, NULL),
(5, 'Jocondas', '100.00', '100.00', 'moyen', 'oeuvre5.jpg', 'oeuvre5.png', 'joconde lego, Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam magni, optio. Fugiat corporis mollitia vitae qui sapiente accusantium facilis facere, a quas. Id voluptatibus accusantium necessitatibus fugiat quod rerum veniam aliquid natus iure inventore, itaque ipsum totam aspernatur quam quos accusamus, suscipit in? Nostrum commodi neque quis expedita facilis vel hic corporis amet, quo quidem dolorem optio! Optio, earum impedit cum animi', 1, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `OeuvreExposee`
--

CREATE TABLE IF NOT EXISTS `OeuvreExposee` (
`idOeuvreExposee` int(11) NOT NULL,
  `dateEntree` date DEFAULT '0000-00-00',
  `dateSortie` date DEFAULT '0000-00-00',
  `nbClic` int(11) DEFAULT '0',
  `nbFlash` int(11) DEFAULT '0',
  `idOeuvre` int(11) NOT NULL,
  `idExpo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `OeuvreExposee`
--

INSERT INTO `OeuvreExposee` (`idOeuvreExposee`, `dateEntree`, `dateSortie`, `nbClic`, `nbFlash`, `idOeuvre`, `idExpo`) VALUES
(22, '2018-01-04', '0000-00-00', 0, 0, 2, 1),
(31, '2018-01-18', '0000-00-00', 0, 0, 3, 1),
(32, '0000-00-00', '0000-00-00', 0, 0, 4, 1),
(38, '2018-01-06', '0000-00-00', 0, 0, 1, 1),
(53, '2018-01-21', '0000-00-00', 0, 0, 5, 2),
(54, '2018-01-29', '0000-00-00', 0, 0, 5, 1),
(56, '0000-00-00', '0000-00-00', 0, 0, 3, 2),
(82, '0000-00-00', '0000-00-00', 0, 0, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Traduction`
--

CREATE TABLE IF NOT EXISTS `Traduction` (
`idTraduction` int(11) NOT NULL,
  `texteTraduit` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idArtiste` int(11) DEFAULT NULL,
  `idCollectif` int(11) DEFAULT NULL,
  `idOeuvre` int(11) DEFAULT NULL,
  `idExpo` int(11) DEFAULT NULL,
  `idLangue` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Traduction`
--

INSERT INTO `Traduction` (`idTraduction`, `texteTraduit`, `idArtiste`, `idCollectif`, `idOeuvre`, `idExpo`, `idLangue`) VALUES
(1, 'icb lliebedich', NULL, NULL, 2, NULL, 4);

-- --------------------------------------------------------

--
-- Structure de la table `Type_donnee_enrichie`
--

CREATE TABLE IF NOT EXISTS `Type_donnee_enrichie` (
`idTypeDonneEnrichie` int(11) NOT NULL,
  `libelleTypeDonneEnrichie` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Type_donnee_enrichie`
--

INSERT INTO `Type_donnee_enrichie` (`idTypeDonneEnrichie`, `libelleTypeDonneEnrichie`) VALUES
(1, 'Video'),
(2, 'Sonore'),
(3, 'Image');

-- --------------------------------------------------------

--
-- Structure de la table `Type_oeuvre`
--

CREATE TABLE IF NOT EXISTS `Type_oeuvre` (
`idTypeOeuvre` int(11) NOT NULL,
  `libelleTypeOeuvre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Type_oeuvre`
--

INSERT INTO `Type_oeuvre` (`idTypeOeuvre`, `libelleTypeOeuvre`) VALUES
(1, 'Croute'),
(2, 'Sculpture'),
(3, 'Tapisserie');

-- --------------------------------------------------------

--
-- Structure de la table `Type_utilisateur`
--

CREATE TABLE IF NOT EXISTS `Type_utilisateur` (
`idTypeUtilisateur` int(11) NOT NULL,
  `libelleTypeUtilisateur` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Type_utilisateur`
--

INSERT INTO `Type_utilisateur` (`idTypeUtilisateur`, `libelleTypeUtilisateur`) VALUES
(1, 'admin'),
(2, 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE IF NOT EXISTS `Utilisateur` (
`idUtilisateur` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mot_de_passe` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `identifiant` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idTypeUtilisateur` int(11) DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userState` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`idUtilisateur`, `nom`, `mot_de_passe`, `identifiant`, `prenom`, `idTypeUtilisateur`, `email`, `userState`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'admin', 1, 'f.boubee@gmail.com', 1),
(2, 'test', '6b4b1364d0ace71acb3c936074fb3d40f85a71ae', 'test', 'testing', 2, 'f.boubee@gmail.com', 1),
(12, 'nouveau', 'd4fd1b419e9f16b0e6b0b2ab51aa90fc0fc2f9d9', 'nouveau', 'nouveau', 2, 'f.boubee@gmail.com', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Visiteur`
--

CREATE TABLE IF NOT EXISTS `Visiteur` (
`idVisiteur` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idLangue` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Artiste`
--
ALTER TABLE `Artiste`
 ADD PRIMARY KEY (`idArtiste`);

--
-- Index pour la table `ArtisteExpose`
--
ALTER TABLE `ArtisteExpose`
 ADD PRIMARY KEY (`idArtiste`,`idExpo`), ADD UNIQUE KEY `cpl_unik1` (`idArtiste`,`idExpo`), ADD KEY `ArtisteExpose_ibfk_2` (`idExpo`);

--
-- Index pour la table `Collectif`
--
ALTER TABLE `Collectif`
 ADD PRIMARY KEY (`idCollectif`);

--
-- Index pour la table `CollectifExpose`
--
ALTER TABLE `CollectifExpose`
 ADD PRIMARY KEY (`idCollectif`,`idExpo`), ADD KEY `idExpo` (`idExpo`);

--
-- Index pour la table `Communaute`
--
ALTER TABLE `Communaute`
 ADD PRIMARY KEY (`idArtiste`,`idCollectif`), ADD KEY `FK_appartenir_idCollectif` (`idCollectif`);

--
-- Index pour la table `Donnee_enrichie`
--
ALTER TABLE `Donnee_enrichie`
 ADD PRIMARY KEY (`idDonneeEnrichie`), ADD KEY `FK_Donnee_enrichie_idTypeDonneEnrichie` (`idTypeDonneEnrichie`), ADD KEY `FK_Donnee_enrichie_idOeuvre` (`idOeuvre`);

--
-- Index pour la table `Emplacement`
--
ALTER TABLE `Emplacement`
 ADD PRIMARY KEY (`idEmplacement`), ADD KEY `idOeuvreExposee` (`idOeuvreExposee`), ADD KEY `FK_Emplacement_idExpo` (`idExpo`);

--
-- Index pour la table `Exposition`
--
ALTER TABLE `Exposition`
 ADD PRIMARY KEY (`idExpo`);

--
-- Index pour la table `Langue`
--
ALTER TABLE `Langue`
 ADD PRIMARY KEY (`idLangue`);

--
-- Index pour la table `Langue_expo`
--
ALTER TABLE `Langue_expo`
 ADD PRIMARY KEY (`idExpo`,`idLangue`), ADD KEY `FK_affecter_idLangue` (`idLangue`);

--
-- Index pour la table `Message_interne`
--
ALTER TABLE `Message_interne`
 ADD PRIMARY KEY (`idMessage`), ADD KEY `FK_Message_interne_idOeuvre` (`idOeuvre`), ADD KEY `FK_Message_interne_idArtiste` (`idArtiste`), ADD KEY `FK_Message_interne_idExpo` (`idExpo`), ADD KEY `FK_Message_interne_idCollectif` (`idCollectif`), ADD KEY `FK_Message_interne_idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `Oeuvre`
--
ALTER TABLE `Oeuvre`
 ADD PRIMARY KEY (`idOeuvre`), ADD KEY `FK_Oeuvre_idTypeOeuvre` (`idTypeOeuvre`), ADD KEY `FK_Oeuvre_idArtiste` (`idArtiste`), ADD KEY `FK_Oeuvre_idCollectif` (`idCollectif`);

--
-- Index pour la table `OeuvreExposee`
--
ALTER TABLE `OeuvreExposee`
 ADD PRIMARY KEY (`idOeuvreExposee`), ADD UNIQUE KEY `cpl_unik2` (`idOeuvre`,`idExpo`), ADD KEY `idEmplacement` (`idOeuvre`,`idExpo`), ADD KEY `idOeuvre` (`idOeuvre`), ADD KEY `idExpo` (`idExpo`);

--
-- Index pour la table `Traduction`
--
ALTER TABLE `Traduction`
 ADD PRIMARY KEY (`idTraduction`), ADD KEY `FK_Traduction_idArtiste` (`idArtiste`), ADD KEY `FK_Traduction_idCollectif` (`idCollectif`), ADD KEY `FK_Traduction_idOeuvre` (`idOeuvre`), ADD KEY `FK_Traduction_idExpo` (`idExpo`), ADD KEY `FK_Traduction_idLangue` (`idLangue`);

--
-- Index pour la table `Type_donnee_enrichie`
--
ALTER TABLE `Type_donnee_enrichie`
 ADD PRIMARY KEY (`idTypeDonneEnrichie`);

--
-- Index pour la table `Type_oeuvre`
--
ALTER TABLE `Type_oeuvre`
 ADD PRIMARY KEY (`idTypeOeuvre`);

--
-- Index pour la table `Type_utilisateur`
--
ALTER TABLE `Type_utilisateur`
 ADD PRIMARY KEY (`idTypeUtilisateur`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
 ADD PRIMARY KEY (`idUtilisateur`), ADD KEY `FK_Utilisateur_idTypeUtilisateur` (`idTypeUtilisateur`);

--
-- Index pour la table `Visiteur`
--
ALTER TABLE `Visiteur`
 ADD PRIMARY KEY (`idVisiteur`), ADD KEY `FK_Visiteur_idLangue` (`idLangue`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Artiste`
--
ALTER TABLE `Artiste`
MODIFY `idArtiste` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT pour la table `Collectif`
--
ALTER TABLE `Collectif`
MODIFY `idCollectif` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `Donnee_enrichie`
--
ALTER TABLE `Donnee_enrichie`
MODIFY `idDonneeEnrichie` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `Emplacement`
--
ALTER TABLE `Emplacement`
MODIFY `idEmplacement` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=272;
--
-- AUTO_INCREMENT pour la table `Exposition`
--
ALTER TABLE `Exposition`
MODIFY `idExpo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT pour la table `Langue`
--
ALTER TABLE `Langue`
MODIFY `idLangue` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `Message_interne`
--
ALTER TABLE `Message_interne`
MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT pour la table `Oeuvre`
--
ALTER TABLE `Oeuvre`
MODIFY `idOeuvre` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `OeuvreExposee`
--
ALTER TABLE `OeuvreExposee`
MODIFY `idOeuvreExposee` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT pour la table `Traduction`
--
ALTER TABLE `Traduction`
MODIFY `idTraduction` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `Type_donnee_enrichie`
--
ALTER TABLE `Type_donnee_enrichie`
MODIFY `idTypeDonneEnrichie` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `Type_oeuvre`
--
ALTER TABLE `Type_oeuvre`
MODIFY `idTypeOeuvre` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `Type_utilisateur`
--
ALTER TABLE `Type_utilisateur`
MODIFY `idTypeUtilisateur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `Visiteur`
--
ALTER TABLE `Visiteur`
MODIFY `idVisiteur` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ArtisteExpose`
--
ALTER TABLE `ArtisteExpose`
ADD CONSTRAINT `ArtisteExpose_ibfk_1` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ArtisteExpose_ibfk_2` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `CollectifExpose`
--
ALTER TABLE `CollectifExpose`
ADD CONSTRAINT `CollectifExpose_ibfk_1` FOREIGN KEY (`idCollectif`) REFERENCES `Collectif` (`idCollectif`),
ADD CONSTRAINT `CollectifExpose_ibfk_2` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`);

--
-- Contraintes pour la table `Communaute`
--
ALTER TABLE `Communaute`
ADD CONSTRAINT `FK_appartenir_idArtiste` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`),
ADD CONSTRAINT `FK_appartenir_idCollectif` FOREIGN KEY (`idCollectif`) REFERENCES `Collectif` (`idCollectif`);

--
-- Contraintes pour la table `Donnee_enrichie`
--
ALTER TABLE `Donnee_enrichie`
ADD CONSTRAINT `FK_Donnee_enrichie_idOeuvre` FOREIGN KEY (`idOeuvre`) REFERENCES `Oeuvre` (`idOeuvre`),
ADD CONSTRAINT `FK_Donnee_enrichie_idTypeDonneEnrichie` FOREIGN KEY (`idTypeDonneEnrichie`) REFERENCES `Type_donnee_enrichie` (`idTypeDonneEnrichie`);

--
-- Contraintes pour la table `Emplacement`
--
ALTER TABLE `Emplacement`
ADD CONSTRAINT `FK_Emplacement_idExpo` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Langue_expo`
--
ALTER TABLE `Langue_expo`
ADD CONSTRAINT `FK_affecter_idExpo` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_affecter_idLangue` FOREIGN KEY (`idLangue`) REFERENCES `Langue` (`idLangue`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Message_interne`
--
ALTER TABLE `Message_interne`
ADD CONSTRAINT `FK_Message_interne_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Oeuvre`
--
ALTER TABLE `Oeuvre`
ADD CONSTRAINT `FK_Oeuvre_idArtiste` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`),
ADD CONSTRAINT `FK_Oeuvre_idCollectif` FOREIGN KEY (`idCollectif`) REFERENCES `Collectif` (`idCollectif`),
ADD CONSTRAINT `FK_Oeuvre_idTypeOeuvre` FOREIGN KEY (`idTypeOeuvre`) REFERENCES `Type_oeuvre` (`idTypeOeuvre`);

--
-- Contraintes pour la table `OeuvreExposee`
--
ALTER TABLE `OeuvreExposee`
ADD CONSTRAINT `OeuvreExposee_ibfk_2` FOREIGN KEY (`idOeuvre`) REFERENCES `Oeuvre` (`idOeuvre`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `OeuvreExposee_ibfk_3` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Traduction`
--
ALTER TABLE `Traduction`
ADD CONSTRAINT `FK_Traduction_idArtiste` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`),
ADD CONSTRAINT `FK_Traduction_idCollectif` FOREIGN KEY (`idCollectif`) REFERENCES `Collectif` (`idCollectif`),
ADD CONSTRAINT `FK_Traduction_idExpo` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`),
ADD CONSTRAINT `FK_Traduction_idLangue` FOREIGN KEY (`idLangue`) REFERENCES `Langue` (`idLangue`),
ADD CONSTRAINT `FK_Traduction_idOeuvre` FOREIGN KEY (`idOeuvre`) REFERENCES `Oeuvre` (`idOeuvre`);

--
-- Contraintes pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
ADD CONSTRAINT `FK_Utilisateur_idTypeUtilisateur` FOREIGN KEY (`idTypeUtilisateur`) REFERENCES `Type_utilisateur` (`idTypeUtilisateur`);

--
-- Contraintes pour la table `Visiteur`
--
ALTER TABLE `Visiteur`
ADD CONSTRAINT `FK_Visiteur_idLangue` FOREIGN KEY (`idLangue`) REFERENCES `Langue` (`idLangue`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

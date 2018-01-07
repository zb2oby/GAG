-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 07 Janvier 2018 à 11:08
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
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descriptifFR` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Artiste`
--

INSERT INTO `Artiste` (`idArtiste`, `nom`, `prenom`, `tel`, `image`, `descriptifFR`, `email`) VALUES
(1, 'samantha', 'fox', '0512151515', 'artiste1.jpg', 'test', 'test@gmail.com'),
(2, 'mbala', 'mbala', NULL, 'artiste2.jpg', 'mbala', NULL),
(3, 'durand', 'charlotte', NULL, 'artiste3.jpg', NULL, NULL);

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
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Collectif`
--

CREATE TABLE IF NOT EXISTS `Collectif` (
`idCollectif` int(11) NOT NULL,
  `libelleCollectif` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptifFR` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Collectif`
--

INSERT INTO `Collectif` (`idCollectif`, `libelleCollectif`, `descriptifFR`, `email`, `tel`) VALUES
(1, 'test', 'test', 'test', '0515151515');

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
  `styleCollectif` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idArtiste` int(11) NOT NULL,
  `idCollectif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Emplacement`
--

CREATE TABLE IF NOT EXISTS `Emplacement` (
`idEmplacement` int(11) NOT NULL,
  `coordLeft` float DEFAULT NULL,
  `coordTop` float DEFAULT NULL,
  `idExpo` int(11) DEFAULT NULL,
  `idOeuvreExposee` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Emplacement`
--

INSERT INTO `Emplacement` (`idEmplacement`, `coordLeft`, `coordTop`, `idExpo`, `idOeuvreExposee`) VALUES
(1, 33.9184, 68.0577, 1, NULL),
(2, 3.03382, 38.6803, 1, NULL),
(3, 46.3251, 34.7228, 1, 38),
(4, 71.0586, 11.7484, 1, 31),
(7, 85.4671, 46.2569, 1, NULL),
(8, 12.5805, 56.1873, 1, NULL),
(10, 74.5964, 70.8672, 1, NULL),
(15, 39.4292, 20.4026, 2, 42),
(16, 36.5703, 17.8284, 1, 22);

-- --------------------------------------------------------

--
-- Structure de la table `Exposition`
--

CREATE TABLE IF NOT EXISTS `Exposition` (
`idExpo` int(11) NOT NULL,
  `titre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `horaireO` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horaireF` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `theme` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptifFR` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `frequentation` int(11) DEFAULT NULL,
  `dateDeb` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `teaser` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `affiche` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Exposition`
--

INSERT INTO `Exposition` (`idExpo`, `titre`, `horaireO`, `horaireF`, `theme`, `descriptifFR`, `frequentation`, `dateDeb`, `dateFin`, `teaser`, `affiche`) VALUES
(1, 'test', '10h00', '17h00', 't''est', 'test', NULL, '2017-12-15', '2017-12-28', 'test', 'test'),
(2, 'bada boum', '11h00', '20h00', 'badaboum', 'badabimboum bimbadaboum help', NULL, '2017-12-29', '2018-01-26', 'crackboum', 'bim');

-- --------------------------------------------------------

--
-- Structure de la table `Langue`
--

CREATE TABLE IF NOT EXISTS `Langue` (
`idLangue` int(11) NOT NULL,
  `nomLangue` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Langue_expo`
--

CREATE TABLE IF NOT EXISTS `Langue_expo` (
  `idExpo` int(11) NOT NULL,
  `idLangue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Oeuvre`
--

CREATE TABLE IF NOT EXISTS `Oeuvre` (
`idOeuvre` int(11) NOT NULL,
  `titre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
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
(1, 'bamako en feu', '100.00', '5.00', 'bon etat', 'oeuvre2.jpg', 'tb.qr', 'test', 1, 1, NULL),
(2, 'cocotte', '150.00', '100.00', 'bon', 'oeuvre1.jpg', 'cocote.qr', 'cocotte genial cocotte genialcocotte genialcocotte genialcocotte genialcocotte genialcocotte genialcocotte genialcocotte genialcocotte genialcocotte genialcocotte genial', 1, 2, NULL),
(3, 'vision deformée', NULL, NULL, NULL, 'oeuvre3.jpg', NULL, 'vision deformée', 1, 2, NULL),
(4, 'tete de noeud', NULL, NULL, NULL, 'oeuvre4.jpg', NULL, 'tete de noeud', 1, 1, NULL),
(5, 'joconda', '100.00', '100.00', 'moy', 'oeuvre5.jpg', NULL, 'joconde lego', 1, 3, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `OeuvreExposee`
--

INSERT INTO `OeuvreExposee` (`idOeuvreExposee`, `dateEntree`, `dateSortie`, `nbClic`, `nbFlash`, `idOeuvre`, `idExpo`) VALUES
(22, '2018-01-04', '0000-00-00', 0, 0, 2, 1),
(31, '2018-01-18', '0000-00-00', 0, 0, 3, 1),
(32, '0000-00-00', '0000-00-00', 0, 0, 4, 1),
(38, '2018-01-06', '0000-00-00', 0, 0, 1, 1),
(42, '2018-01-18', '0000-00-00', 0, 0, 5, 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Type_donnee_enrichie`
--

CREATE TABLE IF NOT EXISTS `Type_donnee_enrichie` (
`idTypeDonneEnrichie` int(11) NOT NULL,
  `libelleTypeDonneEnrichie` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Type_oeuvre`
--

CREATE TABLE IF NOT EXISTS `Type_oeuvre` (
`idTypeOeuvre` int(11) NOT NULL,
  `libelleTypeOeuvre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Type_oeuvre`
--

INSERT INTO `Type_oeuvre` (`idTypeOeuvre`, `libelleTypeOeuvre`) VALUES
(1, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `Type_utilisateur`
--

CREATE TABLE IF NOT EXISTS `Type_utilisateur` (
`idTypeUtilisateur` int(11) NOT NULL,
  `libelleTypeUtilisateur` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE IF NOT EXISTS `Utilisateur` (
`idUtilisateur` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mot_de_passe` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `identifiant` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idTypeUtilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
 ADD PRIMARY KEY (`idArtiste`,`idExpo`), ADD UNIQUE KEY `cpl_unik1` (`idArtiste`,`idExpo`), ADD KEY `idExpo` (`idExpo`);

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
 ADD PRIMARY KEY (`idEmplacement`), ADD KEY `FK_Emplacement_idExpo` (`idExpo`), ADD KEY `idOeuvreExposee` (`idOeuvreExposee`);

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
 ADD PRIMARY KEY (`idMessage`), ADD KEY `FK_Message_interne_idUtilisateur` (`idUtilisateur`), ADD KEY `FK_Message_interne_idOeuvre` (`idOeuvre`), ADD KEY `FK_Message_interne_idArtiste` (`idArtiste`), ADD KEY `FK_Message_interne_idExpo` (`idExpo`), ADD KEY `FK_Message_interne_idCollectif` (`idCollectif`);

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
MODIFY `idArtiste` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `Collectif`
--
ALTER TABLE `Collectif`
MODIFY `idCollectif` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `Donnee_enrichie`
--
ALTER TABLE `Donnee_enrichie`
MODIFY `idDonneeEnrichie` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Emplacement`
--
ALTER TABLE `Emplacement`
MODIFY `idEmplacement` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `Exposition`
--
ALTER TABLE `Exposition`
MODIFY `idExpo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `Langue`
--
ALTER TABLE `Langue`
MODIFY `idLangue` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Message_interne`
--
ALTER TABLE `Message_interne`
MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Oeuvre`
--
ALTER TABLE `Oeuvre`
MODIFY `idOeuvre` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `OeuvreExposee`
--
ALTER TABLE `OeuvreExposee`
MODIFY `idOeuvreExposee` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT pour la table `Traduction`
--
ALTER TABLE `Traduction`
MODIFY `idTraduction` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Type_donnee_enrichie`
--
ALTER TABLE `Type_donnee_enrichie`
MODIFY `idTypeDonneEnrichie` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Type_oeuvre`
--
ALTER TABLE `Type_oeuvre`
MODIFY `idTypeOeuvre` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `Type_utilisateur`
--
ALTER TABLE `Type_utilisateur`
MODIFY `idTypeUtilisateur` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT;
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
ADD CONSTRAINT `ArtisteExpose_ibfk_1` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`),
ADD CONSTRAINT `ArtisteExpose_ibfk_2` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`);

--
-- Contraintes pour la table `CollectifExpose`
--
ALTER TABLE `CollectifExpose`
ADD CONSTRAINT `CollectifExpose_ibfk_2` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`),
ADD CONSTRAINT `CollectifExpose_ibfk_1` FOREIGN KEY (`idCollectif`) REFERENCES `Collectif` (`idCollectif`);

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
ADD CONSTRAINT `FK_Emplacement_idExpo` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`);

--
-- Contraintes pour la table `Langue_expo`
--
ALTER TABLE `Langue_expo`
ADD CONSTRAINT `FK_affecter_idExpo` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`),
ADD CONSTRAINT `FK_affecter_idLangue` FOREIGN KEY (`idLangue`) REFERENCES `Langue` (`idLangue`);

--
-- Contraintes pour la table `Message_interne`
--
ALTER TABLE `Message_interne`
ADD CONSTRAINT `FK_Message_interne_idArtiste` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`),
ADD CONSTRAINT `FK_Message_interne_idCollectif` FOREIGN KEY (`idCollectif`) REFERENCES `Collectif` (`idCollectif`),
ADD CONSTRAINT `FK_Message_interne_idExpo` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`),
ADD CONSTRAINT `FK_Message_interne_idOeuvre` FOREIGN KEY (`idOeuvre`) REFERENCES `Oeuvre` (`idOeuvre`),
ADD CONSTRAINT `FK_Message_interne_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateur` (`idUtilisateur`);

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
ADD CONSTRAINT `OeuvreExposee_ibfk_2` FOREIGN KEY (`idOeuvre`) REFERENCES `Oeuvre` (`idOeuvre`),
ADD CONSTRAINT `OeuvreExposee_ibfk_3` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`);

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

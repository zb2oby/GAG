-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 29 Décembre 2017 à 19:31
-- Version du serveur :  5.5.57-0+deb8u1
-- Version de PHP :  7.0.23-1~dotdeb+8.1

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
  `descriptifFR` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Structure de la table `Exposition`
--

CREATE TABLE IF NOT EXISTS `Exposition` (
`id_expo` int(11) NOT NULL,
  `horairesO` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horaireF` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `theme` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptifFR` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `frequentation` int(11) DEFAULT NULL,
  `dateDeb` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `teaser` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `affiche` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id_expo` int(11) NOT NULL,
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
  `id_expo` int(11) DEFAULT NULL,
  `idCollectif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Oeuvre`
--

CREATE TABLE IF NOT EXISTS `Oeuvre` (
`idOeuvre` int(11) NOT NULL,
  `longueur` decimal(7,2) DEFAULT NULL,
  `hauteur` decimal(7,2) DEFAULT NULL,
  `etat` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qrcode` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptifFR` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nbClic` int(11) DEFAULT NULL,
  `idTypeOeuvre` int(11) DEFAULT NULL,
  `idArtiste` int(11) DEFAULT NULL,
  `idCollectif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Oeuvre_prevue`
--

CREATE TABLE IF NOT EXISTS `Oeuvre_prevue` (
  `dateEntreeRelle` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateSortie` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `n_emplacement` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_expo` int(11) NOT NULL,
  `idOeuvre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Traduction`
--

CREATE TABLE IF NOT EXISTS `Traduction` (
  `texteTraduit` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
`idTraduction` int(11) NOT NULL,
  `idArtiste` int(11) DEFAULT NULL,
  `idCollectif` int(11) DEFAULT NULL,
  `idOeuvre` int(11) DEFAULT NULL,
  `id_expo` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Index pour la table `Collectif`
--
ALTER TABLE `Collectif`
 ADD PRIMARY KEY (`idCollectif`);

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
-- Index pour la table `Exposition`
--
ALTER TABLE `Exposition`
 ADD PRIMARY KEY (`id_expo`);

--
-- Index pour la table `Langue`
--
ALTER TABLE `Langue`
 ADD PRIMARY KEY (`idLangue`);

--
-- Index pour la table `Langue_expo`
--
ALTER TABLE `Langue_expo`
 ADD PRIMARY KEY (`id_expo`,`idLangue`), ADD KEY `FK_affecter_idLangue` (`idLangue`);

--
-- Index pour la table `Message_interne`
--
ALTER TABLE `Message_interne`
 ADD PRIMARY KEY (`idMessage`), ADD KEY `FK_Message_interne_idUtilisateur` (`idUtilisateur`), ADD KEY `FK_Message_interne_idOeuvre` (`idOeuvre`), ADD KEY `FK_Message_interne_idArtiste` (`idArtiste`), ADD KEY `FK_Message_interne_id_expo` (`id_expo`), ADD KEY `FK_Message_interne_idCollectif` (`idCollectif`);

--
-- Index pour la table `Oeuvre`
--
ALTER TABLE `Oeuvre`
 ADD PRIMARY KEY (`idOeuvre`), ADD KEY `FK_Oeuvre_idTypeOeuvre` (`idTypeOeuvre`), ADD KEY `FK_Oeuvre_idArtiste` (`idArtiste`), ADD KEY `FK_Oeuvre_idCollectif` (`idCollectif`);

--
-- Index pour la table `Oeuvre_prevue`
--
ALTER TABLE `Oeuvre_prevue`
 ADD PRIMARY KEY (`id_expo`,`idOeuvre`), ADD KEY `FK_prevoir_idOeuvre` (`idOeuvre`);

--
-- Index pour la table `Traduction`
--
ALTER TABLE `Traduction`
 ADD PRIMARY KEY (`idTraduction`), ADD KEY `FK_Traduction_idArtiste` (`idArtiste`), ADD KEY `FK_Traduction_idCollectif` (`idCollectif`), ADD KEY `FK_Traduction_idOeuvre` (`idOeuvre`), ADD KEY `FK_Traduction_id_expo` (`id_expo`), ADD KEY `FK_Traduction_idLangue` (`idLangue`);

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
MODIFY `idArtiste` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Collectif`
--
ALTER TABLE `Collectif`
MODIFY `idCollectif` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Donnee_enrichie`
--
ALTER TABLE `Donnee_enrichie`
MODIFY `idDonneeEnrichie` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Exposition`
--
ALTER TABLE `Exposition`
MODIFY `id_expo` int(11) NOT NULL AUTO_INCREMENT;
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
MODIFY `idOeuvre` int(11) NOT NULL AUTO_INCREMENT;
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
MODIFY `idTypeOeuvre` int(11) NOT NULL AUTO_INCREMENT;
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
-- Contraintes pour la table `Communaute`
--
ALTER TABLE `Communaute`
ADD CONSTRAINT `FK_appartenir_idCollectif` FOREIGN KEY (`idCollectif`) REFERENCES `Collectif` (`idCollectif`),
ADD CONSTRAINT `FK_appartenir_idArtiste` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`);

--
-- Contraintes pour la table `Donnee_enrichie`
--
ALTER TABLE `Donnee_enrichie`
ADD CONSTRAINT `FK_Donnee_enrichie_idOeuvre` FOREIGN KEY (`idOeuvre`) REFERENCES `Oeuvre` (`idOeuvre`),
ADD CONSTRAINT `FK_Donnee_enrichie_idTypeDonneEnrichie` FOREIGN KEY (`idTypeDonneEnrichie`) REFERENCES `Type_donnee_enrichie` (`idTypeDonneEnrichie`);

--
-- Contraintes pour la table `Langue_expo`
--
ALTER TABLE `Langue_expo`
ADD CONSTRAINT `FK_affecter_idLangue` FOREIGN KEY (`idLangue`) REFERENCES `Langue` (`idLangue`),
ADD CONSTRAINT `FK_affecter_id_expo` FOREIGN KEY (`id_expo`) REFERENCES `Exposition` (`id_expo`);

--
-- Contraintes pour la table `Message_interne`
--
ALTER TABLE `Message_interne`
ADD CONSTRAINT `FK_Message_interne_idCollectif` FOREIGN KEY (`idCollectif`) REFERENCES `Collectif` (`idCollectif`),
ADD CONSTRAINT `FK_Message_interne_idArtiste` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`),
ADD CONSTRAINT `FK_Message_interne_idOeuvre` FOREIGN KEY (`idOeuvre`) REFERENCES `Oeuvre` (`idOeuvre`),
ADD CONSTRAINT `FK_Message_interne_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateur` (`idUtilisateur`),
ADD CONSTRAINT `FK_Message_interne_id_expo` FOREIGN KEY (`id_expo`) REFERENCES `Exposition` (`id_expo`);

--
-- Contraintes pour la table `Oeuvre`
--
ALTER TABLE `Oeuvre`
ADD CONSTRAINT `FK_Oeuvre_idCollectif` FOREIGN KEY (`idCollectif`) REFERENCES `Collectif` (`idCollectif`),
ADD CONSTRAINT `FK_Oeuvre_idArtiste` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`),
ADD CONSTRAINT `FK_Oeuvre_idTypeOeuvre` FOREIGN KEY (`idTypeOeuvre`) REFERENCES `Type_oeuvre` (`idTypeOeuvre`);

--
-- Contraintes pour la table `Oeuvre_prevue`
--
ALTER TABLE `Oeuvre_prevue`
ADD CONSTRAINT `FK_prevoir_idOeuvre` FOREIGN KEY (`idOeuvre`) REFERENCES `Oeuvre` (`idOeuvre`),
ADD CONSTRAINT `FK_prevoir_id_expo` FOREIGN KEY (`id_expo`) REFERENCES `Exposition` (`id_expo`);

--
-- Contraintes pour la table `Traduction`
--
ALTER TABLE `Traduction`
ADD CONSTRAINT `FK_Traduction_idLangue` FOREIGN KEY (`idLangue`) REFERENCES `Langue` (`idLangue`),
ADD CONSTRAINT `FK_Traduction_idArtiste` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`),
ADD CONSTRAINT `FK_Traduction_idCollectif` FOREIGN KEY (`idCollectif`) REFERENCES `Collectif` (`idCollectif`),
ADD CONSTRAINT `FK_Traduction_idOeuvre` FOREIGN KEY (`idOeuvre`) REFERENCES `Oeuvre` (`idOeuvre`),
ADD CONSTRAINT `FK_Traduction_id_expo` FOREIGN KEY (`id_expo`) REFERENCES `Exposition` (`id_expo`);

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

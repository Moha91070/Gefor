-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 03 juin 2021 à 23:25
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ppe3`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

DROP TABLE IF EXISTS `candidat`;
CREATE TABLE IF NOT EXISTS `candidat` (
  `idcandidat` int(11) NOT NULL AUTO_INCREMENT,
  `nom_dusage` varchar(45) NOT NULL,
  `nom_jeunefille` varchar(255) DEFAULT NULL,
  `prenom` varchar(45) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `adresse` varchar(75) DEFAULT NULL,
  `cp` varchar(10) DEFAULT NULL,
  `ville` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `tel` varchar(14) DEFAULT NULL,
  `nationalite` varchar(255) DEFAULT NULL,
  `reunion_info` tinyint(1) DEFAULT NULL,
  `elementdeclencheur` text,
  `objectif2` text,
  `objectif3` text,
  `objectif4` text,
  `objectif5` text,
  `objectif7` text,
  `objectif8` text,
  `pk_formation` text,
  `court` text,
  `moyen` text,
  `long_terme` text,
  `points_forts` text,
  `axe_progres` text,
  `charges_familiales` text,
  `soutien_entourage` varchar(50) DEFAULT NULL,
  `adequation` text,
  `stages` text,
  `diplome` varchar(255) DEFAULT NULL,
  `motivations` varchar(45) DEFAULT NULL,
  `epreuve_dispense` varchar(255) DEFAULT NULL,
  `avis_projet` varchar(45) DEFAULT NULL,
  `decision` varchar(45) DEFAULT NULL,
  `remarque_decision` text,
  `organisme_connu` text,
  `id_situation` int(11) DEFAULT NULL,
  `commentaire_situation` varchar(45) DEFAULT NULL,
  `id_formation` int(11) DEFAULT NULL,
  `id_session` int(11) DEFAULT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  `cursus_formulaire` int(11) DEFAULT NULL,
  `autre_soutien` varchar(100) DEFAULT NULL,
  `entretien` date DEFAULT NULL,
  `remarque_entretien` text,
  `resultat_test` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`idcandidat`),
  KEY `idformation` (`id_formation`),
  KEY `idsituation_pro` (`id_situation`),
  KEY `id_session` (`id_session`),
  KEY `id_groupe` (`id_groupe`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `candidat`
--

INSERT INTO `candidat` (`idcandidat`, `nom_dusage`, `nom_jeunefille`, `prenom`, `date_naissance`, `adresse`, `cp`, `ville`, `email`, `tel`, `nationalite`, `reunion_info`, `elementdeclencheur`, `objectif2`, `objectif3`, `objectif4`, `objectif5`, `objectif7`, `objectif8`, `pk_formation`, `court`, `moyen`, `long_terme`, `points_forts`, `axe_progres`, `charges_familiales`, `soutien_entourage`, `adequation`, `stages`, `diplome`, `motivations`, `epreuve_dispense`, `avis_projet`, `decision`, `remarque_decision`, `organisme_connu`, `id_situation`, `commentaire_situation`, `id_formation`, `id_session`, `mot_de_passe`, `id_groupe`, `date_ajout`, `date_modification`, `cursus_formulaire`, `autre_soutien`, `entretien`, `remarque_entretien`, `resultat_test`) VALUES
(11, 'akhmouch', 'mohamed akhmouch', 'mohamed', '2021-03-18', '11 square de la butte', '91070', 'BONDOUFLE', 'mohamed@hotmail.fr', '0652868532', 'française', NULL, 'la crise du covid', 'chef de projet', 'cadre de vie', 'gea', 'propre', 'Expérience professionnelle', 'bjbqjkv;', 'necessaire', 'hjghjb', NULL, NULL, 'beau-goss', 'ferrari', '4 enfants', 'oui', 'avis formation visée', '5 semaine de stage', 'bts banque', '++', 'anglais', '++', 'HJVJ', 'remarque decision', 'internet', 3, '', 3, NULL, '$2y$10$Tunit9uMSwlFAJnJDI6F7e4Q1UgeyBqGKMLza.3whgsw9bzsackvu', 4, '2021-03-09', NULL, 1, 'amis', '2021-03-02', 'remaque entretien', '++'),
(24, 'user', '', 'user', '2002-12-10', '10 rue de la paix', '75000', 'paris', 'user@user', '0612345678', 'française', 0, 'argent', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', '4 enfants', 'non', 'fgfg', '5 semaine de stage', 'bts banque', '+/-', 'anglais', '++', 'Favorable', 'hgh', 'internet', 3, '', 3, 11, '$2y$10$OYDB5i.0CicfTyt6VAG9AeHgn7Z1R8MwKV9MI49I4VMA0gENihDWa', 3, NULL, NULL, 3, 'eee', '2021-03-02', 'fgfg', '++'),
(25, 'usere', '', 'usere', '2002-12-11', '10 rue de la paix', '75000', 'paris', 'user1@user1', '0612345678', 'française', 0, 'argent', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', '4 enfants', 'oui', 'nnlnlndsknlsknd', '5 semaine de stage', 'bts banque', '+/-', 'anglais math', '+/-', 'Favorable', 'bsdbwn;c', 'internet', 4, '', 1, 1, '$2y$10$KlKo4LFklsvedAejQ9Egp.OSg.tNVAxZJ/K6Bgyr1u3ZJTybQTBa6', 3, NULL, NULL, 3, 'amis', '2021-03-02', 'jlkfndknfl:', '+'),
(65, 'xxx', '', 'xxx', '2002-12-26', '10 rue de la paix', '75000', 'paris', 'xxx@xxx', '0612345678', 'française', 0, 'argent', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', '4 enfants', 'non', 'lk^xkv^;cxù;c!', '5 semaine de stage', 'bts banque', '++', 'anglais', '++', 'Favorable', 'jncxncxln', 'internet', 3, '', 2, 16, '$2y$10$x.0X4PK7m8cfKidkne8JGO0Y7xiNbHnlFeccPYrBQ3CULlm.gY5Ey', 3, '2021-03-14', NULL, 3, 'amis', '2021-03-24', 'kjkcjsml,dms,', '++'),
(66, 'aaaaa', NULL, 'efe', '1958-10-16', 'rue du bis', '75000', 'paris', 'd@d', '0235545545', 'française', NULL, 'l\\\'argent', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', '4 enfants', 'non', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '5 semaine de stage', 'bts banque', '++', 'anglais', '++', 'Favorable', 'mmmmmmmmmmmmmmmmmmmmmmmmm', 'internet', 3, NULL, 2, 5, '$2y$10$FwLrE21.j862X2xep6bAMu8T6WoeWT2YPvtVVjQfE2b91bd9v7dUS', 3, NULL, NULL, 3, 'amis', '2021-03-19', 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', '++'),
(67, 'dupont', NULL, 'fes', '2002-12-19', 'ruendu pain', '75000', 'paris', 'f@f', '0254555555', 'française', 1, 'argent', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', '4 enfants', 'non', 'wl,ms,,sd,sm', '5 semaine de stage', 'bts banque', '++', 'anglais math', '++', 'Favorable', ',nxkcmd,mcl,d', 'internet', 3, NULL, 3, 2, '$2y$10$0sG5/hUacB7n0auzgcZJAuZTJBO2454NFBAss1YcN4LhFp17g5fUm', 3, NULL, NULL, 3, 'amis', '2021-03-20', 'oihsoihdoisholdsh', '++'),
(68, 'test', NULL, 'test', '2002-12-25', '10 rue de la paix', '75000', 'paris', 'test@test', '0612345678', 'française', NULL, 'l\\\'argent', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', '4 enfants', 'non', 'trés bien', '5 semaine de stage', 'bts banque', '++', 'anglais', '++', 'Reserve', 'ras', 'internet', 4, NULL, 1, 1, '$2y$10$dbXmo5L3SudpskEqF5XCF.yhVvKM/kyh7aL/858KLD/slJvjNORNK', 9, NULL, NULL, 2, 'ras', '2021-04-29', 'ras', '++'),
(70, 'aaaaa', NULL, 'd', '2002-12-31', '10 paris', '75000', 'paris', 'user2@user', '0235545545', 'française', 1, 'l\\\'argent', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', '4 enfants', 'non', 'ras', '5 semaine de stage', 'bts banque', '++', 'anglais math', '++', 'Favorable', 'ras', 'internet', 3, NULL, 2, 1, '$2y$10$.QSfug9/3L6oUEsG62Hlauy45X54FAiSfK4X0m/jUgzgDGZ15mfqu', 3, NULL, NULL, 3, 'amis', '2021-04-18', 'ras', '++'),
(72, 'ssssss', NULL, 'sssss', '2002-12-26', 'ruru', '75000', 'paris', 'user4@user', '0254555555', 'française', 1, 'l\\\'argent', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', '4 enfants', 'oui', 'ras', '5 semaine de stage', 'bts banque', '++', 'anglais', '++', 'Reserve', 'ras', 'internet', 4, NULL, 3, 1, '$2y$10$46WmquXY649I9mwWEmhgkOf38ZX.7nDSKCdn5dP8v1S1m4vrIghti', 9, NULL, NULL, 2, 'amis', '2021-04-14', 'ras', '++'),
(73, 'dddddd', NULL, 'ddd', '2002-12-17', 'ruendu pain', '75000', 'paris', 'user5@user', '0254555555', 'française', 1, 'la passion', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', NULL, 'non', 'ras', NULL, NULL, '--', NULL, '--', 'Défavorable', NULL, 'internet', 4, NULL, 3, 1, '$2y$10$whklDogE5D1WeVKYsBRwr.ILXd4TmmgdWBiaAtCjo3RIdEY8P3kzC', 6, NULL, NULL, 2, NULL, '2021-04-23', NULL, '--'),
(74, 'kkkk', NULL, 'ooooo', '2002-12-12', 'ruendu pain', '75000', 'paris', 'user6@user', '0254555555', 'française', 1, 'la passion', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', '4 enfants', 'non', NULL, NULL, NULL, '--', NULL, '--', 'Défavorable', NULL, 'internet', 3, NULL, 2, 16, '$2y$10$AVhRaRQLaIBFyswoaFZYp.SvIkHVjrQoONjJNgsSep21FOSn.ArFS', 7, NULL, NULL, 2, NULL, '2021-05-31', NULL, '--'),
(75, 'jbb', NULL, 'kj', '2002-12-18', 'ruendu pain', '75000', 'paris', 'user7@user', '0254555555', 'française', 1, 'la passion', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', '4 enfants', 'oui', 'RAS', '5 semaine de stage', 'bts banque', '++', NULL, '++', 'Favorable', NULL, 'internet', 3, NULL, 2, NULL, '$2y$10$UlUXcv8/ODEndPq6YL7MauA7AEe5mEkoTispABEiM5KOUeSGKyPT2', 3, NULL, NULL, 3, 'ras', '2021-04-29', NULL, '++'),
(76, 'dupont', NULL, 'jean', '2002-12-25', 'ruendu pain', '75000', 'paris', 'test8@gmail', '0254555555', 'française', NULL, 'la passion', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'internet', 3, NULL, 2, NULL, '$2y$10$DNMapnr1w2Q51sX2IUxp.unPX2nFkhyJIRiE6cn.GD3av80495FJy', 6, NULL, NULL, 2, NULL, NULL, NULL, NULL),
(77, 'dupont', NULL, 'jean', '2002-12-18', 'ruendu pain', '75000', 'paris', 'user8@user', '0254555555', 'française', 1, 'la passion', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'internet', 3, NULL, 2, NULL, '$2y$10$LJFiX3IqpuQcGnuYtVoD1OtklczXoYK49Zxnku6d2pj3nDeCcb10W', 6, NULL, NULL, 2, NULL, NULL, NULL, NULL),
(78, 'mamie', NULL, 'jean', '2002-12-17', 'ruendu pain', '75000', 'paris', 'user9@user', '0254555555', 'française', NULL, 'la passion', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'internet', 2, NULL, 2, NULL, '$2y$10$GlnYQW8ZF5AXbEQN/dvJbel5T2AQ0wi9uZtfgEhlYH7nV5StroPEq', 7, NULL, NULL, 2, NULL, NULL, NULL, NULL),
(79, 'mamie', NULL, 'jean', '2002-12-05', 'rue de la rue', '75000', 'paris', 'ppe@gmail.com', '0123456789', 'française', NULL, 'la passion', 'chef de projet', 'evolution', 'curiosité', 'sa recrute', 'discret', 'question 8', 'question 9', 'court', 'moyen', 'long', 'fort', 'progrès', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'internet', 2, NULL, 2, NULL, '$2y$10$.RbvX9gQLf.RLaVsCFyjPuuD6WH9F0M3vFPrcvclSZ1gU1td8DCKK', 7, NULL, NULL, 2, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `demarche_entreprise`
--

DROP TABLE IF EXISTS `demarche_entreprise`;
CREATE TABLE IF NOT EXISTS `demarche_entreprise` (
  `iddemarche_entreprise` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(45) NOT NULL,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  PRIMARY KEY (`iddemarche_entreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `demarche_entreprise`
--

INSERT INTO `demarche_entreprise` (`iddemarche_entreprise`, `libelle`, `date_ajout`, `date_modification`) VALUES
(1, 'ENQUETES AUPRES DE PROFESSIONELLES', NULL, NULL),
(2, 'VISITES DE SALONS', NULL, NULL),
(3, 'CONSULTATIONS D\'ANNONCES', NULL, NULL),
(4, 'COURS DU SOIR', NULL, NULL),
(5, 'AUTRES', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `divers`
--

DROP TABLE IF EXISTS `divers`;
CREATE TABLE IF NOT EXISTS `divers` (
  `iddivers` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(45) DEFAULT NULL,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  PRIMARY KEY (`iddivers`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `divers`
--

INSERT INTO `divers` (`iddivers`, `libelle`, `date_ajout`, `date_modification`) VALUES
(1, 'Un bilan de compétences', NULL, NULL),
(2, 'VAE ', NULL, NULL),
(3, 'CEP', NULL, NULL),
(4, 'CIF/CPF TP ', NULL, NULL),
(5, 'Autre', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id_document` int(11) NOT NULL AUTO_INCREMENT,
  `libellé` varchar(255) NOT NULL,
  PRIMARY KEY (`id_document`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `document`
--

INSERT INTO `document` (`id_document`, `libellé`) VALUES
(1, 'CV'),
(2, 'lettre de motivation'),
(3, 'relevé de note'),
(4, 'baccalauréat'),
(5, 'assurance responsabilité civile'),
(7, 'convention de CPF'),
(8, 'Attestation d\'inscription'),
(9, 'Enquête métier');

-- --------------------------------------------------------

--
-- Structure de la table `document_candidat`
--

DROP TABLE IF EXISTS `document_candidat`;
CREATE TABLE IF NOT EXISTS `document_candidat` (
  `id_candidat` int(11) NOT NULL,
  `id_document` int(11) NOT NULL,
  `url_document` text NOT NULL,
  `date_ajout` date NOT NULL,
  `date_modification` date DEFAULT NULL,
  UNIQUE KEY `id_candidat_2` (`id_candidat`,`id_document`) USING BTREE,
  KEY `id_document` (`id_document`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `document_candidat`
--

INSERT INTO `document_candidat` (`id_candidat`, `id_document`, `url_document`, `date_ajout`, `date_modification`) VALUES
(11, 1, 'motivation/vitesse turner (1).doc', '2021-03-08', NULL),
(65, 1, 'motivation/Capture d’écran 2021-03-14 150421.jpg', '2021-03-14', NULL),
(65, 2, 'motivation/logo.jpg.png', '2021-03-14', NULL),
(66, 1, 'motivation/argumenter ralentir (3).doc', '2021-03-18', NULL),
(66, 2, 'motivation/fiche lecture.docx', '2021-03-18', NULL),
(67, 1, 'motivation/bts_chapitre_i_a_toute_vitesse.pdf', '2021-03-18', NULL),
(67, 2, 'motivation/grille-evalEP (2).doc', '2021-03-18', NULL),
(68, 1, 'motivation/FRAN_DMOASI_2019_10_Formulaire_demande_de_dotation_informatique (3).docx', '2021-04-02', NULL),
(68, 2, 'motivation/FRAN_DMOASI_2019_10_Formulaire_demande_de_dotation_informatique (1).docx', '2021-04-02', NULL),
(70, 1, 'motivation/FRAN_DMOASI_2019_10_Formulaire_demande_de_dotation_informatique (2).docx', '2021-04-03', NULL),
(70, 2, 'motivation/FRAN_DMOASI_2019_10_Formulaire_demande_de_dotation_informatique.docx', '2021-04-03', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `dossier_etat`
--

DROP TABLE IF EXISTS `dossier_etat`;
CREATE TABLE IF NOT EXISTS `dossier_etat` (
  `id_candidat` int(11) NOT NULL,
  `id_etat` int(11) NOT NULL,
  `initie` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `transmis` date DEFAULT NULL,
  `financeur` varchar(50) DEFAULT NULL,
  UNIQUE KEY `id_candidat` (`id_candidat`,`id_etat`) USING BTREE,
  KEY `id_etat` (`id_etat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dossier_etat`
--

INSERT INTO `dossier_etat` (`id_candidat`, `id_etat`, `initie`, `date`, `transmis`, `financeur`) VALUES
(24, 6, '2021-03-31', '2021-04-15', '2021-04-06', 'transition pro'),
(25, 3, '2021-03-18', '2021-04-21', '2021-04-21', 'transition pro'),
(65, 6, '2021-03-18', '2021-04-22', '2021-04-13', 'transition pro'),
(66, 4, '2021-03-26', NULL, '2021-04-29', 'transition pro'),
(67, 3, '2021-03-30', '2021-04-30', '2021-04-29', 'transition pro'),
(68, 3, '2021-04-09', '2021-04-28', '2021-04-20', 'transition pro'),
(70, 4, '2021-04-28', NULL, NULL, NULL),
(72, 6, '2021-04-04', '2021-04-30', '2021-04-16', 'transition pro'),
(75, 4, '2021-04-04', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `effectuer`
--

DROP TABLE IF EXISTS `effectuer`;
CREATE TABLE IF NOT EXISTS `effectuer` (
  `id_c` int(11) NOT NULL,
  `id_d` int(11) NOT NULL,
  `commentaire` blob,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  UNIQUE KEY `id_c_2` (`id_c`,`id_d`),
  KEY `id_c` (`id_c`),
  KEY `id_d` (`id_d`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `effectuer`
--

INSERT INTO `effectuer` (`id_c`, `id_d`, `commentaire`, `date_ajout`, `date_modification`) VALUES
(11, 2, NULL, NULL, NULL),
(24, 1, NULL, '2021-03-13', NULL),
(25, 1, NULL, '2021-03-13', NULL),
(65, 3, NULL, '2021-03-14', NULL),
(66, 2, NULL, '2021-03-18', NULL),
(67, 1, NULL, '2021-03-18', NULL),
(68, 4, NULL, '2021-04-02', NULL),
(70, 2, NULL, '2021-04-03', NULL),
(70, 3, NULL, '2021-04-03', NULL),
(72, 1, NULL, '2021-04-03', NULL),
(72, 2, NULL, '2021-04-03', NULL),
(72, 3, NULL, '2021-04-03', NULL),
(72, 4, NULL, '2021-04-03', NULL),
(73, 2, NULL, '2021-04-03', NULL),
(74, 2, NULL, '2021-04-03', NULL),
(75, 2, NULL, '2021-04-03', NULL),
(76, 3, NULL, '2021-04-03', NULL),
(77, 3, NULL, '2021-04-03', NULL),
(78, 2, NULL, '2021-04-04', NULL),
(79, 1, NULL, '2021-06-04', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `id_employe` int(11) NOT NULL AUTO_INCREMENT,
  `nom_employe` varchar(255) NOT NULL,
  `prenom_employe` varchar(255) NOT NULL,
  `mot_passe_employe` varchar(255) DEFAULT NULL,
  `email_employe` varchar(255) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  PRIMARY KEY (`id_employe`),
  KEY `id_groupe` (`id_groupe`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id_employe`, `nom_employe`, `prenom_employe`, `mot_passe_employe`, `email_employe`, `id_groupe`, `date_ajout`, `date_modification`) VALUES
(15, 'admin', 'admin', '$2y$10$CklV4Be0YGq6YjeAAXZO9OuQLM1Lb05kuH8EAA3gkFKioFLp1y.Tu', 'admin@admin', 1, '2021-04-01', NULL),
(16, 'dev', 'dev', '$2y$10$GBE7anMCk.egZQtX8f4J6.nAKKvSyQc.aSRytB0i.I5q9NrsFBt9W', 'dev@dev', 2, '2021-04-01', NULL),
(20, 'mamie', 'christopher', '$2y$10$XdQwhWwlPMSLV1v0t/Jew.qslchYv6xc5ZgfVRSbDNbgLBQDM8Qyq', 'cc@jj', 1, '2021-04-03', NULL),
(21, 'mamie', 'jean', '$2y$10$dH5aTJYiCBUHQVksx.enpuS/epAUTjn9bZdj0Dngq..4cnwGLVxku', 'CHRIS@gmail.com', 2, '2021-05-31', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id_cand` int(11) NOT NULL,
  `id_demarche` int(11) NOT NULL,
  `commentaire` text,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  UNIQUE KEY `id_cand` (`id_cand`,`id_demarche`) USING BTREE,
  KEY `id_demarche` (`id_demarche`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id_cand`, `id_demarche`, `commentaire`, `date_ajout`, `date_modification`) VALUES
(24, 1, NULL, NULL, NULL),
(25, 1, NULL, NULL, NULL),
(65, 1, NULL, NULL, NULL),
(66, 2, NULL, NULL, NULL),
(66, 3, NULL, NULL, NULL),
(67, 1, NULL, NULL, NULL),
(68, 3, NULL, NULL, NULL),
(68, 4, NULL, NULL, NULL),
(70, 1, NULL, NULL, NULL),
(70, 2, NULL, NULL, NULL),
(70, 3, NULL, NULL, NULL),
(72, 1, NULL, NULL, NULL),
(73, 3, NULL, NULL, NULL),
(74, 1, NULL, NULL, NULL),
(74, 2, NULL, NULL, NULL),
(75, 1, NULL, NULL, NULL),
(76, 2, NULL, NULL, NULL),
(77, 2, NULL, NULL, NULL),
(78, 1, NULL, NULL, NULL),
(79, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etat_dossier`
--

DROP TABLE IF EXISTS `etat_dossier`;
CREATE TABLE IF NOT EXISTS `etat_dossier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etat_dossier`
--

INSERT INTO `etat_dossier` (`id`, `nom`) VALUES
(2, 'Reporter'),
(3, 'Annuler'),
(4, 'Initier'),
(5, 'Transmis'),
(6, 'accepter'),
(7, 'refuser');

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `idformation` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(45) DEFAULT NULL,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  PRIMARY KEY (`idformation`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`idformation`, `libelle`, `date_ajout`, `date_modification`) VALUES
(1, 'assurance', NULL, NULL),
(2, 'banque', NULL, NULL),
(3, 'Comptabilité et gestion ', NULL, NULL),
(4, 'Gestion de la PM', NULL, NULL),
(5, 'Management Commercial Opérationnel ', NULL, NULL),
(6, 'BTS SIO (Option - SLAM)', NULL, NULL),
(7, 'BTS SIO (Option - SISR)', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id_groupe` int(11) NOT NULL AUTO_INCREMENT,
  `nom_groupe` varchar(255) NOT NULL,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  PRIMARY KEY (`id_groupe`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id_groupe`, `nom_groupe`, `date_ajout`, `date_modification`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Développeur', NULL, NULL),
(3, 'Candidat', NULL, NULL),
(4, 'Demandeur', NULL, NULL),
(5, 'Annulation', NULL, NULL),
(6, 'Refus', NULL, NULL),
(7, 'attente', NULL, NULL),
(8, 'report', NULL, NULL),
(9, 'Réservée ', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

DROP TABLE IF EXISTS `langues`;
CREATE TABLE IF NOT EXISTS `langues` (
  `idlangues` int(11) NOT NULL AUTO_INCREMENT,
  `langues` varchar(45) NOT NULL,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  PRIMARY KEY (`idlangues`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `langues`
--

INSERT INTO `langues` (`idlangues`, `langues`, `date_ajout`, `date_modification`) VALUES
(1, 'ANGLAIS', NULL, NULL),
(2, 'ESPAGNOL', NULL, NULL),
(3, 'ALLEMAND', NULL, NULL),
(4, 'ITALIEN', NULL, NULL),
(5, 'PORTUGAIS', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `logiciel`
--

DROP TABLE IF EXISTS `logiciel`;
CREATE TABLE IF NOT EXISTS `logiciel` (
  `idlogiciel` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(45) DEFAULT NULL,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  PRIMARY KEY (`idlogiciel`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `logiciel`
--

INSERT INTO `logiciel` (`idlogiciel`, `libelle`, `date_ajout`, `date_modification`) VALUES
(1, 'TRAITEMENT DE TEXTE (WORD)', NULL, NULL),
(2, 'TABLEUR (EXCEL)', NULL, NULL),
(3, 'AUTRE(S)  ', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `parler`
--

DROP TABLE IF EXISTS `parler`;
CREATE TABLE IF NOT EXISTS `parler` (
  `idcandidat` int(11) NOT NULL,
  `idlangues` int(11) NOT NULL,
  `niveau` varchar(45) DEFAULT NULL,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  UNIQUE KEY `idlangues` (`idlangues`,`idcandidat`),
  UNIQUE KEY `idcandidat` (`idcandidat`,`idlangues`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `parler`
--

INSERT INTO `parler` (`idcandidat`, `idlangues`, `niveau`, `date_ajout`, `date_modification`) VALUES
(24, 1, 'débutant', '2021-03-13', NULL),
(25, 1, 'débutant', '2021-03-13', NULL),
(65, 1, 'débutant', '2021-03-14', NULL),
(66, 1, 'bilingue', '2021-03-18', NULL),
(67, 1, 'débutant', '2021-03-18', NULL),
(70, 1, 'débutant', '2021-04-03', NULL),
(72, 1, 'débutant', '2021-04-03', NULL),
(73, 1, 'débutant', '2021-04-03', NULL),
(74, 1, 'débutant', '2021-04-03', NULL),
(75, 1, 'débutant', '2021-04-03', NULL),
(77, 1, 'débutant', '2021-04-03', NULL),
(78, 1, 'débutant', '2021-04-04', NULL),
(79, 1, 'débutant', '2021-06-04', NULL),
(66, 2, 'courant', '2021-03-18', NULL),
(68, 2, 'bilingue', '2021-04-02', NULL),
(75, 2, 'débutant', '2021-04-03', NULL),
(76, 2, 'débutant', '2021-04-03', NULL),
(68, 3, 'courant', '2021-04-02', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

DROP TABLE IF EXISTS `periode`;
CREATE TABLE IF NOT EXISTS `periode` (
  `idsession` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(20) DEFAULT NULL,
  `duree` varchar(20) NOT NULL,
  `datedebut` date DEFAULT NULL,
  `datefin` date DEFAULT NULL,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  PRIMARY KEY (`idsession`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `periode`
--

INSERT INTO `periode` (`idsession`, `session`, `duree`, `datedebut`, `datefin`, `date_ajout`, `date_modification`) VALUES
(1, '2021/2022', '9 MOIS', '2021-06-13', '2022-05-30', NULL, NULL),
(2, '2021/2022', '12 MOIS', '2021-09-02', '2022-05-30', NULL, NULL),
(5, '2025/2026', '9 MOIS', '2025-09-01', '2026-09-01', '2021-03-08', NULL),
(6, '2026/2027', '9 MOIS', '2026-09-01', '2027-09-01', '2021-03-08', NULL),
(7, '2027/2028', '9 MOIS', '2027-09-01', '2028-09-01', '2021-03-08', NULL),
(8, '2028/2029', '9 MOIS', '2028-09-01', '2029-09-01', '2021-03-08', NULL),
(9, '2030/2031', '9 MOIS', '2030-09-01', '2031-09-01', '2021-03-08', NULL),
(10, '2032/2033', '9 MOIS', '2023-09-01', '2033-09-01', '2021-03-08', NULL),
(11, '2025/2026', '12 MOIS', '2025-09-01', '2026-09-01', '2021-03-08', NULL),
(12, '2026/2027', '12 MOIS', '2026-09-01', '2027-09-01', '2021-03-08', NULL),
(13, '2027/2028', '12 MOIS', '2027-09-01', '2028-09-01', '2021-03-08', NULL),
(14, '2028/2029', '12 MOIS', '2028-09-01', '2029-09-01', '2021-03-08', NULL),
(15, '2030/2031', '12 MOIS', '2030-09-01', '2031-09-01', '2021-03-08', NULL),
(16, '2032/2033', '12 MOIS', '2023-09-01', '2033-09-01', '2021-03-08', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recup_mp`
--

DROP TABLE IF EXISTS `recup_mp`;
CREATE TABLE IF NOT EXISTS `recup_mp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `code` int(11) NOT NULL,
  `confirme` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recup_mp`
--

INSERT INTO `recup_mp` (`id`, `email`, `code`, `confirme`) VALUES
(2, 'benoit@hotmail.fr', 93965797, NULL),
(5, 'mohamed@hotmail.fr', 96217433, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `situation_pro`
--

DROP TABLE IF EXISTS `situation_pro`;
CREATE TABLE IF NOT EXISTS `situation_pro` (
  `idsituation_pro` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(45) DEFAULT NULL,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  PRIMARY KEY (`idsituation_pro`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `situation_pro`
--

INSERT INTO `situation_pro` (`idsituation_pro`, `libelle`, `date_ajout`, `date_modification`) VALUES
(1, 'CDI', NULL, NULL),
(2, 'CDD', NULL, NULL),
(3, 'Intérimaire ', NULL, NULL),
(4, 'Demandeur d’emploi ', NULL, NULL),
(5, 'autre', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `transport`
--

DROP TABLE IF EXISTS `transport`;
CREATE TABLE IF NOT EXISTS `transport` (
  `idtransport` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_transport` varchar(45) NOT NULL,
  `date_ajout` int(11) DEFAULT NULL,
  `date_modification` int(11) DEFAULT NULL,
  PRIMARY KEY (`idtransport`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `transport`
--

INSERT INTO `transport` (`idtransport`, `libelle_transport`, `date_ajout`, `date_modification`) VALUES
(1, 'TRANSPORT EN COMMUN', NULL, NULL),
(2, 'VEHICULE', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utiliser`
--

DROP TABLE IF EXISTS `utiliser`;
CREATE TABLE IF NOT EXISTS `utiliser` (
  `id_candidat` int(11) NOT NULL,
  `idlogiciel` int(11) NOT NULL,
  `niveau_logiciel` varchar(45) NOT NULL,
  `commentaire` varchar(45) DEFAULT NULL,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  UNIQUE KEY `id_candidat` (`id_candidat`,`idlogiciel`) USING BTREE,
  KEY `idlogiciel` (`idlogiciel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utiliser`
--

INSERT INTO `utiliser` (`id_candidat`, `idlogiciel`, `niveau_logiciel`, `commentaire`, `date_ajout`, `date_modification`) VALUES
(24, 1, 'débutant', NULL, NULL, NULL),
(25, 1, 'débutant', NULL, NULL, NULL),
(65, 1, 'débutant', NULL, NULL, NULL),
(66, 1, 'confirmé', NULL, NULL, NULL),
(67, 1, 'débutant', NULL, NULL, NULL),
(68, 1, 'intermediaire', NULL, NULL, NULL),
(68, 2, 'intermediaire', NULL, NULL, NULL),
(70, 1, 'débutant', NULL, NULL, NULL),
(70, 2, 'débutant', NULL, NULL, NULL),
(72, 1, 'débutant', NULL, NULL, NULL),
(73, 1, 'débutant', NULL, NULL, NULL),
(74, 1, 'débutant', NULL, NULL, NULL),
(75, 1, 'débutant', NULL, NULL, NULL),
(76, 1, 'débutant', NULL, NULL, NULL),
(77, 1, 'débutant', NULL, NULL, NULL),
(78, 1, 'débutant', NULL, NULL, NULL),
(78, 2, 'débutant', NULL, NULL, NULL),
(79, 1, 'débutant', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vehiculer`
--

DROP TABLE IF EXISTS `vehiculer`;
CREATE TABLE IF NOT EXISTS `vehiculer` (
  `id_candi` int(11) NOT NULL,
  `id_trans` int(11) NOT NULL,
  `date_ajout` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  UNIQUE KEY `id_candi` (`id_candi`,`id_trans`) USING BTREE,
  KEY `id_trans` (`id_trans`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vehiculer`
--

INSERT INTO `vehiculer` (`id_candi`, `id_trans`, `date_ajout`, `date_modification`) VALUES
(11, 1, '2021-03-08', NULL),
(24, 1, NULL, NULL),
(24, 2, NULL, NULL),
(25, 1, NULL, NULL),
(65, 1, NULL, NULL),
(66, 1, NULL, NULL),
(67, 1, NULL, NULL),
(68, 1, NULL, NULL),
(68, 2, NULL, NULL),
(70, 1, NULL, NULL),
(70, 2, NULL, NULL),
(72, 1, NULL, NULL),
(72, 2, NULL, NULL),
(73, 1, NULL, NULL),
(74, 1, NULL, NULL),
(75, 1, NULL, NULL),
(75, 2, NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `candidat_ibfk_1` FOREIGN KEY (`id_session`) REFERENCES `periode` (`idsession`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `candidat_ibfk_2` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idformation` FOREIGN KEY (`id_formation`) REFERENCES `formation` (`idformation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idsituation_pro` FOREIGN KEY (`id_situation`) REFERENCES `situation_pro` (`idsituation_pro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `document_candidat`
--
ALTER TABLE `document_candidat`
  ADD CONSTRAINT `document_candidat_ibfk_1` FOREIGN KEY (`id_document`) REFERENCES `document` (`id_document`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `document_candidat_ibfk_2` FOREIGN KEY (`id_candidat`) REFERENCES `candidat` (`idcandidat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `dossier_etat`
--
ALTER TABLE `dossier_etat`
  ADD CONSTRAINT `dossier_etat_ibfk_1` FOREIGN KEY (`id_candidat`) REFERENCES `candidat` (`idcandidat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dossier_etat_ibfk_2` FOREIGN KEY (`id_etat`) REFERENCES `etat_dossier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `effectuer`
--
ALTER TABLE `effectuer`
  ADD CONSTRAINT `effectuer_ibfk_1` FOREIGN KEY (`id_d`) REFERENCES `divers` (`iddivers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `effectuer_ibfk_2` FOREIGN KEY (`id_c`) REFERENCES `candidat` (`idcandidat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `id_cand` FOREIGN KEY (`id_cand`) REFERENCES `candidat` (`idcandidat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_demarche` FOREIGN KEY (`id_demarche`) REFERENCES `demarche_entreprise` (`iddemarche_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `parler`
--
ALTER TABLE `parler`
  ADD CONSTRAINT `idcandidat` FOREIGN KEY (`idcandidat`) REFERENCES `candidat` (`idcandidat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idlangues` FOREIGN KEY (`idlangues`) REFERENCES `langues` (`idlangues`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utiliser`
--
ALTER TABLE `utiliser`
  ADD CONSTRAINT `id_candidat` FOREIGN KEY (`id_candidat`) REFERENCES `candidat` (`idcandidat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idlogiciel` FOREIGN KEY (`idlogiciel`) REFERENCES `logiciel` (`idlogiciel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vehiculer`
--
ALTER TABLE `vehiculer`
  ADD CONSTRAINT `id_candi` FOREIGN KEY (`id_candi`) REFERENCES `candidat` (`idcandidat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_trans` FOREIGN KEY (`id_trans`) REFERENCES `transport` (`idtransport`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

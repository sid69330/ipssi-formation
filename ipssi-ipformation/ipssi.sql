-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 25 Août 2016 à 10:16
-- Version du serveur :  5.5.50-0+deb8u1
-- Version de PHP :  5.6.24-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ipssi`
--

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_actualite`
--

CREATE TABLE IF NOT EXISTS `ipssi_actualite` (
`id_actualite` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `titre_actualite` varchar(100) NOT NULL,
  `texte_actualite` text NOT NULL,
  `date_actualite` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url_photo_actualite` varchar(250) NOT NULL,
  `date_validite_actualite` datetime DEFAULT NULL,
  `actif_actualite` tinyint(1) NOT NULL,
  `front` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_adresse`
--

CREATE TABLE IF NOT EXISTS `ipssi_adresse` (
`id_adresse` int(11) NOT NULL,
  `libelle_adresse` varchar(250) NOT NULL,
  `numero_adresse` varchar(250) NOT NULL,
  `adresse_adresse` varchar(250) NOT NULL,
  `supplement_adresse` varchar(250) DEFAULT NULL,
  `code_postal_adresse` varchar(250) NOT NULL,
  `ville_adresse` varchar(250) NOT NULL,
  `pays_adresse` varchar(250) NOT NULL,
  `telephone_adresse` varchar(250) DEFAULT NULL,
  `fax_adresse` varchar(250) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ipssi_adresse`
--

INSERT INTO `ipssi_adresse` (`id_adresse`, `libelle_adresse`, `numero_adresse`, `adresse_adresse`, `supplement_adresse`, `code_postal_adresse`, `ville_adresse`, `pays_adresse`, `telephone_adresse`, `fax_adresse`) VALUES
(1, 'IPSSI Paris', '25 ', 'rue Claude Tillier\r\n\r\n', '2ème étage', '75012 ', 'Paris', 'France', '01 55 43 26 65', '01 55 43 26 64'),
(2, 'IPSSI Lyon', '6', 'Place Charles Hernu', NULL, '69100', 'Villeurbanne', 'France', '0811 692 888', '01 55 43 26 64'),
(3, 'IPSSI Brest', '1 Bis ', 'rue Bossuet ', NULL, '29200', 'Brest', 'France', '07 81 26 13 40', '');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_candidature`
--

CREATE TABLE IF NOT EXISTS `ipssi_candidature` (
`id_candidature` int(11) NOT NULL,
  `id_poste_candidature` int(11) DEFAULT NULL,
  `id_sexe` int(11) NOT NULL,
  `nom_candidature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_candidature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse_candidature` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cp_candidature` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ville_candidature` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `pays_candidature` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email_candidature` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telephone_candidature` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_naissance` date NOT NULL,
  `url_cv_candidature` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_lettre_candidature` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  `cle` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ipssi_candidature`
--

INSERT INTO `ipssi_candidature` (`id_candidature`, `id_poste_candidature`, `id_sexe`, `nom_candidature`, `prenom_candidature`, `adresse_candidature`, `cp_candidature`, `ville_candidature`, `pays_candidature`, `email_candidature`, `telephone_candidature`, `date_naissance`, `url_cv_candidature`, `url_lettre_candidature`, `etat`, `cle`) VALUES
(1, NULL, 3, 'MOSSON', 'Romane', '16 rue des Erables', '69330', 'Pusignan', 'France', 'romane.mosson@gmail.com', '0777360290', '1993-05-07', NULL, NULL, 0, 'qJW678aziF1vqngfEZ1TUXwjSxQ8Wdg0Odm4oxU0mTY69hkborwzylm8MJop16qPo0YXSTmbC4CB38yzOPIHSFoRSRE0KTKVavgN'),
(2, 3, 3, 'MOSSON', 'Romane', '16 rue des Erables', '69330', 'Pusignan', 'France', 'romane.mosson@gmail.com', '0777360290', '1993-05-07', NULL, NULL, 0, '3buDy0s4CpuTqF7LSVCxEVAjGDMXCjK6opOxGburo870erGL5D30CVcViPYrg4qNq6OnuFILmLUlIDWHsL9HMn1t7rSlAdMXab10');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_contact`
--

CREATE TABLE IF NOT EXISTS `ipssi_contact` (
`id_contact` int(11) NOT NULL,
  `id_contact_type` int(11) NOT NULL,
  `id_contact_demande` int(11) NOT NULL,
  `id_sexe` int(11) NOT NULL,
  `nom_contact` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_contact` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `fonction_contact` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `societe_contact` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_contact` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `telephone_contact` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message_contact` text COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ipssi_contact`
--

INSERT INTO `ipssi_contact` (`id_contact`, `id_contact_type`, `id_contact_demande`, `id_sexe`, `nom_contact`, `prenom_contact`, `fonction_contact`, `societe_contact`, `email_contact`, `telephone_contact`, `message_contact`, `date_creation`) VALUES
(4, 2, 1, 3, 'MOSSON', 'Romane', NULL, '', 'romane.mosson@gmail.com', '0777360290', 'Ceci est un test', '2016-04-05 13:53:20');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_contact_demande`
--

CREATE TABLE IF NOT EXISTS `ipssi_contact_demande` (
`id_contact_demande` int(11) NOT NULL,
  `libelle_contact_demande` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ipssi_contact_demande`
--

INSERT INTO `ipssi_contact_demande` (`id_contact_demande`, `libelle_contact_demande`) VALUES
(1, 'Demande de renseignements généraux'),
(2, 'Demande de renseignements sur l''école'),
(3, 'Demande de renseignements sur les cours');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_contact_type`
--

CREATE TABLE IF NOT EXISTS `ipssi_contact_type` (
`id_contact_type` int(11) NOT NULL,
  `libelle_contact_type` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ipssi_contact_type`
--

INSERT INTO `ipssi_contact_type` (`id_contact_type`, `libelle_contact_type`) VALUES
(1, 'Professionnel'),
(2, 'Particulier');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_droit`
--

CREATE TABLE IF NOT EXISTS `ipssi_droit` (
`id_droit` int(11) NOT NULL,
  `code_droit` varchar(1) NOT NULL,
  `libelle_droit` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ipssi_droit`
--

INSERT INTO `ipssi_droit` (`id_droit`, `code_droit`, `libelle_droit`) VALUES
(1, 'T', 'Tous les droits'),
(2, 'M', 'Modification et visualisation N et N-'),
(3, 'P', 'Vue et modification personnelle'),
(4, 'V', 'Visualisation N et N-');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_droit_sous_menu_groupe`
--

CREATE TABLE IF NOT EXISTS `ipssi_droit_sous_menu_groupe` (
  `id_droit` int(11) NOT NULL,
  `id_sous_menu` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ipssi_droit_sous_menu_groupe`
--

INSERT INTO `ipssi_droit_sous_menu_groupe` (`id_droit`, `id_sous_menu`, `id_groupe`) VALUES
(1, 8, 1),
(1, 8, 2),
(1, 8, 6),
(4, 8, 3),
(4, 8, 4),
(1, 9, 1),
(1, 9, 2),
(1, 9, 4),
(2, 9, 3),
(3, 9, 5),
(1, 10, 1),
(1, 10, 2),
(1, 10, 4),
(3, 10, 3),
(3, 10, 5),
(1, 11, 1),
(1, 11, 2),
(1, 11, 4),
(2, 11, 3),
(3, 11, 5),
(1, 12, 1),
(1, 12, 2),
(1, 12, 4),
(2, 12, 3),
(1, 13, 1),
(1, 13, 2),
(1, 13, 4),
(4, 13, 3),
(1, 14, 1),
(1, 14, 2),
(1, 14, 4),
(2, 14, 3),
(1, 15, 1),
(1, 15, 2),
(1, 15, 4),
(4, 15, 3),
(1, 16, 1),
(1, 16, 2),
(2, 16, 6),
(4, 16, 3),
(1, 17, 1),
(1, 17, 2),
(2, 17, 6),
(4, 17, 3),
(1, 18, 1),
(1, 18, 2),
(1, 19, 1),
(1, 19, 2),
(1, 20, 1),
(4, 20, 2),
(1, 21, 1),
(4, 21, 2),
(1, 22, 1),
(1, 22, 2),
(1, 22, 6);

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_groupe`
--

CREATE TABLE IF NOT EXISTS `ipssi_groupe` (
`id_groupe` int(11) NOT NULL,
  `libelle_groupe` varchar(100) NOT NULL,
  `ordre` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ipssi_groupe`
--

INSERT INTO `ipssi_groupe` (`id_groupe`, `libelle_groupe`, `ordre`) VALUES
(1, 'Administrateur', 6),
(2, 'Superviseur', 5),
(3, 'Manager', 4),
(4, 'RH', 3),
(5, 'Collaborateur', 2),
(6, 'Rédacteur', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_groupe_utilisateur`
--

CREATE TABLE IF NOT EXISTS `ipssi_groupe_utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ipssi_groupe_utilisateur`
--

INSERT INTO `ipssi_groupe_utilisateur` (`id_utilisateur`, `id_groupe`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_menu`
--

CREATE TABLE IF NOT EXISTS `ipssi_menu` (
`id_menu` int(11) NOT NULL,
  `libelle_menu` varchar(100) NOT NULL,
  `url_menu` varchar(100) NOT NULL,
  `tri_menu` int(11) NOT NULL,
  `date_menu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `front` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ipssi_menu`
--

INSERT INTO `ipssi_menu` (`id_menu`, `libelle_menu`, `url_menu`, `tri_menu`, `date_menu`, `front`) VALUES
(1, 'Accueil', 'accueil', 1, '2016-02-29 08:25:10', 1),
(2, 'Le groupe', 'le-groupe', 2, '2016-02-29 07:27:42', 1),
(3, 'L''activité', 'l-activite', 3, '2016-02-29 07:27:53', 1),
(4, 'Actualités', 'actualites', 1, '2016-07-08 08:01:04', 0),
(5, 'Ressources humaines', 'ressources-humaines', 2, '2016-07-08 08:02:11', 0),
(6, 'Boîte à outils', 'boite-a-outils', 3, '2016-07-08 08:02:11', 0),
(7, 'Paramétrage', 'parametrage', 4, '2016-07-08 08:02:49', 0),
(8, 'Administration', 'administration', 5, '2016-07-08 08:02:49', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_page_contenu`
--

CREATE TABLE IF NOT EXISTS `ipssi_page_contenu` (
`id_page_contenu` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL COMMENT 'clé étrangère',
  `id_sous_menu` int(11) DEFAULT NULL COMMENT 'clé étrangère',
  `date_page_contenu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titre_page_contenu` varchar(100) NOT NULL,
  `texte_page_contenu` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ipssi_page_contenu`
--

INSERT INTO `ipssi_page_contenu` (`id_page_contenu`, `id_menu`, `id_sous_menu`, `date_page_contenu`, `titre_page_contenu`, `texte_page_contenu`) VALUES
(1, 2, 1, '2016-02-29 10:03:04', 'test titre', 'test contenu');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_poste_candidature`
--

CREATE TABLE IF NOT EXISTS `ipssi_poste_candidature` (
`id_poste` int(11) NOT NULL,
  `id_type_poste` int(11) NOT NULL,
  `titre_poste` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `accroche_poste` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `entreprise_poste` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_depot` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_debut_poste` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remuneration_poste` varchar(50) DEFAULT NULL,
  `niveau_experience` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ipssi_poste_candidature`
--

INSERT INTO `ipssi_poste_candidature` (`id_poste`, `id_type_poste`, `titre_poste`, `accroche_poste`, `entreprise_poste`, `date_depot`, `description`, `date_debut_poste`, `remuneration_poste`, `niveau_experience`) VALUES
(1, 1, 'Développeur PHP', 'Développeur PHP en alternance', 'Dalkia Infracom', '2015-05-29 10:34:57', 'Recherche d''un développeur spécialisé en PHP. \r\nnécessaire : HTML, PHP, CSS, Javascript\r\nplus : Ajax, Bootstrap', '2014-10-18 20:00:00', '820', 'BAc+2 à Bac+3'),
(2, 3, 'Développeur VB.Net', 'Développeur Microsoft VisualBasic en alternance', 'Exelis', '2015-05-29 10:35:07', 'Recherche d''un développeur spécialisé en VisualBasic. \nnécessaire : VB.Net, SQL Server\nplus : SSIS', '2014-11-11 22:00:00', '920', 'BAc+2 à Bac+3'),
(3, 4, 'Administrateur Base de Données', 'Administrateur base de données sur SQL Server', '1000Mercis', '2015-05-29 10:38:47', 'Nous cherchons actuellement un alternant pour un poste d''administrateur de base de données.\r\nRequis : SQL, SQL Server\r\nplus : C#, SSIS', '2013-09-07 20:00:00', '850', 'BAc+4');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_sexe`
--

CREATE TABLE IF NOT EXISTS `ipssi_sexe` (
`id_sexe` int(11) NOT NULL,
  `raccourci_sexe` varchar(4) NOT NULL,
  `sexe` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ipssi_sexe`
--

INSERT INTO `ipssi_sexe` (`id_sexe`, `raccourci_sexe`, `sexe`) VALUES
(1, 'M.', 'Monsieur'),
(2, 'Mme', 'Madame'),
(3, 'Mlle', 'Mademoiselle');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_sous_menu`
--

CREATE TABLE IF NOT EXISTS `ipssi_sous_menu` (
`id_sous_menu` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL COMMENT 'clé étrangère',
  `libelle_sous_menu` varchar(100) NOT NULL,
  `url_sous_menu` varchar(100) NOT NULL,
  `date_sous_menu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tri_sous_menu` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ipssi_sous_menu`
--

INSERT INTO `ipssi_sous_menu` (`id_sous_menu`, `id_menu`, `libelle_sous_menu`, `url_sous_menu`, `date_sous_menu`, `tri_sous_menu`) VALUES
(1, 2, 'Présentation', 'presentation', '2016-02-29 07:39:57', 1),
(2, 2, 'Chiffres clés', 'chiffres-cles', '2016-02-29 07:40:13', 2),
(3, 2, 'Notre expertise', 'notre-expertise', '2016-02-29 07:40:23', 3),
(4, 2, 'Les valeurs du groupe', 'les-valeurs-du-groupe', '2016-02-29 07:40:43', 4),
(5, 3, 'Nos métiers', 'nos-metiers', '2016-02-29 07:51:06', 1),
(6, 3, 'Nos secteurs d''activités', 'nos-secteurs-d-activites', '2016-02-29 07:51:29', 2),
(7, 3, 'Ils nous font confiance', 'ils-nous-font-confiance', '2016-02-29 07:51:56', 3),
(8, 4, 'Liste des actualités', 'gestion-actualites', '2016-07-08 08:04:00', 1),
(9, 5, 'CRA', 'cra', '2016-07-08 08:04:19', 1),
(10, 5, 'Notes de frais', 'note-frais', '2016-07-08 08:04:33', 2),
(11, 5, 'Demande de congés', 'demande-conges', '2016-07-08 08:04:54', 3),
(12, 5, 'CVthèque', 'cvtheque', '2016-07-08 08:05:32', 4),
(13, 5, 'Offre de poste', 'offre-poste', '2016-07-08 08:05:52', 5),
(14, 5, 'Candidatures', 'candidatures', '2016-07-08 08:06:07', 6),
(15, 5, 'Collaborateurs', 'collaborateurs', '2016-07-08 08:06:21', 7),
(16, 6, 'Certifications', 'certifications', '2016-07-08 08:06:35', 1),
(17, 6, 'Documents de travail', 'documents-travail', '2016-07-08 08:06:53', 2),
(18, 7, 'RH', 'rh', '2016-07-08 08:07:02', 1),
(19, 7, 'CRM', 'crm', '2016-07-08 08:07:10', 2),
(20, 8, 'Gestion des utilisateurs', 'gestion-utilisateurs', '2016-07-08 08:07:30', 1),
(21, 8, 'Application', 'application', '2016-07-08 08:07:45', 2),
(22, 8, 'Rédaction des pages', 'redaction-pages', '2016-07-08 09:20:20', 3);

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_sous_sous_menu`
--

CREATE TABLE IF NOT EXISTS `ipssi_sous_sous_menu` (
`id_sous_sous_menu` int(11) NOT NULL,
  `id_sous_menu` int(11) NOT NULL COMMENT 'clé étrangère',
  `libelle_sous_sous_menu` varchar(100) NOT NULL,
  `ancrage` varchar(100) NOT NULL,
  `date_sous_sous_menu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tri_sous_sous_menu` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ipssi_sous_sous_menu`
--

INSERT INTO `ipssi_sous_sous_menu` (`id_sous_sous_menu`, `id_sous_menu`, `libelle_sous_sous_menu`, `ancrage`, `date_sous_sous_menu`, `tri_sous_sous_menu`) VALUES
(1, 3, 'Présentation des expertises', '', '2016-02-29 09:39:45', 1),
(2, 3, 'Assistance technique', '', '2016-02-29 09:41:18', 2),
(3, 3, 'Formation', '', '2016-02-29 09:41:30', 3),
(4, 3, 'Forfait', '', '2016-02-29 09:41:42', 4),
(5, 6, 'Présentation des secteurs', '', '2016-02-29 09:42:03', 1),
(6, 6, 'Energie', '', '2016-02-29 09:42:14', 2),
(7, 6, 'Défense', '', '2016-02-29 09:42:24', 3),
(8, 6, 'Chimie, Pétrochimie, Pharmacie', '', '2016-02-29 09:42:47', 4),
(9, 6, 'Industrie lourde', '', '2016-02-29 09:43:02', 5),
(10, 6, 'Transports', '', '2016-02-29 09:43:14', 6);

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_type_poste`
--

CREATE TABLE IF NOT EXISTS `ipssi_type_poste` (
`id_type_poste` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ipssi_type_poste`
--

INSERT INTO `ipssi_type_poste` (`id_type_poste`, `libelle`) VALUES
(1, 'CDI'),
(2, 'CDD'),
(3, 'Contrat d''alternance'),
(4, 'Contrat de professionalisation'),
(5, 'Intérim');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_utilisateur`
--

CREATE TABLE IF NOT EXISTS `ipssi_utilisateur` (
`id_utilisateur` int(11) NOT NULL,
  `id_sexe` int(11) NOT NULL COMMENT 'clé étrangère',
  `nom_utilisateur` varchar(50) NOT NULL,
  `prenom_utilisateur` varchar(50) NOT NULL,
  `mail_utilisateur` varchar(200) NOT NULL,
  `telephone_utilisateur` varchar(20) NOT NULL,
  `mdp_utilisateur` varchar(150) NOT NULL,
  `date_mdp_utilisateur` datetime DEFAULT NULL,
  `mdp_utilisateur_change` tinyint(1) NOT NULL DEFAULT '1',
  `entreprise_utilisateur` varchar(100) NOT NULL,
  `photo_profil` varchar(255) DEFAULT NULL,
  `supprime` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ipssi_utilisateur`
--

INSERT INTO `ipssi_utilisateur` (`id_utilisateur`, `id_sexe`, `nom_utilisateur`, `prenom_utilisateur`, `mail_utilisateur`, `telephone_utilisateur`, `mdp_utilisateur`, `date_mdp_utilisateur`, `mdp_utilisateur_change`, `entreprise_utilisateur`, `photo_profil`, `supprime`) VALUES
(1, 3, 'MOSSON', 'Romane', 'romane.mosson@gmail.com', '0777360290', '627d93c4da0370051dbfd30039edae208fedd0bf70a43707237a26087d3e164a', '2016-08-24 14:31:56', 0, 'EXELIS', NULL, 0),
(2, 1, 'JULIEN', 'Alexandre', 'alexandre.julien.91@gmail.com', '0676799437', '0b6d666907634a18c00d4c71b854ffeded6d636f8b0f1eb348eb7e2dd974e8c6', '2016-08-02 14:08:51', 0, 'Dalkia', 'photo-de-profil-de-julien-alexandre-1470231068.jpg', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ipssi_actualite`
--
ALTER TABLE `ipssi_actualite`
 ADD PRIMARY KEY (`id_actualite`), ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `ipssi_adresse`
--
ALTER TABLE `ipssi_adresse`
 ADD PRIMARY KEY (`id_adresse`);

--
-- Index pour la table `ipssi_candidature`
--
ALTER TABLE `ipssi_candidature`
 ADD PRIMARY KEY (`id_candidature`), ADD KEY `id_poste_candidature` (`id_poste_candidature`), ADD KEY `id_sexe` (`id_sexe`);

--
-- Index pour la table `ipssi_contact`
--
ALTER TABLE `ipssi_contact`
 ADD PRIMARY KEY (`id_contact`), ADD KEY `id_type_contact` (`id_contact_type`), ADD KEY `id_type_demande` (`id_contact_demande`), ADD KEY `id_sexe` (`id_sexe`), ADD KEY `id_contact_type` (`id_contact_type`), ADD KEY `id_contact_demande` (`id_contact_demande`), ADD KEY `id_sexe_2` (`id_sexe`);

--
-- Index pour la table `ipssi_contact_demande`
--
ALTER TABLE `ipssi_contact_demande`
 ADD PRIMARY KEY (`id_contact_demande`), ADD KEY `id_contact_demande` (`id_contact_demande`);

--
-- Index pour la table `ipssi_contact_type`
--
ALTER TABLE `ipssi_contact_type`
 ADD PRIMARY KEY (`id_contact_type`), ADD KEY `id_contact_type` (`id_contact_type`);

--
-- Index pour la table `ipssi_droit`
--
ALTER TABLE `ipssi_droit`
 ADD PRIMARY KEY (`id_droit`);

--
-- Index pour la table `ipssi_droit_sous_menu_groupe`
--
ALTER TABLE `ipssi_droit_sous_menu_groupe`
 ADD PRIMARY KEY (`id_droit`,`id_sous_menu`,`id_groupe`), ADD KEY `id_sous_menu` (`id_sous_menu`), ADD KEY `id_groupe` (`id_groupe`);

--
-- Index pour la table `ipssi_groupe`
--
ALTER TABLE `ipssi_groupe`
 ADD PRIMARY KEY (`id_groupe`);

--
-- Index pour la table `ipssi_groupe_utilisateur`
--
ALTER TABLE `ipssi_groupe_utilisateur`
 ADD PRIMARY KEY (`id_utilisateur`,`id_groupe`), ADD KEY `id_groupe` (`id_groupe`);

--
-- Index pour la table `ipssi_menu`
--
ALTER TABLE `ipssi_menu`
 ADD PRIMARY KEY (`id_menu`);

--
-- Index pour la table `ipssi_page_contenu`
--
ALTER TABLE `ipssi_page_contenu`
 ADD PRIMARY KEY (`id_page_contenu`), ADD KEY `id_menu` (`id_menu`), ADD KEY `id_sous_menu` (`id_sous_menu`);

--
-- Index pour la table `ipssi_poste_candidature`
--
ALTER TABLE `ipssi_poste_candidature`
 ADD PRIMARY KEY (`id_poste`), ADD KEY `id_type_poste` (`id_type_poste`), ADD KEY `id_poste` (`id_poste`), ADD KEY `id_type_poste_2` (`id_type_poste`);

--
-- Index pour la table `ipssi_sexe`
--
ALTER TABLE `ipssi_sexe`
 ADD PRIMARY KEY (`id_sexe`), ADD KEY `id_sexe` (`id_sexe`);

--
-- Index pour la table `ipssi_sous_menu`
--
ALTER TABLE `ipssi_sous_menu`
 ADD PRIMARY KEY (`id_sous_menu`), ADD KEY `id_menu` (`id_menu`);

--
-- Index pour la table `ipssi_sous_sous_menu`
--
ALTER TABLE `ipssi_sous_sous_menu`
 ADD PRIMARY KEY (`id_sous_sous_menu`), ADD KEY `id_sous_menu` (`id_sous_menu`);

--
-- Index pour la table `ipssi_type_poste`
--
ALTER TABLE `ipssi_type_poste`
 ADD PRIMARY KEY (`id_type_poste`), ADD KEY `id_type_poste` (`id_type_poste`);

--
-- Index pour la table `ipssi_utilisateur`
--
ALTER TABLE `ipssi_utilisateur`
 ADD PRIMARY KEY (`id_utilisateur`), ADD UNIQUE KEY `mail_utilisateur` (`mail_utilisateur`), ADD KEY `id_sexe` (`id_sexe`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ipssi_actualite`
--
ALTER TABLE `ipssi_actualite`
MODIFY `id_actualite` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `ipssi_adresse`
--
ALTER TABLE `ipssi_adresse`
MODIFY `id_adresse` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `ipssi_candidature`
--
ALTER TABLE `ipssi_candidature`
MODIFY `id_candidature` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `ipssi_contact`
--
ALTER TABLE `ipssi_contact`
MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `ipssi_contact_demande`
--
ALTER TABLE `ipssi_contact_demande`
MODIFY `id_contact_demande` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `ipssi_contact_type`
--
ALTER TABLE `ipssi_contact_type`
MODIFY `id_contact_type` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `ipssi_droit`
--
ALTER TABLE `ipssi_droit`
MODIFY `id_droit` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `ipssi_groupe`
--
ALTER TABLE `ipssi_groupe`
MODIFY `id_groupe` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `ipssi_menu`
--
ALTER TABLE `ipssi_menu`
MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `ipssi_page_contenu`
--
ALTER TABLE `ipssi_page_contenu`
MODIFY `id_page_contenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `ipssi_poste_candidature`
--
ALTER TABLE `ipssi_poste_candidature`
MODIFY `id_poste` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `ipssi_sexe`
--
ALTER TABLE `ipssi_sexe`
MODIFY `id_sexe` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `ipssi_sous_menu`
--
ALTER TABLE `ipssi_sous_menu`
MODIFY `id_sous_menu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `ipssi_sous_sous_menu`
--
ALTER TABLE `ipssi_sous_sous_menu`
MODIFY `id_sous_sous_menu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `ipssi_type_poste`
--
ALTER TABLE `ipssi_type_poste`
MODIFY `id_type_poste` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `ipssi_utilisateur`
--
ALTER TABLE `ipssi_utilisateur`
MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ipssi_contact`
--
ALTER TABLE `ipssi_contact`
ADD CONSTRAINT `ipssi_contact_ibfk_1` FOREIGN KEY (`id_contact_type`) REFERENCES `ipssi_contact_type` (`id_contact_type`),
ADD CONSTRAINT `ipssi_contact_ibfk_2` FOREIGN KEY (`id_contact_demande`) REFERENCES `ipssi_contact_demande` (`id_contact_demande`),
ADD CONSTRAINT `ipssi_contact_ibfk_3` FOREIGN KEY (`id_sexe`) REFERENCES `ipssi_sexe` (`id_sexe`);

--
-- Contraintes pour la table `ipssi_droit_sous_menu_groupe`
--
ALTER TABLE `ipssi_droit_sous_menu_groupe`
ADD CONSTRAINT `ipssi_droit_sous_menu_groupe_ibfk_1` FOREIGN KEY (`id_droit`) REFERENCES `ipssi_droit` (`id_droit`),
ADD CONSTRAINT `ipssi_droit_sous_menu_groupe_ibfk_2` FOREIGN KEY (`id_sous_menu`) REFERENCES `ipssi_sous_menu` (`id_sous_menu`),
ADD CONSTRAINT `ipssi_droit_sous_menu_groupe_ibfk_3` FOREIGN KEY (`id_groupe`) REFERENCES `ipssi_groupe` (`id_groupe`);

--
-- Contraintes pour la table `ipssi_groupe_utilisateur`
--
ALTER TABLE `ipssi_groupe_utilisateur`
ADD CONSTRAINT `ipssi_groupe_utilisateur_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `ipssi_utilisateur` (`id_utilisateur`),
ADD CONSTRAINT `ipssi_groupe_utilisateur_ibfk_2` FOREIGN KEY (`id_groupe`) REFERENCES `ipssi_groupe` (`id_groupe`);

--
-- Contraintes pour la table `ipssi_page_contenu`
--
ALTER TABLE `ipssi_page_contenu`
ADD CONSTRAINT `ipssi_page_contenu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `ipssi_menu` (`id_menu`),
ADD CONSTRAINT `ipssi_page_contenu_ibfk_2` FOREIGN KEY (`id_sous_menu`) REFERENCES `ipssi_sous_menu` (`id_sous_menu`);

--
-- Contraintes pour la table `ipssi_poste_candidature`
--
ALTER TABLE `ipssi_poste_candidature`
ADD CONSTRAINT `ipssi_poste_candidature_ibfk_1` FOREIGN KEY (`id_type_poste`) REFERENCES `ipssi_type_poste` (`id_type_poste`);

--
-- Contraintes pour la table `ipssi_sous_menu`
--
ALTER TABLE `ipssi_sous_menu`
ADD CONSTRAINT `ipssi_sous_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `ipssi_menu` (`id_menu`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `ipssi_sous_sous_menu`
--
ALTER TABLE `ipssi_sous_sous_menu`
ADD CONSTRAINT `ipssi_sous_sous_menu_ibfk_1` FOREIGN KEY (`id_sous_menu`) REFERENCES `ipssi_sous_menu` (`id_sous_menu`);

--
-- Contraintes pour la table `ipssi_utilisateur`
--
ALTER TABLE `ipssi_utilisateur`
ADD CONSTRAINT `ipssi_utilisateur_ibfk_1` FOREIGN KEY (`id_sexe`) REFERENCES `ipssi_sexe` (`id_sexe`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

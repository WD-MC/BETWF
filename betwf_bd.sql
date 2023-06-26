-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  sam. 24 juin 2023 à 12:29
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `betwf_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `cv`
--

DROP TABLE IF EXISTS `cv`;
CREATE TABLE IF NOT EXISTS `cv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parcours` varchar(200) NOT NULL,
  `domaineExpertise` varchar(200) NOT NULL,
  `domaineRecherché` varchar(200) NOT NULL,
  `ville` varchar(200) NOT NULL,
  `langue` varchar(200) NOT NULL,
  `cv_porfolio` varchar(200) NOT NULL,
  `url1` varchar(200) NOT NULL,
  `url2` varchar(200) NOT NULL,
  `url3` varchar(200) NOT NULL,
  `autreFichier` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CV_USERS` (`id_etudiant`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

DROP TABLE IF EXISTS `offres`;
CREATE TABLE IF NOT EXISTS `offres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titreOffre` varchar(100) NOT NULL,
  `nomStructure` varchar(100) NOT NULL,
  `lieu` varchar(100) NOT NULL,
  `typePoste` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `modeTravail` varchar(100) NOT NULL,
  `typeTravail` varchar(100) NOT NULL,
  `descriptions` text NOT NULL,
  `dateLimite` date NOT NULL,
  `competences` varchar(200) NOT NULL,
  `parcours` varchar(100) NOT NULL,
  `imageJob` varchar(200) NOT NULL,
  `messageConfirm` varchar(200) NOT NULL,
  `dateSauvegarde` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_admin` int(11) NOT NULL,
  `is_delete` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_OFRES_USERS` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `offres`
--

INSERT INTO `offres` (`id`, `titreOffre`, `nomStructure`, `lieu`, `typePoste`, `modeTravail`, `typeTravail`, `descriptions`, `dateLimite`, `competences`, `parcours`, `imageJob`, `messageConfirm`, `dateSauvegarde`, `id_admin`, `is_delete`) VALUES
(1, 'Développeur Front end ', 'GroupAgora', 'Yaoundé', 'CDI', 'Présentiel', 'Temps Plein', 'Entreprise en pleine croissance spécialisée dans les technologies de l\'éducation , Elle propose des campus numérique et des formations pour adultes.', '2023-05-24', 'Langages : Javascript, PHP, HTML5, CSS, Bootstrap, SQL, Javascript frameworks\r\nBases de données : MySQL, Postgres(souhaité),\r\nSystèmes d’exploitation : Linux ubuntu\r\nExpertise en construction de pages', 'developpement_web', '', 'vous avez été retenu. Ecrivez à l\'adresse  exemple@gmail.com ', '2023-05-09 11:14:00', 2, 0),
(2, 'Data science', 'UX-KEY ', 'Douala', 'CDD', 'Présentiel', 'Temps Plein', ' Société d\'édition de logiciel spécialisée dans l\'analyse automatique du comportement des utilisateurs sur les logiciels SaaS.', '2023-06-10', 'Adapter les outils de traitement statistique de donnéesCette compétence est indispensable\r\nAnalyses statistiquesCette compétence est indispensable.\r\nDéfinir et faire évoluer des procédés de traitement', 'data_science', '', 'Contactez le numéro 678968506 avant le 17/06/2023.', '2023-05-09 11:23:06', 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `souscriptions`
--

DROP TABLE IF EXISTS `souscriptions`;
CREATE TABLE IF NOT EXISTS `souscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_offre` int(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  `responseMessage` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_SOUSCRIPTIONS_OFFRES` (`id_offre`),
  KEY `FK_SOUSCRIPTION_USERS` (`id_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(191) NOT NULL,
  `nom` varchar(191) NOT NULL,
  `prenom` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mdpasse` varchar(191) NOT NULL,
  `imgProfile` varchar(191) NOT NULL,
  `adresse` varchar(191) NOT NULL,
  `rol` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `nom`, `prenom`, `email`, `phone`, `mdpasse`, `imgProfile`, `adresse`, `rol`) VALUES
(1, 'MC', 'Wagsong', 'michele', '18P231@polytechnique.cm', '693761773', 'ab4f63f9ac65152575886860dde480a1', '', 'Yaoundé', 0),
(2, 'wdmc', 'Wagsong', '', 'michelewagsong913@gmail.com', '693509351', '755c41988f8b530034c7803c26f44796', '', '', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `FK_CV_USERS` FOREIGN KEY (`id_etudiant`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `offres`
--
ALTER TABLE `offres`
  ADD CONSTRAINT `FK_OFRES_USERS` FOREIGN KEY (`id_admin`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `souscriptions`
--
ALTER TABLE `souscriptions`
  ADD CONSTRAINT `FK_SOUSCRIPTIONS_OFFRES` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_SOUSCRIPTION_USERS` FOREIGN KEY (`id_etudiant`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

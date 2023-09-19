-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 19 sep. 2023 à 09:47
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cadex_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `labelDesc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorie_id` bigint(20) UNSIGNED NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `title`, `description`, `photo`, `status`, `created_at`, `updated_at`, `labelDesc`, `categorie_id`, `priority`) VALUES
(6, 1, 'Décryptage d’un texte de droit de régulation économique', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\">A propos du règlement n° 05/19-UEAC-010 A-CM-33 du 8 avril 2019 portant révision du Code des douanes de la Communauté </p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Economique et Monétaire de l’Afrique Centrale, Revue des douanes &amp; changes en Afrique Centrale, 1 ère édition. </p><p class=\"ql-align-justify\">Le tarif des douanes de la CEMAC à l’aune du Système harmonisé de désignation et de codification des marchandises 2022, Revue des douanes &amp; changes en Afrique Centrale, 1 ère édition.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Quelques considérations sur le Point « E »&nbsp;du Communiqué Final de la soixantième session ordinaire de la Conférence des Chefs d’Etats et de Gouvernement de la&nbsp;Communauté Economique des Etats de L’Afrique de l’Ouest (CEDEAO) tenue le 12 décembre 2021, Revue des douanes &amp; changes en Afrique Centrale, 1 ère édition.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">«&nbsp;Le renouveau des règles sur le change en CEMAC&nbsp;: essai de présentation synthétique » in Bilan de l’intégration en Afrique centrale. Exposé présenté lors de la commémoration de la journée de l’intégration en Afrique centrale (CEEAC) en octobre 2020</p><p><br></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', 'phpE25D.tmp.png', '1', '2023-09-11 08:12:52', '2023-09-11 08:12:52', 'Décryptage d’un texte de droit de régulation économique', 2, 1),
(7, 1, 'Retour sur une institution particulière en matière douanière dans la CEMAC', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\">« Retour sur une institution particulière en matière douanière dans la CEMAC : le marquage de l’origine » publié sur LinkedIn <a href=\"https://www.linkedin.com/in/adolphe-mballa-keumbou-138384b2/\" target=\"_blank\" style=\"color: rgb(5, 99, 193);\">https://www.linkedin.com/in/adolphe-mballa-keumbou-138384b2/</a> le 10 septembre 2019</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">« Regard sur le nouveau visage du code des douanes de la CEMAC » publié sur LinkedIn <a href=\"https://www.linkedin.com/in/adolphe-mballa-keumbou-138384b2/\" target=\"_blank\" style=\"color: rgb(5, 99, 193);\">https://www.linkedin.com/in/adolphe-mballa-keumbou-138384b2/</a> &nbsp;le 10 janvier 2020</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">« Etude sur les délais dans le contentieux civil douanier en zone CEMAC : Commentaires des articles 330, 331, 332 et 333 du code des douanes CEMAC » publié sur mon réseau LinkedIn <a href=\"https://www.linkedin.com/in/adolphe-mballa-keumbou-138384b2/\" target=\"_blank\" style=\"color: rgb(5, 99, 193);\">https://www.linkedin.com/in/adolphe-mballa-keumbou-138384b2/</a> le 20 juillet 2015</p><p><br></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', 'phpEF79.tmp.png', '1', '2023-09-11 08:13:59', '2023-09-11 08:13:59', 'Retour sur une institution particulière en matière douanière dans la CEMAC', 2, 1),
(8, 1, 'Séminaire de formation sur le Nouveau Code Revisé des Douanes en zone CEMAC', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\">Un séminaire sous régional sur le thème «&nbsp;Le Code révisé des douanes CEMAC et les nouveaux enjeux commerciaux et douaniers en Afrique centrale: défis, opportunités et contraintes pour les entreprises privées, administrations publiques et autres acteurs économiques&nbsp;». Ledit évènement a d’ailleurs vu la participation de la CEMAC en qualité d’expert institutionnel.</p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', 'phpFFDF.tmp.jpg', '1', '2023-09-19 05:22:43', '2023-09-19 05:35:47', 'Séminaire de formation', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `articles_service`
--

CREATE TABLE `articles_service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `articles_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles_service`
--

INSERT INTO `articles_service` (`id`, `articles_id`, `service_id`, `created_at`, `updated_at`) VALUES
(13, 6, 10, NULL, NULL),
(14, 7, 10, NULL, NULL),
(15, 8, 11, NULL, NULL),
(16, 8, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `article_service`
--

CREATE TABLE `article_service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `bannieres`
--

CREATE TABLE `bannieres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `labelDesc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bannieres`
--

INSERT INTO `bannieres` (`id`, `user_id`, `title`, `description`, `type`, `photo`, `labelDesc`, `created_at`, `updated_at`) VALUES
(8, 1, 'Recherches et promotion du commerce extérieur en Afrique', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\">Le CADEX Afrique en tant que «&nbsp;Centre de Recherches et de Promotion du Commerce Extérieur en Afrique&nbsp;», située au 78360 Montesson (France) avec des sections opérationnelles disséminées un peu partout dans les quatre coins du monde dont Douala pour l’Afrique Centrale, Nairobi pour l’Afrique de l’Est, Paris pour l’Europe occidentale et New York pour l’Amérique du Nord, &nbsp;a pour but ultime d’œuvrer à l’appropriation constante et qualitative des réglementations communautaires essentielles au développement du commerce extérieur des Etats membres dans la CEMAC en particulier, et en Afrique en général.&nbsp;</p><p><br></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '1', 'phpE5FE.tmp.jpg', 'Recherches et promotion du commerce extérieur en Afrique', '2023-09-19 04:33:25', '2023-09-19 04:33:25'),
(9, 1, 'CADEX, le partenaire de confiance des institutions et administrations dans l’atteinte de leurs objectifs de développement et de compétitivité du commerce extérieur', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\"><span style=\"color: black;\">Partenaire&nbsp;: INTELLIS Agent de vente officiel des publications de l’Organisation Mondiale des Douanes + logo&nbsp;</span></p><p class=\"ql-align-justify\"><span style=\"color: black;\">Visuel&nbsp;: images relatives au commerce extérieur, aux institutions et aux administrations&nbsp;</span></p><p class=\"ql-align-justify\"><br></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '1', 'php1562.tmp.jpeg', 'CADEX, le partenaire de confiance des institutions et administrations', '2023-09-19 04:35:49', '2023-09-19 04:38:00');

-- --------------------------------------------------------

--
-- Structure de la table `categoriesolutions`
--

CREATE TABLE `categoriesolutions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categoriesolutions`
--

INSERT INTO `categoriesolutions` (`id`, `name`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Formation', '2022-06-18 08:36:23', '2022-06-18 08:36:23', 1),
(2, 'Entreprise', '2022-06-18 08:43:53', '2022-06-18 08:43:53', 1),
(3, 'Académique', '2022-06-18 08:44:14', '2022-06-18 08:44:14', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie_articles`
--

CREATE TABLE `categorie_articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie_articles`
--

INSERT INTO `categorie_articles` (`id`, `name`, `created_at`, `updated_at`, `user_id`) VALUES
(2, 'Communautés et marchés', '2022-06-18 04:23:49', '2022-06-18 04:23:49', 1),
(3, 'Culture et diversités africaine', '2022-06-18 04:24:06', '2022-06-18 04:24:06', 1),
(4, 'Nos activités au quotidien', '2022-06-18 04:24:34', '2022-06-18 04:24:34', 1),
(5, 'Industries et productions', '2022-06-18 04:24:51', '2022-06-18 04:24:51', 1),
(6, 'Réseaux sociaux et divers', '2022-06-18 04:25:12', '2022-06-18 04:25:12', 1),
(7, 'A la une de l\'économie', '2022-06-18 04:25:30', '2022-06-18 04:25:30', 1);

-- --------------------------------------------------------

--
-- Structure de la table `chatbootmessage`
--

CREATE TABLE `chatbootmessage` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` bigint(20) UNSIGNED DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rep_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_resp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message_rep` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_read` int(11) NOT NULL DEFAULT 0,
  `customer_read` int(11) NOT NULL DEFAULT 0,
  `client_rep` int(11) NOT NULL DEFAULT 0,
  `customer_rep` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clientaccount`
--

CREATE TABLE `clientaccount` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` datetime NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` bigint(20) NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_compte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sous_secteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_cni_recto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_cni_verso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_localisation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numerique_signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type_account` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `infos_bannieres`
--

CREATE TABLE `infos_bannieres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `banniere_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `infos_bannieres`
--

INSERT INTO `infos_bannieres` (`id`, `user_id`, `banniere_id`, `title`, `description`, `cover`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 7, 'ff', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p>Hallo</p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', 'php6DC9.tmp.jpg', 1, '2023-07-08 09:56:52', '2023-07-08 09:56:52');

-- --------------------------------------------------------

--
-- Structure de la table `infos_entreprises`
--

CREATE TABLE `infos_entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contexte` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `mission` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `vision` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectifs` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse1` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse2` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse3` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mapLink` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freetext1` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freetext2` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `infos_entreprises`
--

INSERT INTO `infos_entreprises` (`id`, `user_id`, `name`, `contexte`, `activity`, `mission`, `vision`, `objectifs`, `adresse1`, `adresse2`, `adresse3`, `telephone1`, `telephone2`, `telephone3`, `mapLink`, `logo`, `cover`, `status`, `created_at`, `updated_at`, `email1`, `email2`, `freetext1`, `freetext2`) VALUES
(1, 1, 'CADEX', 'Centre de Recherches et de Promotion du Commerce Extérieur en Afrique', 'FORMATION', 'TEST', 'Le Centre de Recherches et de Promotion du Commerce Extérieur en Afrique (CADEX) est un « think thank » indépendant reconnu sous le N°W783012206, dont les activités sont essentiellement tournées vers les travaux en matière douanières et des changes ainsi que d’autres réglementations du commerce extérieur dans les Etats et regroupements d’Etats africains.', 'Effectuer des travaux de recherches et d’analyses en vue de promouvoir le commerce extérieur en Afrique ;\r\nAppuyer les acteurs économiques dans l’appropriation et la mise en œuvre bénéfiques des règles du commerce extérieur en Afrique ;\r\nDonner des avis et opinions juridiques sur les grandes questions sur le commerce extérieur sur l’Afrique ;\r\nParticiper et animer des conférences et séminaire de haut niveau sur les thématiques douanières et des changes en Afrique ;\r\nConstituer et mettre à disposition un fonds documentaire sur le commerce extérieur, les douanes et changes en Afrique ;\r\nPartenariats et collaborations avec les Etats, Organisations internationales ou Nationales, Organisations non gouvernementales, Universités, en vue de promouvoir la recherche et les études sur le commerce extérieur africain ;\r\nElaborer des rapports et autres formes des travaux de recherches sur les douanes et les changes en Afrique\r\nAnimer la revue dénommée « Revue des Douanes & Changes en Afrique Centrale » dans la perspective de promouvoir et vulgariser la recherche sur les questions douanières et des changes ;\r\nParticiper aux négociations et autres enjeux liées au commerce impliquant les acteurs africains en vue de défendre et de sauvegarder leurs intérêts commerciaux et en matière de douanes et tarifs ;\r\nDiffuser au plus large public africain le maximum d’informations sur la règlementation douanière et du commerce extérieur ;\r\nŒuvrer à rendre plus compétitif le commerce extérieur des Etats africain ;\r\nElaborer une stratégie de l’ingénierie du savoir africain sur les sujets divers en matière de politique commerce extérieur dans le cadre des accords négociés entre les Etats africains et les grandes puissances ou multinationales.', '13 Rue Félicien Lesage 78360 Montesson  (France)', 'Afrique centrale (Cameroun-Douala) CADEX AFRIQUE SAS RC/DLA/2022/B/662, Afrique de l’ouest (Nigéria),- Afrique de l’est (Kenya), -Afrique du Nord (Tunisie), -Europe (France), -Amérique du nord (New-York), -Asie (Chine), -Moyen Orient (Dubaï)', NULL, '+237 6 51 26 18 99/+ 237  93 29 85 16', '+ 32 66  01 02 71/+33 7 49 12 30 92', NULL, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2622.247207519277!2d2.1772511155527927!3d48.91068220497769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66390113a0e91%3A0xbd6fafffbb151bb4!2sRue%20Chantal%20Mauduit%2C%2078420%20Carri%C3%A8res-sur-Seine%2C%20France!5e0!3m2!1sfr!2scm!4v1662001493555!5m2!1sfr!2scm', 'phpF453.tmp.png', NULL, 1, '2022-08-31 06:34:36', '2023-09-19 04:41:07', 'contact@cadexafrique.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `infos_services`
--

CREATE TABLE `infos_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `infos_solutions`
--

CREATE TABLE `infos_solutions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `solution_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `infos_solutions`
--

INSERT INTO `infos_solutions` (`id`, `user_id`, `solution_id`, `title`, `description`, `cover`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'gouvernance, contingence et complexité', 'Ce texte a deux principaux objectifs. Le premier est de dessiner les contours d’un cadre d’analyse de la gouvernance économique et, en même temps, de réaliser un panorama.', 'php62D5.tmp.jpg', 1, '2022-06-18 09:26:34', '2022-06-18 09:26:34'),
(2, 1, 1, 'Ventes', 'L’économie portugaise', 'phpFE4A.tmp.jpg', 1, '2022-06-18 09:38:10', '2022-06-18 09:38:10'),
(3, 1, 4, 'Tst', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p>Test etst</p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', 'php9364.tmp.webp', 1, '2023-07-08 11:27:41', '2023-07-08 11:29:32');

-- --------------------------------------------------------

--
-- Structure de la table `menuses`
--

CREATE TABLE `menuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menuses`
--

INSERT INTO `menuses` (`id`, `user_id`, `name`, `position`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Accueil', 1, 1, '2022-08-25 05:58:11', '2023-09-19 03:53:12'),
(4, 1, 'Nos équipes', 3, 1, '2022-09-10 21:04:47', '2023-09-19 05:01:04'),
(5, 1, 'Publications', 4, 1, '2022-09-10 21:23:55', '2022-10-27 13:38:11'),
(6, 1, 'Bibliothèques', 5, 1, '2022-09-10 21:25:17', '2022-10-27 13:38:24'),
(7, 1, 'Contacts', 6, 1, '2022-09-10 21:34:57', '2022-10-27 13:39:23');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_00_00_000000_create_websockets_statistics_entries_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_04_12_211600_create_service_table', 1),
(7, '2021_04_14_093635_create_article_table', 1),
(8, '2021_04_14_134032_add_api_token_to_users_table', 1),
(9, '2021_04_14_134217_add_pp_to_users_table', 1),
(10, '2021_04_14_153944_add_status_to_users_table', 1),
(11, '2021_04_15_091742_add_telephone_to_users_table', 1),
(12, '2021_04_19_155026_create_support_table', 1),
(13, '2021_04_20_060756_create_clientaccount_table', 1),
(14, '2021_04_23_123149_create_chatbootmessage_table', 1),
(15, '2021_04_24_100800_add_status_to_article_table', 1),
(16, '2021_04_28_155050_create__comment_articles_table', 1),
(17, '2021_04_28_155116_create__like_articles_table', 1),
(18, '2021_04_28_160424_add_nullable_contraint_to_article_table', 2),
(19, '2021_04_28_160518_add_nullable_contraint_to_service_table', 2),
(20, '2021_05_02_233410_create_categoriesolutions_table', 2),
(21, '2021_05_03_003048_create_solutions_table', 2),
(22, '2021_05_03_005733_add_null_contraint_to_solutions_table', 2),
(23, '2021_05_04_105344_create_article_service_table', 2),
(24, '2021_05_04_140047_create_articles_table', 2),
(25, '2021_05_04_155446_add_articles_service_table', 2),
(26, '2021_05_06_131240_add_type_account_to_clientaccount_table', 2),
(27, '2021_05_06_221443_add_extcontent_to_service_table', 2),
(28, '2021_05_07_101124_change_service_table_column', 2),
(29, '2021_05_07_112747_change_articles_table_column', 2),
(30, '2021_05_08_104030_create_infos_services_table', 2),
(31, '2021_05_08_111550_add_column_to_infos_services_table', 2),
(32, '2021_05_08_130355_change_column_to_infos_services_table', 2),
(33, '2021_05_09_035551_remove_column_to_service_table', 2),
(34, '2021_05_10_092355_add_column_to_articles_table', 2),
(35, '2021_05_10_094909_add_column_to_service_table', 2),
(36, '2021_05_11_135455_add_label_to_solutions_table', 2),
(37, '2021_05_11_140653_create_infos_solutions_table', 2),
(38, '2021_05_11_155328_change_column_to_infos_solutions_table', 2),
(39, '2021_05_11_162651_add_column_to_solutions_table', 2),
(40, '2021_07_05_141451_create_infos_bannieres_table', 2),
(41, '2021_07_09_115121_create_bannieres_table', 2),
(42, '2021_09_04_084322_create_chat_messages_table', 2),
(43, '2021_09_16_113625_add_column_to_chat_messages_table', 2),
(44, '2021_09_16_122819_change_contraint_to_chat_messages_table', 2),
(45, '2022_06_16_201401_create_categorie_articles_table', 3),
(46, '2022_06_16_201954_add_column_to_articles', 3),
(47, '2022_06_16_203325_add_column_to_categorie_articles', 4),
(48, '2022_06_17_065428_add_column_to_solutions', 5),
(49, '2022_06_17_065532_add_column_to_service', 5),
(50, '2022_06_18_084727_add_column_to_categoriesolutions', 6),
(51, '2022_06_20_041213_add_column_to_service', 7),
(52, '2022_07_03_183148_add_column_to_support', 8),
(53, '2022_08_25_042653_create_menuses_table', 9),
(54, '2022_08_30_072811_create_sub_menuses_table', 10),
(55, '2022_08_30_072947_create_sub_sub_menuses_table', 10),
(56, '2022_08_30_073111_create_infos_entreprises_table', 10),
(57, '2022_08_30_075049_create_staff_infos_table', 11),
(58, '2022_08_30_080300_add_column_to_sub_menuses_table', 12),
(59, '2022_08_30_080418_add_column_to_sub_sub_menuses_table', 12),
(60, '2022_08_31_070535_add_column_to_infos_entreprises_table', 13),
(61, '2022_09_10_062929_create_order_detail_models_table', 14),
(62, '2022_09_11_121651_create_content_sub_menu_models_table', 15),
(63, '2022_09_11_122653_add_column_to_order_detail_models_table', 16),
(64, '2023_06_20_164201_add_column_rubrique_to_sub_menuses', 17),
(65, '2023_06_20_164426_add_column_rubrique_to_sub_sub_menuses', 17),
(66, '2023_06_27_174224_create_staff_profils_table', 18),
(67, '2023_06_27_182446_change_column_to_staff_infos_table', 19),
(68, '2023_06_27_183959_add_column_to_staff_profils_table', 20),
(69, '2023_07_08_104841_change_column_to_infos_services_table', 21),
(70, '2023_07_08_105038_change_column_to_infos_bannieres_table', 22),
(71, '2023_07_08_122639_change_column_to_infos_solutions_table', 23),
(72, '2023_07_08_122720_change_column_to_infos_solutions_table', 24),
(73, '2023_07_08_122812_change_column_to_infos_services_table', 25),
(74, '2023_07_08_122843_change_column_to_infos_bannieres_table', 25);

-- --------------------------------------------------------

--
-- Structure de la table `order_detail_models`
--

CREATE TABLE `order_detail_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `creator` bigint(20) UNSIGNED NOT NULL,
  `title` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `freetext1` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freetext2` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `niveau` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_detail_models`
--

INSERT INTO `order_detail_models` (`id`, `creator`, `title`, `libelle`, `description`, `image`, `freetext1`, `freetext2`, `created_at`, `updated_at`, `menu_id`, `niveau`) VALUES
(1, 1, 'Bonjour', 'Je suis le président', 'Yes', 'phpF3DF.tmp.jpg', NULL, NULL, '2022-09-10 09:36:50', '2022-09-10 09:36:50', 3, 3),
(2, 1, 'Test', 'TEst', 'TTTTTTT', 'phpF501.tmp.webp', NULL, NULL, '2022-09-11 15:43:59', '2022-09-11 15:43:59', 5, 2),
(5, 1, 'CADEX', 'Nous Sommes', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Le Centre de Recherches et de Promotion du Commerce Extérieur en Afrique (CADEX) est un « <strong>Think Tank</strong> » indépendant reconnu sous le N°W783012206, dont les activités sont essentiellement tournées vers les travaux en matière douanières et des changes ainsi que d’autres réglementations du commerce extérieur dans les Etats et regroupements d’Etats africains.</p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Le CADEX Afrique en tant que «&nbsp;Centre de Recherches et de Promotion du Commerce Extérieur en Afrique&nbsp;», situé au 78360 Montesson (France) avec des sections opérationnelles disséminées un peu partout dans les quatre coins du monde dont Douala pour l’Afrique Centrale, Nairobi pour l’Afrique de l’Est, Paris pour l’Europe occidentale et New York pour l’Amérique du Nord, &nbsp;a pour but ultime d’œuvrer à l’appropriation constante et qualitative des réglementations communautaires essentielles au développement du commerce extérieur des Etats membres dans la CEMAC en particulier, et en Afrique en général. </p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Notre Centre dispose en effet, d’Experts et Consultants internationaux spécialisés ayant une très bonne connaissance des règlements des unions douanière et monétaire (CEMAC, CEEAC, UEMOA,&nbsp;CEDEAO, ZLECAf); avec une bonne expérience dans l’accompagnement des entreprises du secteur privé ou institutions sous régionales et d’organismes internationaux et administrations publiques en termes de conseils, audits, renforcements des capacités, assistance technique ou contentieuse.</p><p>&nbsp;</p><p class=\"ql-align-justify\">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Le CADEX publie également la Revue des Douanes &amp; Changes en Afrique Centrale (RDCAC) qui paraît trimestriellement. Cette œuvre scientifique conforte la plus-value que notre entité est susceptible de fournir. Elle constitue une vitrine importante de communication, pouvant servir de media, à la portée des Institutions dépositaires de l’exécution harmonieuse des réglementations communautaires et mettant à la disposition des acteurs du commerce international de l’Afrique centrale un outil d’éclairage, de compréhension, de débats et de prise de décision sur questions de douanes et changes.&nbsp;</p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\" style=\"margin-top: -158px;\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', 'php88EE.tmp.avif', NULL, NULL, '2023-05-15 18:17:18', '2023-09-19 03:54:30', 14, 2),
(6, 1, 'Oui OUi', 'ccs', 'scsc', 'php213E.tmp.png', NULL, NULL, '2023-05-15 18:41:10', '2023-05-15 18:41:10', 16, 2),
(7, 1, 'Test', 'Test', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><h2><strong>Create a personal sandbox account</strong></h2><p><br></p><p><br></p><p>Create a personal sandbox account to represent the buyer in a transaction. The PayPal sandbox automatically creates your first personal sandbox account when you sign up for a developer account on the developer site. To generate the personal sandbox account name, PayPal appends&nbsp;<code style=\"background-color: rgb(239, 242, 243); color: rgb(30, 32, 33);\">-buyer</code>&nbsp;to your email address.</p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', 'php73E5.tmp.webp', NULL, NULL, '2023-07-08 11:38:28', '2023-07-08 11:38:28', 22, 2),
(8, 1, 'Test', 'Test', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p>jellllllllllllllll  <a href=\"https://www.yahoo.fr\" target=\"_blank\">https://www.yahoo.fr</a></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-editing ql-hidden\" data-mode=\"link\" style=\"left: -15.3142px; top: 27.5521px;\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\" placeholder=\"https://quilljs.com\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', 'php854A.tmp.jpg', NULL, NULL, '2023-07-08 11:46:12', '2023-07-08 11:59:27', 6, 3),
(9, 1, 'Hole', 'Hme', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><h3><a href=\"www.google.com\" target=\"_blank\">Create a business sandbox account</a></h3><p>The PayPal sandbox automatically creates your first business sandbox account when you sign up for a developer account on the&nbsp;<a href=\"https://developer.paypal.com/\" target=\"_blank\" style=\"color: rgb(51, 122, 183);\">developer site</a>. To generate the account name, PayPal appends&nbsp;<code style=\"color: rgb(30, 32, 33); background-color: rgb(239, 242, 243);\">-facilitator</code>&nbsp;to your email name. PayPal assigns a set of test API credentials to the account. Use the account to create mock PayPal transactions in the PayPal sandbox.</p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\" style=\"left: -10.0555px; top: 28.6632px;\"><a class=\"ql-preview\" target=\"_blank\" href=\"www.google.com\">www.google.com</a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\" placeholder=\"https://quilljs.com\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', 'phpE925.tmp.webp', NULL, NULL, '2023-07-08 12:47:48', '2023-07-08 13:06:09', 13, 2);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `labelDesc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `user_id`, `title`, `description`, `cover`, `created_at`, `updated_at`, `labelDesc`, `priority`, `status`) VALUES
(11, 1, 'Recherches et promotion du commerce extérieur en Afrique', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\">Recherches et promotion du commerce extérieur en Afrique</p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', 'php78A1.tmp.avif', '2023-09-11 08:15:50', '2023-09-11 08:20:00', 'Recherches et promotion du commerce extérieur en Afrique', 1, '1'),
(12, 1, 'Etudes et consultations en douanes et changes', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p>Etudes et consultations en douanes et changes&nbsp;&nbsp;</p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', 'phpECB9.tmp.jpg', '2023-09-11 08:23:46', '2023-09-11 08:23:46', 'Etudes et consultations en douanes et changes', 1, '1'),
(13, 1, 'Assistance technique aux Administrations et Organismes en commerce extérieur', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\">Appui et accompagnement à la structuration des besoins en financement dans le secteur du commerce extérieur en Afrique</p><p><br></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', 'phpE8D8.tmp.png', '2023-09-19 05:07:19', '2023-09-19 05:07:19', 'Assistance technique', 1, '1');

-- --------------------------------------------------------

--
-- Structure de la table `solutions`
--

CREATE TABLE `solutions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `creator` bigint(20) UNSIGNED NOT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `labelDesc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `solutions`
--

INSERT INTO `solutions` (`id`, `creator`, `categorie`, `name`, `description`, `photo`, `status`, `created_at`, `updated_at`, `labelDesc`, `priority`) VALUES
(3, 1, '2', 'Vendre partout dans le monde et avoir du succès comment faire ?', 'Vous vous êtes longuement posé la même et unique question de savoir comment étendre votre affaire au delà de l\'Afrique et bien nous avons effectués des recherches dans ce domaine et les résultats pourrons vous fascinés.', 'phpE95A.tmp.jpeg', 1, '2022-06-19 03:21:58', '2022-06-19 03:21:58', 'Le chemin de la réussite dans les affaires.', 3),
(4, 1, '1', 'Fidéliser votre clientèle et créé une communauté pour vos services.', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p>La magie du commerce c\'est de fidélisées ses clients, c\'est à dire conservé ces clients établir une relation de confiance. hhhet</p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', 'phpE099.tmp.jpg', 1, '2022-06-19 03:30:40', '2023-07-08 11:14:56', 'Propulsé vos activités en suivant notre formation de management', 1);

-- --------------------------------------------------------

--
-- Structure de la table `staff_infos`
--

CREATE TABLE `staff_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poste` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `freetext1` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freetext2` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freetext3` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `staff_infos`
--

INSERT INTO `staff_infos` (`id`, `user_id`, `first_name`, `last_name`, `telephone`, `adresse`, `email`, `photo`, `signature`, `poste`, `status`, `freetext1`, `freetext2`, `freetext3`, `created_at`, `updated_at`) VALUES
(5, 1, 'MBALLA KEUMBOU', 'Adolphe', '000000000', 'Douala, Cameroun', 'mballa2000@yahoo.fr', 'php934C.tmp.jpg', NULL, 1, 1, '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\">Juriste (DESS) en droit international économique (Université de Dschang et de Louvain) et diplômé de l’ENAM (Cycle A) section «&nbsp;douanes&nbsp;». Il cumule 15 années de travail consacré aux questions de douanes et changes. Fonctionnaire des douanes, il a travaillé une dizaines d’années à la Direction Générale des douanes aussi bien dans les services opérationnels (Bureaux des douanes et GUCE) que centraux (Cellule des contrôles douaniers et Division de la Législation).</p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\">Par la suite autour de l’année 2017, il a rejoint l’international par acte de détachement administratif, notamment la CEMAC et ensuite la CEEAC où il a officié et traité comme Expert des questions douanières. Ce passage, lui a permis d’avoir une connaissance fine et d’élaborer de nombreux instruments, règlements et outils douaniers sur les plans communautaires et internationaux. En effet, par la même entremise, Adolphe à travailler comme Expert Régional dans divers programme multilatéraux de l’Organisation Mondiale du Commerce (OMC) que de l’Organisation Mondiale des Douanes (OMD) relatifs au commerce et aux questions actuelles des douanes (services, réformes des législations, facilitation…). </p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\">Depuis 2021, il a rejoint le Cabinet D.HAPPI et occupe le poste de Customs, Exchange Regulations and Investments Business Unit Leader qu’il anime avec brio. Il est par ailleurs chercheur et Président du Centre de Recherches pour la Promotion du Commerce Extérieur en Afrique CADEX. Il est auteur de plusieurs articles sur le droit douanier dont certains publiés récemment dans le Revue des douanes et changes en Afrique centrale dont il est la Coordonnateur Technique.</p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\">De manière générale, son expérience sur les plans interne, régionale et internationale lui vaut une riche connaissance historique et actuelle du droit douanier en UDEAC/CEMAC/CEEAC/OMD/OMC dont il a patiemment acquis, archivées et mises à jour continuellement, toutes les documentations relatives aux règlements douaniers de ses institutions. Cette expérience lui a permis d’élaborer au cours de sa carrière de nombreux projets de textes et hautes opinions sur les questions douanières les plus pointues. Depuis peu, son expertise est mise au service des conseils aux administrations et entreprises, de la recherche et de la mise à niveau et de la conformité des acteurs du commerce extérieur.</p><p><br></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\" style=\"margin-top: 0px;\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', NULL, NULL, '2023-09-19 03:57:02', '2023-09-19 03:57:02'),
(6, 1, 'TEKOU TENE', 'Jean Joël', '000000000', 'Douala, Cameroun', 'tekou.tene@cadexafrique.com', 'php824C.tmp.jpeg', NULL, 2, 1, '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\">Tekou Tene est un spécialiste connu de la règlementation des opérations financières et internationales aussi bien dans l’industrie extractive (Oil, Gas and Mining) que dans et les opérations courantes import/export. Il est basé aujourd’hui à New York aux USA et à Paris en France, où il assiste les Etats, organismes internationaux et les entreprises dans le cadre des investissements en matière de&nbsp;commerce extérieur en Afrique et principalement en Afrique subsaharienne. </p><p class=\"ql-align-justify\">Ancien Manager au Cabinet International MAZARS, où il a officié comme et head of office et fondateur de la Ligne de Servie Customs and exchange régulation. Il a assisté durant cette période les grandes entreprises dans les plus gros contrôles et contentieux en matière douanière et des changes avec des montants de redressements faramineux qu’il a défendu avec succès. Jean Joël totalise près de 10 ans d’expérience. Il est actuellement Consultant international en droit des relations financières avec l’étranger et douanes et dispose d’une riche expérience sur l’Afrique centrale.</p><p class=\"ql-align-justify\">Il travaille avec les entreprises et Cabinet sur les dossiers liés aux transactions complexes avec des forts enjeux internationaux. </p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\">Depuis Janvier 2022, il est Secrétaire Général du Centre de Recherches pour la Promotion du Commerce Extérieur en Afrique (CADEX) et Rédacteur en Chef de la Revue de Douanes &amp; Changes en Afrique Centrale. Il dispose à son actif de près d’une dizaine d’articles publiés entre autres sur la douane et la réglementation des changes dans la Revue qu’il dirige et des revues spécialisés à l’international. </p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\">Il finalise une thèse de doctorat en droit à l’Ecole de Droit de la Sorbonne à l’Université de Paris 1 Panthéon Sorbonne, où il enseigne également, et est chercheur invité à la Columbia Law School &nbsp;de l’Université de Columbia aux USA. Il est titulaire d’un diplôme d’Etudes Approfondies en Droit des Affaires (D.E.A), d’un Master 2 en économie appliquée option Transports Internationaux à l’Université de paris 1 Panthéon Sorbonne (France) et d’un Certificat de la Knowledge Academy de l’Organisation Mondiale des Douanes (O.M.D). &nbsp;</p><p><br></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\" style=\"margin-top: 0px;\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', NULL, NULL, '2023-09-19 03:59:08', '2023-09-19 03:59:08');

-- --------------------------------------------------------

--
-- Structure de la table `staff_profils`
--

CREATE TABLE `staff_profils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `staff_profils`
--

INSERT INTO `staff_profils` (`id`, `name`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Président', 1, '2023-06-27 17:59:08', '2023-06-27 18:13:27', 1),
(2, 'Sécrétaire Général', 1, '2023-09-19 03:55:10', '2023-09-19 03:55:10', 1);

-- --------------------------------------------------------

--
-- Structure de la table `sub_menuses`
--

CREATE TABLE `sub_menuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `rubrique` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sub_menuses`
--

INSERT INTO `sub_menuses` (`id`, `user_id`, `name`, `position`, `status`, `created_at`, `updated_at`, `parent_id`, `rubrique`) VALUES
(14, 1, 'A propos de nous', 1, 1, '2023-05-15 18:00:09', '2023-05-15 18:00:09', 2, NULL),
(17, 1, 'Equipes Dirigente', 1, 1, '2023-06-20 15:38:45', '2023-06-21 07:26:19', 4, 4),
(21, 1, 'Revue du CADEX', 1, 1, '2023-06-27 13:53:03', '2023-07-07 05:15:41', 5, 1),
(24, 1, 'Thèse', 1, 1, '2023-09-19 04:44:42', '2023-09-19 04:44:42', 6, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sub_sub_menuses`
--

CREATE TABLE `sub_sub_menuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sub_parent_id` bigint(20) UNSIGNED NOT NULL,
  `rubrique` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sub_sub_menuses`
--

INSERT INTO `sub_sub_menuses` (`id`, `user_id`, `name`, `position`, `status`, `created_at`, `updated_at`, `sub_parent_id`, `rubrique`) VALUES
(6, 1, 'Hallo', 1, 1, '2023-07-08 11:45:33', '2023-07-08 11:45:33', 23, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `support`
--

CREATE TABLE `support` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` bigint(20) DEFAULT NULL,
  `interest` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `is_superadmin` int(11) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `telephone` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `is_superadmin`, `email_verified_at`, `password`, `api_token`, `remember_token`, `created_at`, `updated_at`, `pp`, `actif`, `telephone`) VALUES
(1, 'Administrator', 'cadex-africa@cadex.com', 0, 1, NULL, '$2y$10$TIs2IKZgBWITLWNBcANfBOe8guOqqj1xVk1K8nI/xxL3w1TzP2xA2', NULL, NULL, '2022-06-14 08:15:19', '2022-06-17 05:52:00', NULL, 1, 693911857);

-- --------------------------------------------------------

--
-- Structure de la table `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_comment_articles`
--

CREATE TABLE `_comment_articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_like_articles`
--

CREATE TABLE `_like_articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `articles_service`
--
ALTER TABLE `articles_service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `article_service`
--
ALTER TABLE `article_service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bannieres`
--
ALTER TABLE `bannieres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categoriesolutions`
--
ALTER TABLE `categoriesolutions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_articles`
--
ALTER TABLE `categorie_articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chatbootmessage`
--
ALTER TABLE `chatbootmessage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clientaccount`
--
ALTER TABLE `clientaccount`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `infos_bannieres`
--
ALTER TABLE `infos_bannieres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `infos_entreprises`
--
ALTER TABLE `infos_entreprises`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `infos_services`
--
ALTER TABLE `infos_services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `infos_solutions`
--
ALTER TABLE `infos_solutions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menuses`
--
ALTER TABLE `menuses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_detail_models`
--
ALTER TABLE `order_detail_models`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `solutions`
--
ALTER TABLE `solutions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `staff_infos`
--
ALTER TABLE `staff_infos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `staff_profils`
--
ALTER TABLE `staff_profils`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sub_menuses`
--
ALTER TABLE `sub_menuses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sub_sub_menuses`
--
ALTER TABLE `sub_sub_menuses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`);

--
-- Index pour la table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `_comment_articles`
--
ALTER TABLE `_comment_articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `_like_articles`
--
ALTER TABLE `_like_articles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `articles_service`
--
ALTER TABLE `articles_service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `article_service`
--
ALTER TABLE `article_service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `bannieres`
--
ALTER TABLE `bannieres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `categoriesolutions`
--
ALTER TABLE `categoriesolutions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `categorie_articles`
--
ALTER TABLE `categorie_articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `chatbootmessage`
--
ALTER TABLE `chatbootmessage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `clientaccount`
--
ALTER TABLE `clientaccount`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `infos_bannieres`
--
ALTER TABLE `infos_bannieres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `infos_entreprises`
--
ALTER TABLE `infos_entreprises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `infos_services`
--
ALTER TABLE `infos_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `infos_solutions`
--
ALTER TABLE `infos_solutions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `menuses`
--
ALTER TABLE `menuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT pour la table `order_detail_models`
--
ALTER TABLE `order_detail_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `solutions`
--
ALTER TABLE `solutions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `staff_infos`
--
ALTER TABLE `staff_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `staff_profils`
--
ALTER TABLE `staff_profils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `sub_menuses`
--
ALTER TABLE `sub_menuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `sub_sub_menuses`
--
ALTER TABLE `sub_sub_menuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `support`
--
ALTER TABLE `support`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_comment_articles`
--
ALTER TABLE `_comment_articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_like_articles`
--
ALTER TABLE `_like_articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

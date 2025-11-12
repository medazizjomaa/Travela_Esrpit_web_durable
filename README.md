# 🌍 Travela – MVC Web Project

Travela is a group web project built using the **MVC (Model–View–Controller)** architecture in **PHP**.  
It’s designed as a travel booking and management platform that allows users to register, log in, and explore travel offers while the admin manages clients, destinations, and bookings.

---

## 📑 Table of Contents
1. [Overview](#overview)
2. [Objectives](#objectives)
3. [Features](#features)
4. [Project Structure](#project-structure)
5. [Technologies Used](#technologies-used)
6. [Installation Guide](#installation-guide)
7. [Database Structure & Sample Data](#database-structure--sample-data)
8. [How It Works](#how-it-works)
9. [Team Members](#team-members)
10. [Future Improvements](#future-improvements)
11. [License](#license)

---

## 🧭 Overview
Travela is a **durable and intelligent travel management website** promoting **smart, affordable, and sustainable travel**.  
It helps users plan trips that **fit their budget** while ensuring responsible choices that make every journey worthwhile.  

Travela’s mission is simple:  
> “Travel more, spend less, and make smarter choices.”

This project was developed as part of a **group coursework** to apply web development best practices and the **MVC architecture** in **PHP**.

---

## 🎯 Objectives
- Build a **modular and clean MVC website** for managing travel offers and clients.  
- Promote **affordable travel** that helps users make the most of their money.  
- Support **eco-friendly and durable tourism**.  
- Design a **secure authentication system** for clients and admins.  
- Maintain **clean database design** with relational integrity.

---

## 🚀 Features
### 👥 User Side (Front Office)
- Register and log in securely.  
- View and book travel destinations.  
- Receive **optimized, budget-friendly trip suggestions**.  
- Leave reviews and feedback on destinations.  
- Fully responsive layout.

### 🧑‍💻 Admin Side (Back Office)
- Manage clients, destinations, and reservations.  
- Add and track **eco-friendly activities** and events.  
- Review and approve customer feedback.  
- Visual dashboard with user data and activity.

---
## 🧰 Technologies Used
- **Front-end:** HTML5, CSS3, JavaScript  
- **Back-end:** PHP (MVC Architecture)  
- **Database:** MySQL (via PDO)  
- **Server:** Apache (WAMP/XAMPP)  
- **Design Tools:** Canva (UI/UX design, visuals)

---

## ⚙️ Installation Guide

### 1️⃣ Requirements
- [WAMP](https://www.wampserver.com/en/) or [XAMPP](https://www.apachefriends.org/index.html)  
- PHP ≥ 8.0  
- MySQL  
- Web browser (Chrome, Firefox…)
### 2️⃣ Add Data Base
- **add this data base in your WAMP or XAMP name it travela_db**
  ### Database (SQL dump)

```sql
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 11 nov. 2025 à 09:55
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Base de données : `travela_db`
DROP TABLE IF EXISTS `activites_evenement_durables`;
CREATE TABLE IF NOT EXISTS `activites_evenement_durables` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` mediumtext,
  `type` enum('activité','événement') NOT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `date_debut` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `responsable` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `activites_evenement_durables`
--

INSERT INTO `activites_evenement_durables` (`id`, `nom`, `description`, `type`, `lieu`, `date_debut`, `date_fin`, `responsable`, `image_url`, `video_url`) VALUES
(2, 'RANDO', 'hhjjn', 'activité', 'parc', '2026-02-12 12:22:00', '2027-02-01 14:17:00', 'hjnhhj', 'C:\\wamp64\\www\\travela\\mvc\\views\\frontOffice\\img\\destination-4.jpg', 'C:\\wamp64\\www\\travela\\mvc\\views\\frontOffice\\img\\vd.mp4'),
(3, 'events eco', 'dinner en foret', 'événement', 'parc naturel', '2025-11-12 00:57:00', '2025-11-28 00:58:00', 'asma', 'https://media.tacdn.com/media/attractions-splice-spp-674x446/10/3a/dc/aa.jpg', ''),
(5, 'camping', 'une belle sortie', 'activité', 'parc', '2025-11-11 00:00:00', '2025-11-13 00:00:00', 'asma', 'https://media.tacdn.com/media/attractions-splice-spp-674x446/10/3a/dc/aa.jpg', 'https://www.youtube.com/watch?v=YtQga2FL684&list=RDYtQga2FL684&start_radio=1&rv=7AJoXNoITEk'),
(6, 'sortie bateau', 'beau', 'événement', 'bizerte', '2025-11-12 00:00:00', '2025-11-21 00:00:00', 'fatma', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `avis_clients`
--

DROP TABLE IF EXISTS `avis_clients`;
CREATE TABLE IF NOT EXISTS `avis_clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `note` int DEFAULT NULL,
  `commentaire` text,
  `date_avis` datetime DEFAULT CURRENT_TIMESTAMP,
  `avis_parent` int DEFAULT NULL,
  `idclient` int DEFAULT NULL,
  `statut` enum('approuvé','en attente','rejeté') DEFAULT 'en attente',
  `likes` int DEFAULT '0',
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idclient` (`idclient`),
  KEY `avis_parent` (`avis_parent`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `avis_clients`
--

INSERT INTO `avis_clients` (`id`, `nom_client`, `email`, `note`, `commentaire`, `date_avis`, `avis_parent`, `idclient`, `statut`, `likes`, `user_id`) VALUES
(45, 'you', 'aa@gmail.com', 4, 'bbbb', '2025-11-11 02:09:20', NULL, NULL, 'en attente', 0, NULL),
(44, 'mohamed', 'zzz@dd.dd', 5, '11', '2025-11-11 00:36:46', NULL, NULL, 'en attente', 0, NULL),
(43, 'mohamed', 'zzz@dd.dd', 3, 'vv', '2025-11-10 23:50:43', NULL, NULL, 'en attente', 0, NULL),
(42, 'asma', 'limayemasma04@gmail.com', 1, 'mal', '2025-11-10 23:49:49', NULL, NULL, 'en attente', 1, NULL),
(41, 'sonia', 'zzz@dd.dd', 5, 'h', '2025-11-10 23:04:19', NULL, NULL, 'en attente', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idclient` int NOT NULL AUTO_INCREMENT,
  `nomclient` varchar(100) NOT NULL,
  `prenomclient` varchar(100) NOT NULL,
  `mailclient` varchar(100) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `date_inscription` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idclient`),
  UNIQUE KEY `mailclient` (`mailclient`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idclient`, `nomclient`, `prenomclient`, `mailclient`, `motdepasse`, `telephone`, `date_inscription`) VALUES
(2, 'Martin', 'Marie', 'marie.martin@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+33123456790', '2025-10-12 22:54:29'),
(3, 'Bernard', 'Pierre', 'pierre.bernard@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+33123456791', '2025-10-12 22:54:29'),
(4, 'Jomaa', 'aziz', 'baloulo88u@gmail.com', '$2y$10$f85J3FDEaZjhYcrHmFP5huQj4wUBhXrI9CsPi.vAClw9F0okiem8G', NULL, '2025-10-12 23:02:43'),
(6, 'cc', 'bbb', 'aa@gmail.com', '$2y$10$Ic/qdo.EaNNRgu8t4G.JUuz5oeg/B0VDejm.rqY.487vJlTLR17Pu', NULL, '2025-10-14 09:04:21'),
(7, 'youssef', 'lim', 'youssef@g.c', '$2y$10$Dq7s7.Xqlo5FK./VQZ8QoeoNbJMjSurYXSIQyurXfwDk7U8FSY0cy', NULL, '2025-10-22 21:57:09'),
(8, 'asma', 'li', 'asma@gmail.com', '$2y$10$3o.02/dUzrLSNE8ue8GsnebCCPLVc9.qoK7//MYyYC/dwXD2DqJ8i', NULL, '2025-10-23 13:30:23'),
(9, 'cc', 'aa', 'aa@bb.cc', '$2y$10$dDCFJR41JotnWdjd8e6bL.r7JobTf57UWnoK7B/va3jn0IJXMAd72', NULL, '2025-11-09 23:29:34'),
(10, 'sedik', 'youssef', 'youssef@sedik.l', '$2y$10$qD7qvImXt2b6I9T2ZsWgjeB1.Xza4SVqNQSsF1UqWH7yI0UYZjfaO', NULL, '2025-11-11 00:44:10');

-- --------------------------------------------------------

--
-- Structure de la table `destination`
--

DROP TABLE IF EXISTS `destination`;
CREATE TABLE IF NOT EXISTS `destination` (
  `id_dest` int NOT NULL AUTO_INCREMENT,
  `nom_dest` varchar(100) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `imageD` varchar(255) NOT NULL,
  PRIMARY KEY (`id_dest`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `destination`
--

INSERT INTO `destination` (`id_dest`, `nom_dest`, `prix`, `imageD`) VALUES
(3, 'BIZERTE', 300.00, 'Bizerte.jpg'),
(4, 'Monastir', 200.00, 'Monastir.jpg'),
(5, 'Mahdia', 300.00, 'mahdia.jpg'),
(6, 'sousse', 50.00, 'sousse.png');

-- --------------------------------------------------------

--
-- Structure de la table `impact_ecologique`
--

DROP TABLE IF EXISTS `impact_ecologique`;
CREATE TABLE IF NOT EXISTS `impact_ecologique` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `TRANSPORT` varchar(50) NOT NULL,
  `DISTANCE` float NOT NULL,
  `VOYAGEURS` int NOT NULL,
  `HEBERGEMENT` varchar(50) NOT NULL,
  `CO2_TOTAL` float NOT NULL,
  `DATE_CALCUL` date NOT NULL,
  `idclient` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `idclient` (`idclient`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `impact_ecologique`
--

INSERT INTO `impact_ecologique` (`ID`, `TRANSPORT`, `DISTANCE`, `VOYAGEURS`, `HEBERGEMENT`, `CO2_TOTAL`, `DATE_CALCUL`, `idclient`, `created_at`) VALUES
(36, 'voiture', 100, 3, 'hotel_classique', 66, '2025-11-10', NULL, '2025-11-10 21:01:45'),
(37, 'train', 22, 5, 'auberge_eco', 14.4, '2025-11-10', NULL, '2025-11-10 23:12:10');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_res` int NOT NULL AUTO_INCREMENT,
  `idclient` int DEFAULT NULL,
  `id_dest` int DEFAULT NULL,
  `date_res` date NOT NULL,
  `type_res` enum('individuel','groupe') NOT NULL,
  `nbr_personnes` int NOT NULL,
  PRIMARY KEY (`id_res`),
  KEY `idclient` (`idclient`),
  KEY `id_dest` (`id_dest`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `impact_ecologique`
--
ALTER TABLE `impact_ecologique`
  ADD CONSTRAINT `impact_ecologique_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `client` (`idclient`) ON DELETE SET NULL;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `client` (`idclient`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_dest`) REFERENCES `destination` (`id_dest`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;






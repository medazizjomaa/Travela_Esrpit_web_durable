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
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 11 nov. 2025 à 09:55
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Base de données : `travela_db`

-- Table: activites_evenement_durables
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `activites_evenement_durables` (`id`, `nom`, `description`, `type`, `lieu`, `date_debut`, `date_fin`, `responsable`, `image_url`, `video_url`) VALUES
(2, 'RANDO', 'hhjjn', 'activité', 'parc', '2026-02-12 12:22:00', '2027-02-01 14:17:00', 'hjnhhj', 'C:\\wamp64\\www\\travela\\mvc\\views\\frontOffice\\img\\destination-4.jpg', 'C:\\wamp64\\www\\travela\\mvc\\views\\frontOffice\\img\\vd.mp4');

-- Table: client
CREATE TABLE IF NOT EXISTS `client` (
  `idclient` int NOT NULL AUTO_INCREMENT,
  `nomclient` varchar(100) NOT NULL,
  `prenomclient` varchar(100) NOT NULL,
  `mailclient` varchar(100) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `date_inscription` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idclient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: destination
CREATE TABLE IF NOT EXISTS `destination` (
  `id_dest` int NOT NULL AUTO_INCREMENT,
  `nom_dest` varchar(100) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `imageD` varchar(255) NOT NULL,
  PRIMARY KEY (`id_dest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `destination` (`id_dest`, `nom_dest`, `prix`, `imageD`) VALUES
(3, 'BIZERTE', 300.00, 'Bizerte.jpg'),
(4, 'Monastir', 200.00, 'Monastir.jpg'),
(5, 'Mahdia', 300.00, 'mahdia.jpg'),
(6, 'sousse', 50.00, 'sousse.png');

-- Table: reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_res` int NOT NULL AUTO_INCREMENT,
  `idclient` int DEFAULT NULL,
  `id_dest` int DEFAULT NULL,
  `date_res` date NOT NULL,
  `type_res` enum('individuel','groupe') NOT NULL,
  `nbr_personnes` int NOT NULL,
  PRIMARY KEY (`id_res`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;

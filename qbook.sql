-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : ven. 06 sep. 2024 à 09:20
-- Version du serveur : 8.0.39
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `qbook`
--

-- --------------------------------------------------------

--
-- Structure de la table `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `room_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_at` timestamp NOT NULL,
  `end_at` timestamp NOT NULL,
  `participants_count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `room_id`, `title`, `start_at`, `end_at`, `participants_count`) VALUES
(1, 1, 1, 'Présentation QBook', '2024-10-14 14:00:00', '2024-10-14 15:00:00', 15),
(2, 2, 2, 'Hellfest', '2025-06-19 00:00:00', '2025-06-23 00:00:00', 5);

-- --------------------------------------------------------

--
-- Structure de la table `equipements`
--

CREATE TABLE `equipements` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `quantity` int NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `equipements`
--

INSERT INTO `equipements` (`id`, `name`, `quantity`, `price`) VALUES
(1, 'Paperboard', 3, 25.8),
(2, 'Ecran géant', 1, 1524);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE `rooms` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `capacity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `capacity`) VALUES
(1, 'bocal', 25),
(2, 'voiture', 5);

-- --------------------------------------------------------

--
-- Structure de la table `rooms_equipements`
--

CREATE TABLE `rooms_equipements` (
  `id` int NOT NULL,
  `room_id` int NOT NULL,
  `equipement_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `rooms_equipements`
--

INSERT INTO `rooms_equipements` (`id`, `room_id`, `equipement_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `role_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`) VALUES
(1, 2, 'Quentin', 'quentin.mace@quarksgroup.com', '$2y$10$YK.3dWutStwaFSUsyJ.WW.FrdaQdb/SNx86cHIPR5AnPBuwvn6FjK'),
(2, 1, 'Marvin', 'marvin.tarby@quarksgroup.com', '$2y$10$lGREPqX.tdUcfODPtyUMcuxFkns/uRgAWRnbbWrMOp6LfWwIytCdu');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Index pour la table `equipements`
--
ALTER TABLE `equipements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rooms_equipements`
--
ALTER TABLE `rooms_equipements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `equipement_id` (`equipement_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `equipements`
--
ALTER TABLE `equipements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `rooms_equipements`
--
ALTER TABLE `rooms_equipements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

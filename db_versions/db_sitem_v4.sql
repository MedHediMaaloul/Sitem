-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 13 juin 2023 à 17:18
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_sitem`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom_client_projet` varchar(200) NOT NULL,
  `email_client` varchar(200) NOT NULL,
  `numTel_client` int(11) NOT NULL,
  `adresse_client` varchar(200) NOT NULL,
  `commentaire_client` varchar(200) NOT NULL,
  `etat_client` enum('0','1') NOT NULL DEFAULT '1',
  `date_created_client` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_client` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom_client_projet`, `email_client`, `numTel_client`, `adresse_client`, `commentaire_client`, `etat_client`, `date_created_client`, `date_updated_client`) VALUES
(1, 'Sitem', '', 0, '', '', '', '2023-06-13 15:12:23', '2023-06-13 15:12:23');

-- --------------------------------------------------------

--
-- Structure de la table `conge`
--

CREATE TABLE `conge` (
  `id_conge` int(11) NOT NULL,
  `date_debut_conge` date NOT NULL,
  `date_fin_conge` date NOT NULL,
  `etat_conge` enum('En attente','Accepter','Refuser') NOT NULL DEFAULT 'En attente',
  `id_user_conge` int(11) NOT NULL,
  `date_created_conge` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_conge` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(11) NOT NULL,
  `sujet_contact` varchar(255) NOT NULL,
  `detail_contact` text NOT NULL,
  `id_user_contact` int(11) NOT NULL,
  `date_created_contact` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demande_materiel`
--

CREATE TABLE `demande_materiel` (
  `id_demande_mat` int(11) NOT NULL,
  `nom_demande_mat` varchar(255) NOT NULL,
  `justification_demande_mat` text NOT NULL,
  `urgent_demande_mat` enum('0','1') NOT NULL DEFAULT '0',
  `etat_demande_mat` enum('0','1') NOT NULL DEFAULT '1',
  `id_user_demande_mat` int(11) NOT NULL,
  `date_created_demande_mat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id_evenement` int(11) NOT NULL,
  `titre_evenement` varchar(255) NOT NULL,
  `date_debut_evenement` date NOT NULL,
  `date_fin_evenement` date NOT NULL,
  `id_user_evenement` int(11) NOT NULL,
  `date_created_evenement` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_evenement` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE `materiel` (
  `id_materiel` int(11) NOT NULL,
  `nom_materiel` varchar(255) NOT NULL,
  `prix_materiel` double NOT NULL,
  `date_achat_materiel` date NOT NULL,
  `piece_joint_materiel` varchar(255) NOT NULL,
  `id_user_materiel` int(11) NOT NULL,
  `date_created_materiel` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_materiel` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit_bureautique`
--

CREATE TABLE `produit_bureautique` (
  `id_produit` int(11) NOT NULL,
  `detail_produit` varchar(255) NOT NULL,
  `quantite_produit` int(11) NOT NULL,
  `prix_achat_produit` double NOT NULL,
  `piece_joint_produit` varchar(255) NOT NULL,
  `date_created_produit` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_produit` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id_projet` int(11) NOT NULL,
  `nom_projet` varchar(255) NOT NULL,
  `date_debut_projet` date NOT NULL,
  `date_fin_projet` date NOT NULL,
  `description_projet` text NOT NULL,
  `chef_projet` int(11) NOT NULL,
  `nom_client_projet` int(11) NOT NULL,
  `piece_joint_projet` varchar(255) NOT NULL,
  `etat_projet` enum('0','1','2','3') NOT NULL DEFAULT '1',
  `confirmation_projet` enum('0','1') NOT NULL DEFAULT '1',
  `date_created_projet` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_projet` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`id_projet`, `nom_projet`, `date_debut_projet`, `date_fin_projet`, `description_projet`, `chef_projet`, `nom_client_projet`, `piece_joint_projet`, `etat_projet`, `confirmation_projet`, `date_created_projet`, `date_updated_projet`) VALUES
(3, 'K2LOC', '2023-06-15', '2023-06-25', 'application web de gestion de location', 3, 1, 'K2LOC.png', '1', '0', '2023-06-13 15:15:14', '2023-06-13 16:15:56');

-- --------------------------------------------------------

--
-- Structure de la table `reunion`
--

CREATE TABLE `reunion` (
  `id_reunion` int(11) NOT NULL,
  `sujet_reunion` text NOT NULL,
  `date_reunion` date NOT NULL,
  `invite_reunion` text NOT NULL,
  `id_reunion_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `label_role_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `label_role_user`) VALUES
(0, 'admin'),
(1, 'employee'),
(2, 'superadmin');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE `specialite` (
  `id_specialite` int(11) NOT NULL,
  `nom_specialite` varchar(255) NOT NULL,
  `date_created_specialite` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_specialite` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`id_specialite`, `nom_specialite`, `date_created_specialite`, `date_updated_specialite`) VALUES
(1, 'Développeur', '2023-06-01 10:16:33', '2023-06-01 10:16:33'),
(2, 'CM', '2023-06-01 10:17:13', '2023-06-01 10:17:13'),
(3, 'Designeur', '2023-06-01 10:17:50', '2023-06-01 10:17:50'),
(4, 'Saisie', '2023-06-01 10:24:07', '2023-06-01 10:24:07');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `id_tache` int(11) NOT NULL,
  `description_tache` text NOT NULL,
  `nom_projet` int(11) NOT NULL,
  `date_debut_tache` date NOT NULL,
  `date_fin_tache` date NOT NULL,
  `piece_joint_tache` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_created_tache` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_tache` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom_user` varchar(255) NOT NULL,
  `prenom_user` varchar(255) NOT NULL,
  `cin_user` int(11) NOT NULL,
  `numTel_user` int(11) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `date_naissance_user` date NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_specialite` varchar(255) NOT NULL,
  `adresse_user` varchar(255) NOT NULL,
  `photo_user` varchar(255) NOT NULL,
  `etat_user` enum('0','1','2') NOT NULL DEFAULT '1',
  `date_created_user` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_user` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom_user`, `prenom_user`, `cin_user`, `numTel_user`, `email_user`, `password_user`, `date_naissance_user`, `id_role`, `id_specialite`, `adresse_user`, `photo_user`, `etat_user`, `date_created_user`, `date_updated_user`) VALUES
(1, 'ben brahim', 'ala', 123454, 95965, 'alaabenbrahim@ste-sitem.com', '0000', '2023-06-17', 0, '', '                                                           ajim', '123454.png', '1', '2023-06-01 10:31:08', '2023-06-13 09:51:31'),
(2, 'moslah', 'malek', 1542225, 92420452, 'malek.moslahh@gmail.com', '00000', '1990-10-20', 1, '2', 'ajim', '01542225.png', '1', '2023-06-12 13:17:18', '2023-06-12 13:17:18'),
(3, 'maaloul', 'mohamed', 78965111, 58754577, 'mohamed@gmail.com', '1234', '1995-10-10', 1, '2,1', 'ajim', '', '2', '2023-06-12 13:22:06', '2023-06-12 13:22:06'),
(4, 'siwar', 'kassas', 11113333, 27125578, 'kassassiwar99@gmail.com', '1111', '2005-06-01', 0, '', 'ajim 4135 djerba mednine', '', '1', '2023-06-12 14:39:46', '2023-06-12 16:25:06');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `conge`
--
ALTER TABLE `conge`
  ADD PRIMARY KEY (`id_conge`),
  ADD KEY `id_user_conge` (`id_user_conge`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`),
  ADD KEY `id_user_contact` (`id_user_contact`);

--
-- Index pour la table `demande_materiel`
--
ALTER TABLE `demande_materiel`
  ADD PRIMARY KEY (`id_demande_mat`),
  ADD KEY `id_user_demande_mat` (`id_user_demande_mat`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_evenement`),
  ADD KEY `id_user_evenement` (`id_user_evenement`);

--
-- Index pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`id_materiel`),
  ADD KEY `id_user_materiel` (`id_user_materiel`);

--
-- Index pour la table `produit_bureautique`
--
ALTER TABLE `produit_bureautique`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_projet`),
  ADD KEY `chef_projet` (`chef_projet`),
  ADD KEY `projet_ibfk_2` (`nom_client_projet`);

--
-- Index pour la table `reunion`
--
ALTER TABLE `reunion`
  ADD PRIMARY KEY (`id_reunion`),
  ADD KEY `id_reunion_user` (`id_reunion_user`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD PRIMARY KEY (`id_specialite`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id_tache`),
  ADD KEY `nom_projet` (`nom_projet`),
  ADD KEY `superviseur_tache` (`id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `conge`
--
ALTER TABLE `conge`
  MODIFY `id_conge` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demande_materiel`
--
ALTER TABLE `demande_materiel`
  MODIFY `id_demande_mat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `id_materiel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit_bureautique`
--
ALTER TABLE `produit_bureautique`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reunion`
--
ALTER TABLE `reunion`
  MODIFY `id_reunion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `id_specialite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `id_tache` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `conge`
--
ALTER TABLE `conge`
  ADD CONSTRAINT `conge_ibfk_1` FOREIGN KEY (`id_user_conge`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`id_user_contact`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `demande_materiel`
--
ALTER TABLE `demande_materiel`
  ADD CONSTRAINT `demande_materiel_ibfk_1` FOREIGN KEY (`id_user_demande_mat`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`id_user_evenement`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD CONSTRAINT `materiel_ibfk_1` FOREIGN KEY (`id_user_materiel`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `projet_ibfk_1` FOREIGN KEY (`chef_projet`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `projet_ibfk_2` FOREIGN KEY (`nom_client_projet`) REFERENCES `client` (`id_client`);

--
-- Contraintes pour la table `reunion`
--
ALTER TABLE `reunion`
  ADD CONSTRAINT `reunion_ibfk_1` FOREIGN KEY (`id_reunion_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `tache_ibfk_1` FOREIGN KEY (`nom_projet`) REFERENCES `projet` (`id_projet`),
  ADD CONSTRAINT `tache_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

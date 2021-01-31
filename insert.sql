--
-- Futures données a insérer pour test
--
--
-- Déchargement des données de la table auteur
--
INSERT INTO auteur (id_auteur, nom_auteur) VALUES
(1, 'Victor Hugo');
INSERT INTO auteur (id_auteur, nom_auteur) VALUES
(2, 'Stendhal');

--
-- Déchargement des données de la table livre
--
INSERT INTO livre (id_livre, titre, id_auteur) VALUES
(1, 'Les Misérables', 1),
(2, 'Le Rouge et le Noir', 1);

--
-- Déchargement des données de la table collection
--
INSERT INTO collection (id_collection, nom_collection) VALUES
(1, 'Littérature francaise'),
(2, 'Autre');

--
-- Déchargement des données de la table bougie
--
INSERT INTO bougie (id_bougie, nom_bougie, id_livre, id_collection, statut_bougie) VALUES
(1, 'Senteur magique', 1, 1, 'validée'),
(2, 'L\'Expiation', 1, 2, 'neutre'),
(3, 'Cosette', 1, 1, 'neutre'),
(4, 'Rouge', 2, 1, 'neutre'),
(5, 'Noir', 2, 1, 'neutre');

--
-- Déchargement des données de la table `odeur`
--
INSERT INTO odeur (id_odeur, nom_odeur, statut_odeur) VALUES
(1, 'Fleur d\'anus', 'idea'),
(2, 'Le Parfum', 'wish'),
(3, 'Rose', 'possess'),
(4, 'Bergamote', 'possess'),
(5, 'Cuir', 'possess');

--
-- Déchargement des données de la table `recette`
--
INSERT INTO recette (id_recette, id_bougie, id_odeur, quantité) VALUES
(1, 3, 3, '30'),
(2, 5, 5, '7');

--
-- Déchargement des données de la table `event`
--
INSERT INTO event (id, name) VALUES
(1, 'Anniversaires'),
(2, 'Mariage');

--
-- Au dessus : des inserts générés a partir de la base de données
-- Les id ne sont pas les bon mais permettent d'avoir une cohérence entre toutes les bases sur nos différentes machines
--

--
-- Création des données de la table user
-- Bien-sur l'id est généré automatiquement
--
INSERT INTO user (login, pwd, role) VALUES
('moi', '$2y$10$12apRqsSxNxxClXCsbTngunlzBKHgQS/KeKuBbUKp2bYHmK0.yu0m', 1);

--
-- Futures données a insérer pour test
--
--
-- Déchargement des données de la table auteur
--
INSERT INTO auteur (id_auteur, nom_auteur) VALUES
(1, 'Staline');


--
-- Déchargement des données de la table livre
--
INSERT INTO livre (id_livre, titre, id_auteur) VALUES
(1, 'Mon grand père', 1);


--
-- Déchargement des données de la table collection
--
INSERT INTO collection (id_collection, nom_collection) VALUES
(1, 'Channel');


--
-- Déchargement des données de la table bougie
--
INSERT INTO bougie (id_bougie, nom_bougie, id_livre, id_collection, statut_bougie) VALUES
(1, 'Senteur magique lol', 1, 1, 'validée'),
(3, 'Bougie de malade mental', 1, 1, 'neutre'),
(5, 'Bougie de malade mental', 1, 1, 'neutre'),
(11, 'Bougie de malade', 1, 1, 'neutre');

--
-- Au dessus : des inserts générés a partir de la base de données
-- Les id ne sont pas les bon mais permettent d'avoir une cohérence entre toutes les bases sur nos différentes machines
--


--
-- Création des données de la table user
-- Biensur l'id est généré automatiquement
--
INSERT INTO user (login, pwd, role) VALUES
('moi', '$2y$10$12apRqsSxNxxClXCsbTngunlzBKHgQS/KeKuBbUKp2bYHmK0.yu0m', 1);

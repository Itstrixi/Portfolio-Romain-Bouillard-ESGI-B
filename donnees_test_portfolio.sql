
-- fichier sql de donnees de test pour le portfolio de romain bouillard
-- creation de la base de donnees (a adapter si necessaire)
CREATE DATABASE IF NOT EXISTS portfolio;
USE portfolio;

-- suppression de la table si elle existe deja
DROP TABLE IF EXISTS competences;

-- creation de la table des competences
CREATE TABLE competences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    niveau INT NOT NULL CHECK (niveau BETWEEN 1 AND 5)
);

-- insertion de donnees de test
INSERT INTO competences (nom, niveau) VALUES ('C', 4);
INSERT INTO competences (nom, niveau) VALUES ('C++', 3);
INSERT INTO competences (nom, niveau) VALUES ('HTML', 5);
INSERT INTO competences (nom, niveau) VALUES ('CSS', 4);
INSERT INTO competences (nom, niveau) VALUES ('PHP', 4);
INSERT INTO competences (nom, niveau) VALUES ('Python', 5);

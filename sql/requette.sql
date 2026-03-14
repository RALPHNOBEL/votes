-- Création de la base
CREATE DATABASE vote_en_ligne;
USE vote_en_ligne;

-- Table des candidats
CREATE TABLE candidats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    parti VARCHAR(100) NOT NULL,
    age VARCHAR(255) NOT NULL,
    photo VARCHAR(255) NULL
);

-- Table des électeurs
CREATE TABLE electeurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL
);


-- Table des votes
CREATE TABLE votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    electeur_id INT NOT NULL,
    candidat_id INT NOT NULL,
    date_vote TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (electeur_id), -- un électeur ne peut voter qu'une fois
    FOREIGN KEY (electeur_id) REFERENCES electeurs(id),
    FOREIGN KEY (candidat_id) REFERENCES candidats(id)
);

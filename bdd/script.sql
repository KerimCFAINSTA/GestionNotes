CREATE DATABASE gestionnote;
USE gestionnote;

-- Table des utilisateurs (élèves et professeurs)
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    Mdp VARCHAR(255) NOT NULL,
    role ENUM('eleve', 'professeur') NOT NULL
);

-- Table des notes
CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    eleve_id INT NOT NULL,
    note DECIMAL(5,2) NOT NULL CHECK (note >= 0 AND note <= 20),
    FOREIGN KEY (eleve_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);
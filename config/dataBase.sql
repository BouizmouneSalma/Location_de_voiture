-- Création de la base de données
CREATE DATABASE location_voiture;
USE location_voiture;

-- Table client
CREATE TABLE client (
    NumClient INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(100) NOT NULL,
    Adresse VARCHAR(255) NOT NULL,
    Tele VARCHAR(15) NOT NULL
);

-- Table voiture
CREATE TABLE voiture (
    NumImmatriculation VARCHAR(20) PRIMARY KEY,
    Marque VARCHAR(50) NOT NULL,
    Modele VARCHAR(50) NOT NULL,
    Annee YEAR NOT NULL
);

-- Table contrat
CREATE TABLE contrat (
    NumContrat INT AUTO_INCREMENT PRIMARY KEY,
    NumClient INT NOT NULL,
    NumImmatriculation VARCHAR(20) NOT NULL,
    Nom VARCHAR(100) NOT NULL,
    DateDebut DATE NOT NULL,
    DateFin DATE NOT NULL,
    Duree INT NOT NULL,
    FOREIGN KEY (NumClient) REFERENCES client(NumClient),
    FOREIGN KEY (NumImmatriculation) REFERENCES voiture(NumImmatriculation)
);

-- Table sign_up
CREATE TABLE sign_up (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
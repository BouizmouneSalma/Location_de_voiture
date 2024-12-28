-- Création de la base de données
CREATE DATABASE location_voiture;
USE location_voiture;

-- Table user
CREATE TABLE `user` (
  `NumClient` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(100) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `Tele` varchar(15) NOT NULL,
  `role` enum('admin','client') NOT NULL DEFAULT 'client',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`NumClient`)
);

-- Table voiture
CREATE TABLE `voiture` (
  `NumImmatriculation` varchar(20) NOT NULL,
  `Marque` varchar(50) NOT NULL,
  `Modele` varchar(50) NOT NULL,
  `Annee` year NOT NULL,
  `Image` text NOT NULL,
  PRIMARY KEY (`NumImmatriculation`)
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


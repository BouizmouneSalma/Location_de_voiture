<?php
require_once '.././config/databasecnx.php';
require_once '.././Classes/Car.php';

// Initialisation des objets nécessaires
$db = new DatabaseConnection();
$connx = $db->getConnection();
$Car = new Car($connx);

// add voiture
if (isset($_POST['Add'])) {
    $NumImmatriculation = htmlspecialchars($_POST['NumMatricle'] ?? '');
    $Marque = htmlspecialchars($_POST['Mark'] ?? '');
    $Modele = htmlspecialchars($_POST['Model'] ?? '');
    $Annee = htmlspecialchars($_POST['1'] ?? '');
    $img = htmlspecialchars($_POST['carImage'] ?? '');

    // Gestion des fichiers envoyés
    if (isset($_FILES['carImage']) && $_FILES['carImage']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        $img = basename($_FILES['carImage']['name']);
        $uploadPath = $uploadDir . $img;

    }

    // Insertion dans la base de données
    try {
        $Car->addCar($NumImmatriculation, $Marque, $Modele, $Annee, $img);
        header('Location: .././views/listCars.php');
        exit;
    } catch (Exception $e) {
        die("Erreur lors de l'ajout de la voiture : " . $e->getMessage());
    }
}


// Mise à jour de voiture
if (isset($_POST['editveh'])) {
    $id = htmlspecialchars($_POST['NumMatricle'] ?? '');
    $Marque = htmlspecialchars($_POST['Mark'] ?? '');
    $Modele = htmlspecialchars($_POST['Model'] ?? '');
    $Annee = htmlspecialchars($_POST['vehYear'] ?? '');

    try {
        $Car->updateCar($id, $Marque, $Modele, $Annee);
        header('Location: .././views/listCars.php');
        exit;
    } catch (Exception $e) {
        die("Erreur lors de la mise à jour de la voiture : " . $e->getMessage());
    }
}

// Suppression de voiture
if (isset($_GET['NumImmatriculation'])) {
    $NumImmatriculation = htmlspecialchars($_GET['NumImmatriculation'] ?? '');

    try {
        $Car->deleteCar($NumImmatriculation);
        header('Location: .././views/listCars.php');
        exit;
    } catch (Exception $e) {
        die("Erreur lors de la suppression de la voiture : " . $e->getMessage());
    }
}
?>

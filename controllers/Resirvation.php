<?php
session_start();
require_once '.././config/databasecnx.php';
require_once '.././Classes/Contrat.php';
$db = new DatabaseConnection();
$mysqli = $db->getConnection();
$contrat = new Contrat($mysqli);

if (!isset($_SESSION['user'])) {
    echo "Veuillez vous connecter pour effectuer une réservation.";
    exit;
}
var_dump($_SESSION['user']['NumClient']);
//add reservation
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['reserve'] )) {
    $numClient = $_SESSION['user']['NumClient'];
    $numImmatriculation = $_POST['NumImmatriculation'];
    $dateDebut = $_POST['datestart'];
    $dateFin = $_POST['dataefin'];
    if(empty( $dateDebut) || empty( $dateFin) ){
        $_SESSION['invalideDate'] = "please entere Date u need to reserve";
        header('Location: ../index.php');
        exit;
    }
    $startDateTime = new DateTime($dateDebut);
    $endDateTime = new DateTime($dateFin);
    $interval = $startDateTime->diff($endDateTime);
    $duree = $interval->days;
    var_dump($numClient,$numImmatriculation ,$dateDebut,$dateFin);
    if(!empty($_SESSION['user']))
    $contrat->addContrat($numClient,$numImmatriculation ,$dateDebut,$dateFin,$duree);
    header('Location: ../index.php');
    
}
//delet reservation
if( isset( $_GET['idcontrat'] )) {
    $Numcontr = $_GET['idcontrat'];
    $reslt = $contrat->deleteContrat( $Numcontr );
    header('Location: ../index.php');

}
//update status confirm
if(isset( $_GET['NumContratId'] )) {
 $id = $_GET['NumContratId'];
 $stat = 'Confirm';
 $upd = $contrat->StatusContrat( $id , $stat );
 header('Location: .././views/listContrat.php');
}
// update status cancel
if(isset( $_GET['NumContratIdanul'])) {
    $id = $_GET['NumContratIdanul'];
    $stat = 'Annulle';
    $upd = $contrat->StatusContrat( $id , $stat );
    header('Location: .././views/listContrat.php');

   }

?>
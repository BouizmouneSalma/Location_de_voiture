<?php 

// require_once ".././config/databasecnx.php";
class voiture {
    private $cnx;
    public function __construct($cnx) {
    $this->cnx = $cnx;
    }
    // add car
    public function addCar($Marque, $Modele, $Annee) {
        $stmt = $this->cnx->prepare("INSERT INTO voiture (Marque, Modele, Annee) VALUES (?, ?, ?)");
        return $stmt->execute([$Marque,$Modele ,$Annee ]);
    }
    
    // modify car
    public function updateCar($id, $Marque, $Modele, $Annee) {
        $stmt = $this->cnx->prepare("UPDATE voiture SET Nom = ?, Adresse = ?, Tele = ? WHERE NumImmatriculation = ?");
        return $stmt->execute([$Marque, $Annee,$Modele,  $id]);
    }
    // delet car
    public function deletevoiture($id) {
        $stmt = $this->cnx->prepare("DELETE FROM voiture WHERE NumImmatriculation = ?");
        return $stmt->execute([$id]);
    }
    // get car by id
    public function getCarById($id) {
        $stmt = $this->cnx->prepare("SELECT * FROM voiture WHERE NumImmatriculation = ?");
        $stmt->execute([$id]);
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    // get all Car 
    public function getAllCars() {
        $stmt = $this->cnx->query("SELECT * FROM voiture");
        return $stmt->fetch_all(MYSQLI_ASSOC); 
    
    }

    // compteur number total voitures
    public function getCarCount() {
        $stmt = $this->cnx->query("SELECT COUNT(*)  FROM voiture");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }
}
// $w= new DatabaseConnection();
// $v=$w->getConnection();

// $voiture = new voiture($v);
// $voitures=$voiture->getCarCount();
// var_dump($voitures)  ;
?>


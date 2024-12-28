<?php 

// require_once ".././config/databasecnx.php";
class Car {
    private $cnx;

    public function __construct($cnx) {
    $this->cnx = $cnx;
    }
    // add car
    public function addCar($NumImmatriculation, $Marque, $Modele, $Annee, $Image) {
        $stmt = $this->cnx->prepare("INSERT INTO voiture (NumImmatriculation, Marque, Modele, Annee, Image) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$NumImmatriculation, $Marque, $Modele, $Annee, $Image]);
    }
    
    // modify car
    public function updateCar($id, $Marque, $Modele, $Annee,$img) {
        $stmt = $this->cnx->prepare("UPDATE voiture SET NumImmatriculation = ?, Marque = ?, Modele = ? , Annee = ? , Image = ? WHERE NumImmatriculation = '$id'");
        return $stmt->execute([$id,$Marque,$Modele,$Annee,$img]);
    }
    // delet car
    public function deleteCar($id) { 
        $stmt = $this->cnx->prepare("DELETE FROM voiture WHERE NumImmatriculation = ?");
        return $stmt->execute([$id]);
    }
    // get car by id
    public function getCarById($id) {
        $stmt = $this->cnx->prepare("SELECT * FROM voiture WHERE NumImmatriculation = ?");
        $stmt->bind_param("s", $id); 
        if ($stmt->execute()) {
            $stmt_result = $stmt->get_result(); 
            $reslt = $stmt_result->fetch_all(MYSQLI_ASSOC); 
        } 
        return $reslt;
       
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


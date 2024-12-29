<?php
class Contrat {
    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    // Ajouter un contrat
    public function addContrat($numClient, $numImmatriculation, $dateDebut, $dateFin, $duree) {
        $stmt = $this->cnx->prepare("INSERT INTO contrat (NumClient, NumImmatriculation, DateDebut, DateFin, Duree) VALUES ( ?, ?, ?, ?, ?)");
        return $stmt->execute([$numClient, $numImmatriculation, $dateDebut, $dateFin, $duree]);
    }

    // Modifier un contrat
    public function StatusContrat($id,$stat) {
        $stmt = $this->cnx->prepare("UPDATE contrat SET status= ? WHERE NumContrat = ?");
        return $stmt->execute([$stat,$id]);
    }

    // Supprimer un contrat
    public function deleteContrat($numContrat) {
        $stmt = $this->cnx->prepare("DELETE FROM contrat WHERE NumContrat = ?");
        return $stmt->execute([$numContrat]);
    }

    // Obtenir un contrat par son identifiant
    public function getContratById($numContrat) {
        $stmt = $this->cnx->prepare("SELECT * FROM contrat WHERE NumContrat = ?");
        $stmt->execute([$numContrat]);
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    // Obtenir tous les contrats
    public function getAllContrats() {
        $stmt = $this->cnx->query("SELECT * ,voiture.Modele as Modele,voiture.Image as image, user.Nom AS name FROM contrat INNER JOIN user ON contrat.NumClient = user.NumClient INNER JOIN voiture ON contrat.NumImmatriculation = voiture.NumImmatriculation");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    // Compter le nombre total de contrats
    public function getContratCount() {
        $stmt = $this->cnx->query("SELECT COUNT(*) AS total_contrats FROM contrat");
        return $stmt->fetch_all(MYSQLI_ASSOC)['total_contrats'];
    }
}
?>

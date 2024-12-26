<?php 
class Client {
    private $cnx;
    public function __construct($cnx) {
    $this->cnx = $cnx;
    }
    // add client
    public function addClient($name, $phone, $address) {
        $stmt = $this->cnx->prepare("INSERT INTO client (Nom, Adresse, Tele) VALUES (?, ?, ?)");
        return $stmt->execute([$name,$address ,$phone ]);
    }
    
    // modify client
    public function updateClient($id, $name, $phone, $address) {
        $stmt = $this->cnx->prepare("UPDATE client SET Nom = ?, Adresse = ?, Tele = ? WHERE NumClient = ?");
        return $stmt->execute([$name, $address,$phone,  $id]);
    }
    // delet client
    public function deleteClient($id) {
        $stmt = $this->cnx->prepare("DELETE FROM client WHERE NumClient = ?");
        return $stmt->execute([$id]);
    }
    // get client by id
    public function getClientById($id) {
        $stmt = $this->cnx->prepare("SELECT * FROM client WHERE NumClient = ?");
        $stmt->execute([$id]);
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    // get all client 
    public function getAllClients() {
        $stmt = $this->cnx->query("SELECT * FROM client");
        return $stmt->fetch_all(MYSQLI_ASSOC); 
    
    }

    // compteur number total clients
    public function getClientCount() {
        $stmt = $this->cnx->query("SELECT COUNT(*) AS total_clients FROM client");
        return $stmt->fetch_all(MYSQLI_ASSOC)['total_clients'];
    }
}

?>

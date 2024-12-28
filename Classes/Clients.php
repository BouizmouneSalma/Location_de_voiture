<?php 
class Client {
    private $cnx;
    public function __construct($cnx) {
    $this->cnx = $cnx;
    }
    // add client
    public function addClient($name, $phone, $address) {
        $stmt = $this->cnx->prepare("INSERT INTO user (Nom, Adresse, Tele ,password) VALUES (?, ?, ?,?)");
        return $stmt->execute([$name,$address ,$phone ,password_hash('admin',PASSWORD_DEFAULT)]);
    }
    
    // modify client
    public function updateClient($id, $name, $phone, $address) {
        $stmt = $this->cnx->prepare("UPDATE user SET Nom = ?, Adresse = ?, Tele = ? WHERE NumClient = ?");
        return $stmt->execute([$name, $address,$phone,  $id]);
    }
    // delet client
    public function deleteClient($id) {
        $stmt = $this->cnx->prepare("DELETE FROM user WHERE NumClient = ?");
        return $stmt->execute([$id]);
    }
    // get client by id
    public function getClientById($id) {
        $stmt = $this->cnx->prepare("SELECT * FROM user WHERE NumClient = ?");
        $stmt->bind_param("i", $id); // ربط المتغير مع الاستعلام
    
        if ($stmt->execute()) {
            $stmt_result = $stmt->get_result(); // الحصول على النتيجة كـ mysqli_result
            $reslt = $stmt_result->fetch_all(MYSQLI_ASSOC); // استعمال fetch_all للحصول على جميع الصفوف
        } 
        return $reslt;
       
    }
    

    // get all client 
    public function getAllClients() {
        $stmt = $this->cnx->query("SELECT * FROM user");
        return $stmt->fetch_all(MYSQLI_ASSOC); 
    
    }

    // compteur number total clients
    public function getClientCount() {
        $stmt = $this->cnx->query("SELECT COUNT(*) AS total_clients FROM user");
        return $stmt->fetch_all(MYSQLI_ASSOC)['total_clients'];
    }
}

?>

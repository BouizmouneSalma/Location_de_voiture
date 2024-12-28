<?php

class Auth {
    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx; 
    }
    public function register($Nom, $Adresse, $Tele,$password) {
        $query = $this->cnx->prepare(
            "INSERT INTO user (Nom, Adresse, Tele, password) 
             VALUES (?, ?, ?, ?)"
        );
        $params = [$Nom, $Adresse, $Tele, $password];

        return $query->execute($params); 
    }


    public function login($Nom) {
    $query = $this->cnx->prepare(
        "SELECT * FROM user WHERE Nom = ?"
    );
    $query->execute([$Nom]);
    $result = $query->get_result(); 
    $user =  $result->fetch_all(MYSQLI_ASSOC);
    
    return $user;
}
}
?>

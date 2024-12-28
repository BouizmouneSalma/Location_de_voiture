<?php
session_start();
require_once '.././config/databasecnx.php';
require_once '.././Classes/Auth.php';
$db = new DatabaseConnection();
$connx = $db->getConnection();
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signhh'])) {
        $user= $_POST['nom'];
        $psswrd = $_POST['pssword'];

        $authLogin = new Auth( $connx);
        $users = $authLogin->login($user);
      var_dump($users[0]); echo"<br>";

        if (!empty($users) && password_verify($psswrd, $users[0]['password'])) {
            $_SESSION['user'] = $users[0];
            var_dump($_SESSION['user']);
            if ($users[0]['role'] === 'client') {
                header('Location: ../index.php');
            } else {
               echo "Nom ou mot de passe incorrect."; 
            }
        } else {
            if($user === "admin" && $psswrd === "admin123") {
                $_SESSION['user'] = [
                    'Nom' => 'admin',
                    'role' => 'admin'
                ];
                header('Location: ../views/listClients.php');      
                } else {
                    echo "Nom ou mot de passe incorrect."; 
                 }
        }
    }
    

?>
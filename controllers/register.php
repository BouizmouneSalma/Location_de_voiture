<?php
require_once '.././config/databasecnx.php';
require_once '.././Classes/Auth.php';
$db = new DatabaseConnection();
$connx = $db->getConnection();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['usern'];
    $email = $_POST['emaiL'];
    $pssword = password_hash($_POST['pssw'],PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    
    $auth = new Auth($connx);
    if($auth->register($username, $email,$phone, $pssword)) {
        header('location: .././views/signup.php');
    }
}
?>
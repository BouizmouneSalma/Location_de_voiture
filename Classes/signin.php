<?php
session_start(); 
require_once './views/databasecnx.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user= $_POST['nom'];
    $psswrd = $_POST['password'];
    $sql = "select * from sign_up where username = '$user'";
    $result =  mysqli_query($cnx,$sql);
    if($result){
        $data = mysqli_fetch_assoc($result);
        if(password_verify($psswrd,$data['password'])){
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['username'] = $data['username'];
            header("Location: clients.php");
            exit();
        } else {
            echo "Invalid password!";
        } 
    } else{

      echo 'not fond this user : '. $user;
 }



}
?>

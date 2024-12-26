
<?php
 require_once '.././config/databasecnx.php';
 require_once '.././Classes/Clients.php';
 $db = new DatabaseConnection();
 $connx = $db->getConnection();
 $client = new Client( $connx);
//add client
if(isset($_POST['Add'])){
    $nomcmpl = htmlspecialchars($_POST['namecomplet']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $errors = [];
    if (empty($nomcmpl)) {
        $errors[] = "< script > alert('invalid name') < /script>";
    }
    if (empty($phone)) {
        $errors[] = "< script > alert('invalid name') < /script>";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $errors[] = "< script > alert('invalid name') < /script>";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "< script > alert('invalid name') < /script>";
    }


    if (empty($errors)) {
        //insert into
    $query =   $client->addClient( $nomcmpl, $phone, $email );
                                
    header('Location: .././views/listClients.php');
       exit;
       }else{
        $_SESSION['errors'] = $errors;
        print_r($_SESSION['errors']);
        unset($_SESSION['errors']);
     header('Location: .././views/listClients.php');
        exit;
     }
}

//updat client
// if(isset($_POST['edit'])){
//     $id = $_GET['NumClientedit'];
//     $nomcmpl = $_POST['namecomplet'];
//     $phone = $_POST['phone'];
//     $email = $_POST['email'];
//     $updt = "UPDATE `client` SET Nom='$nomcmpl', Adresse='$email', Tele='$phone' WHERE NumClient=$id";
//      $reslt = mysqli_query($cnx,$updt);
    
// header('Location: ../clients.php');
// }

?>
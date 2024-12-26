<?php
require_once './views/databasecnx.php';
if($_SERVER["REQUEST_METHOD" ] == "POST"){
    $userneme = $_POST['usern'];
    $email = $_POST['emaiL'];
    $pssword = $_POST['pssw'];
    $hide = password_hash($pssword, PASSWORD_DEFAULT);
    $sql = "insert into sign_up (username,email,password) values ('$userneme','$email','$hide')";
    $data = mysqli_query($cnx,$sql);
    $acount = false;
    if($data){
        $acount = true;
    }else {
        echo "Error: " . $sql . "<br>" . mysqli_error($cnx);
    }
}

// session_start();
// $_SESSION["username"] = "Mahjoub";
// $_SESSION['faf'] = 'pizza';
// echo 'user'.$_SESSION["username"];
// echo 'food'.$_SESSION["faf"];

header('sign.php')
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="stylesign.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Sign in / Sign up Form</title>
  </head>
  <body>
  <!-- <?php if ($acount): ?> -->
    <!-- <div id="alert-success" class="bg-blue-100 border z-50  border-green-400 text-green-700 px-4 py-3 rounded  absolute right-0 top-10" role="alert">
    <strong class="font-bold">successfully!</strong>
    <span class="block sm:inline">The account has been successfully created.</span>
    <span id="close-alert" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
      &times;
    </span>
  </div> -->
  <!-- <?php endif; ?> -->
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form method="post" action="./signin.php" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input name ="nom" type="text" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input name="password" type="password" placeholder="Password" />
            </div>
            <input type="submit" value="Login" class="btn solid" name="signhh"/>
          </form>
          <form method="post" action="#" class="sign-up-form">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input name="usern" type="text" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input name="emaiL" type="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input name="pssw" type="password" placeholder="Password" />
            </div>
            <input type="submit" class="btn" value="Sign up" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <a href="" class="logo text-[50px] font-bold h-[56px] flex items-center text-[#1976D2] z-30 pb-[20px] box-content">
        <i class=" mt-4 text-xxl max-w-[60px] flex justify-center "><i class="fa-solid fa-car-side"></i></i> 
        <div class="logoname ml-2"><span class="text-black">Loca</span>Auto</div>
    </a>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
        </div>
        <div class="panel right-panel">
          <div class="content">
          <a href="" class="logo text-[50px] font-bold h-[56px] flex items-center text-[#1976D2] z-30 pb-[20px] box-content">
        <i class=" mt-4 text-xxl max-w-[60px] flex justify-center "><i class="fa-solid fa-car-side"></i></i> 
        <div class="logoname ml-2"><span class="text-black">Loca</span>Auto</div>
    </a>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
        
        </div>
      </div>
    </div>

    <script >
        const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
});

document.addEventListener('DOMContentLoaded', function() { 
    const alert = document.getElementById('alert-success');
    if (alert) {
        setTimeout(function() {
            alert.classList.add('hidden'); 
        }, 10000);
        const closeAlert = document.getElementById('close-alert');
        closeAlert.addEventListener('click', function() {
            alert.classList.add('hidden');
        });
    }
});
    </script>
  </body>
</html>
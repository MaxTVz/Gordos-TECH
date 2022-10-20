<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
      $message[] = 'nombre de usuario o contraseña incorrectos!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login | Gordos Tech 🦍 </title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/stylelogin.css">

</head>
<body>
   


<section class="form-container">
   <form action="" method="post">
   <div class="login-container">
          <div class="login-info-container">
            <h1 class="title">Inicia sesión con</h1>
            <div class="social-login">
                <div class="social-login-element">
                    <img src="img/google.svg" alt="google-image">
                    <span>Google</span>
                </div>
                <div class="social-login-element">
                    <img src="img/facebook.svg" alt="facebook-image">
                    <span>Facebook</span>
                </div>
            </div>
            <p>O inicia sesión con</p>
            <form class="inputs-container">
                <input type="email" name="email" class="input" type="text" placeholder="Email">
                <input type="password" name="pass" class="input" type="text" placeholder="Contraseña">
                <p>Has perdido tu contraseña? <span class="span">Da clic aqui.</span></p>
                <button type="submit" value="login now" class="btn" name="submit" class="btn"><b>LOGIN</b></button>
                <p> ¿No tienes una cuenta?  <span class="span">Registrate</span></p>
            </form>
          </div>
            <img class="image-container"  src="img/login.png" alt="" align="center">
      </div>
</section>















<script src="js/script.js"></script>

</body>
</html>
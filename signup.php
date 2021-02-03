<?php
require 'inc/Autoloader.php';

if (!empty($_POST))
  {
  $errors = array();
	$db = App::getDatabase();
  $validator = new Validator($_POST);
  if($_POST['accountType'] == "1") {
        if($validator->isEmail('email',"Votre email n'est pas valide")){
          $validator->isUniq('email', $db, 'users', "Cet email est déja utilisé pour un autre compte");
        }
        $validator->isConfirmed('password', 'password2', 'Vous devez entrer un mot de passe valide');
        if ($validator->isValid())
        {
          $Auth = new Auth;
          $Auth->register($db,$_POST['email'],$_POST['login'],$_POST['password'],"users");
          Session::getInstance()->setFlash('success','Votre compte est bien créer');
          App::redirect('signin.php');
        }
        else
        {
          $errors = $validator->getErrors();
        }
  }else{
        if($validator->isEmail('email',"Votre email n'est pas valide")){
          $validator->isUniq('email', $db, 'organisations', "Cet email est déja utilisé pour un autre compte");
        }
        $validator->isConfirmed('password', 'password2', 'Vous devez entrer un mot de passe valide');
        if ($validator->isValid())
        {
          $Auth = new Auth;
          $Auth->register($db,$_POST['email'],$_POST['login'],$_POST['password'],"organisations");

          Session::getInstance()->setFlash('success','Votre compte est bien créer');
          App::redirect('account_created.html');
        }
        else
        {
          $errors = $validator->getErrors();
        }
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon-16x16.png">
    <link rel="mask-icon" href="assets/images/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Noureddine Ettalhaouy, Ismail Chakrane , Faysal Belkhchicha ">
    <meta name="generator" content="Hugo 0.79.0">
    <title>S'inscrire | We-Share</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="assets/styles/signin&signup.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin-signup">
  <form action="" method="POST">
    <img class="mb-4 rounded-circle" src="assets/images/We-Share-logo.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal"> S'inscrire </h1>
   
    <label for="inputUserName" class="visually-hidden">Nom d'utlisateur</label>
    <input type="text" id="inputUserName" name="login" class="form-control" placeholder="Nom d'utlisateur" required autofocus>
    
    <label for="inputEmail" class="visually-hidden">Adresse e-mail</label>
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Adresse e-mail" required autofocus>
    
    <label for="inputPassword" class="visually-hidden">Mot de passe</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required>
    
    <label for="inputPassword2" class="visually-hidden">Confirmer le Mot de passe</label>
    <input type="password" id="inputPassword2" name="password2" class="form-control" placeholder="Confirmer le Mot de passe" required>
    
    <div class="input-group mb-3">
      <select class="form-select" id="inputAcountType" name="accountType" required>
        <option selected hidden >Type de compte..</option>
        <option value="1">Personnel</option>
        <option value="2">Organisation</option>
      </select>
    </div>

    <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> J'accepte les <a href="#">conditions d'utilisation</a>
        </label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">S'inscrire </button>
    <p class="mt-5 mb-3 text-muted">&copy; We Share 2021</p>
  </form>
</main>


    
  </body>
</html>

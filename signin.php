<?php
require 'inc/Autoloader.php';


if (!empty($_POST)) {
    //connect to db
    $db = App::getDatabase();
    $validator = new Validator($_POST);

    //verifications
    if ($validator->notVerified($db, 'email')) {
        Session::getInstance()->setFlash('danger', 'Compte non vérifié ou invalid');
        App::redirect('signin.php');
    }
    if ($validator->accountValid('email', 'password', $db)) {

        $user = $validator->accountValid('email', 'password', $db);
        Session::getInstance()->write('genre', "2");
        Session::getInstance()->write('auth', $user);
        Session::getInstance()->write('id', $user->id);
        Session::getInstance()->setFlash('success', "Bienvenue " . $user->login . " !");
        App::redirect('index.php');
    } else {
        Session::getInstance()->setFlash('danger', 'Email, mot de passe ou type de compte incorrecte');
        App::redirect('signin.php');
    }

}

?>

  <?php include 'layouts/login_header.html';?>
    <title>Se connecter | We-Share</title>
    <link rel="stylesheet" type="text/css" href="assets/styles/form-validation.css">
  </head>
  <body class="text-center">

<main class="form-signin-signup">
  <form action="" method="POST">
    <img class="mb-4 rounded-circle" src="assets/images/We-Share-logo.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal"> Se connecter </h1>

    <!-- flash controle -->
    <?php if (Session::getInstance()->hasFlashes()): ?>
     <?php foreach (Session::getInstance()->getFlashes() as $type => $message): ?>
       <div class="alert alert-<?=$type;?>">
          <div><?=$message;?></div>
       </div>
     <?php endforeach;?>
   <?php endif;?>


    <label for="inputEmail" class="visually-hidden">Adresse e-mail</label>
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Adresse e-mail" required autofocus>

    <div id="emailErrorMsg" class="col-md-auto">
      <p id="emailError" class="invalid"><b>Email format must be correct</b></p>
    </div>

    <label for="inputPassword"  class="visually-hidden">Mot de passe</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>


    <div id="message" class="col-md-auto">
      <h6>Password must contain the following:</h6>
      <p id="letter" class="invalid"><b>lowercase letter</b></p>
      <p id="capital" class="invalid"><b>capital (uppercase) letter</b></p>
      <p id="number" class="invalid"><b>number</b></p>
      <p id="length" class="invalid"><b>Minimum 8 characters</b></p>
    </div>
    
    <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter </button><br>
    <a href="signup.php" style="margin-top:20px;">S'inscrire</a>
    <p class="mt-5 mb-3 text-muted">&copy; We Share 2021</p>
  </form>
</main>
  </body>
</html>
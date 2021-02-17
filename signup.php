<?php
require 'inc/Autoloader.php';

if (!empty($_POST))
  {
  $errors = array();
	$db = App::getDatabase();
  $validator = new Validator($_POST);
  if($_POST['accountType'] == "1") {
        if($validator->isEmail('email',"Votre email est invalide")){
          $validator->isUniq('email', $db, 'users', "Cet email est déja utilisé pour un autre compte");
        }
        $validator->isConfirmed('password', 'password2', 'Votre mot de passe est invalide');
        if ($validator->isValid())
        {
          $Auth = new Auth;
          $Auth->register($db,$_POST['email'],$_POST['login'],$_POST['password'],"users");
          Session::getInstance()->setFlash('success','Votre compte a été créé avec succès');
          App::redirect('signin.php');
        }
        else
        {
          $errors = $validator->getErrors();
        }
  }else{
        if($validator->isEmail('email',"Votre email est invalide")){
          $validator->isUniq('email', $db, 'organisations', "Cet email est déja utilisé pour un autre compte");
        }
        $validator->isConfirmed('password', 'password2', 'Votre mot de passe est invalide');
        if ($validator->isValid())
        {
          $Auth = new Auth;
          $Auth->register($db,$_POST['email'],$_POST['login'],$_POST['password'],"organisations");
          App::redirect('layouts/account_created.html');
        }
        else
        {
          $errors = $validator->getErrors();
        }
  }
}
?>

<?php include 'layouts/login_header.html';?>
    <title>S'inscrire | We-Share</title>
</head>
   
  <body class="text-center">
    
<main class="form-signin-signup">
  <form action="" method="POST">
    <img class="mb-4 rounded-circle" src="assets/images/We-Share-logo.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal"> S'inscrire </h1>

        <!-- errors controle -->
        <?php  if (!empty($errors)):?>
      <div class="alert alert-danger">
        <p>Votre demande a subi des problémes lors du traitement :</p>
        <?php foreach ($errors as $error): ?>
          <ul>
            <li><?= $error; ?></li>
          <?php endforeach; ?>
          </ul>
      </div>
    <?php endif; ?>


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
        <option selected hidden >Type de compte...</option>
        <option value="1">Personnel</option>
        <option value="2">Organisationnel</option>
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

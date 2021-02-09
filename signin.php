
<?php
require 'inc/Autoloader.php';

if (!empty($_POST)){
  $db = App::getDatabase();
  $validator = new Validator($_POST);

  if($validator->accountValid('email','password',$db,$_POST['accountType']))
  {

    $user = $validator->accountValid('email','password',$db,$_POST['accountType']);
    Session::getInstance()->write('genre', $_POST['accountType']);
    Session::getInstance()->write('auth', $user);
    Session::getInstance()->write('id', $user->id);
    Session::getInstance()->setFlash('success','Bien connecté');
    App::redirect('home.php');
  }
  else{
    Session::getInstance()->setFlash('danger','Email ou mot de passe incorrecte');
    App::redirect('signin.php');
  }
}

?>

  <?php include 'layouts/login_header.html';?>
    <title>Se connecter | We-Share</title>
  </head>
  <body class="text-center">
    
<main class="form-signin-signup">
  <form action="" method="POST">
    <img class="mb-4 rounded-circle" src="assets/images/We-Share-logo.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal"> Se connecter </h1>

    <!-- errors controle -->
    <?php  if (!empty($errors)):?>
      <div class="alert alert-danger">
        <p>Vous n'avez pas uploader les fichiers  correctement</p>
        <?php foreach ($errors as $error): ?>
          <ul>
            <li><?= $error; ?></li>
          <?php endforeach; ?>
          </ul>
      </div>
    <?php endif; ?>

    <!-- flash controle -->
    <?php if (Session::getInstance()->hasFlashes()): ?>
     <?php foreach (Session::getInstance()->getFlashes() as $type => $message): ?>
       <div class="alert alert-<?=$type; ?>"><li><?=$message; ?> </li></div>
     <?php endforeach; ?>
   <?php endif;?>


    <label for="inputEmail" class="visually-hidden">Adresse e-mail</label>
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Adresse e-mail" required autofocus>
    
    <label for="inputPassword"  class="visually-hidden">Mot de passe</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required>
 
    <div class="input-group mb-3">
      <select class="form-select" id="inputAcountType" name="accountType" required>
        <option selected hidden >Type de compte..</option>
        <option value="1">Personnel</option>
        <option value="2">Organisation</option>
      </select>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter </button>
    <p class="mt-5 mb-3 text-muted">&copy; We Share 2021</p>
  </form>
</main>

  
  </body>
</html>

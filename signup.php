<?php
require 'inc/Autoloader.php';

if (!empty($_POST)) {
  $errors = array();
  $db = App::getDatabase();
  $validator = new Validator($_POST);

    if ($validator->isEmail('email', "Votre email est invalide")) {
      $validator->isUniq('email', $db, 'organisations', "Cet email est déja utilisé pour un autre compte");
    }
    $validator->isConfirmed('password', 'password2', 'Le mot de passe est invalide');

    if ($validator->isValid()) {
      $Auth = new Auth;
      $Auth->register($db, $_POST['email'], $_POST['login'], $_POST['password'], $_POST['rib'],"organisations");
      App::redirect('layouts/account_created.html');
    } else {
      $errors = $validator->getErrors();
    }
}
?>

<?php include 'layouts/login_header.html'; ?>
<title>S'inscrire | We-Share</title>
<link rel="stylesheet" type="text/css" href="assets/styles/form-validation.css">
</head>

<body class="text-center">

  <main class="form-signin-signup">
    <form action="" method="POST">
      <img class="mb-4 rounded-circle" src="assets/images/We-Share-logo.png" alt="" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal"> S'inscrire </h1>

      <!-- errors controle -->
      <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
          <p>Votre demande a subi des problémes lors du traitement :</p>
          <?php foreach ($errors as $error) : ?>
              <div><?= $error; ?></div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>


      <label for="inputUserName" class="visually-hidden">Nom d'utlisateur</label>
      <input type="text" id="inputUserName" name="login" class="form-control" placeholder="Nom d'utlisateur" required autofocus>

      <label for="inputEmail" class="visually-hidden">Adresse e-mail</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Adresse e-mail" required autofocus>

      <div id="emailErrorMsg" class="col-md-auto">
        <p id="emailError" class="invalid"><b>Email format must be correct</b></p>
      </div>
      
      <label for="rib" class="visually-hidden">Rib number</label>
      <input type="text" id="rib" name="rib" class="form-control" placeholder="Numéro RIB" minlength="23" maxlength="23" required autofocus>


      <label for="inputPassword" class="visually-hidden">Mot de passe</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>

      <label for="inputPassword2" class="visually-hidden">Confirmer le Mot de passe</label>
      <input type="password" id="inputPassword2" name="password2" class="form-control" placeholder="Confirmer le Mot de passe" required>

      <div id="message" class="col-md-auto">
        <h6>Password must contain the following:</h6>
        <p id="letter" class="invalid"><b>lowercase letter</b></p>
        <p id="capital" class="invalid"><b>capital (uppercase) letter</b></p>
        <p id="number" class="invalid"><b>number</b></p>
        <p id="length" class="invalid"><b>Minimum 8 characters</b></p>
      </div>
      <div id="message2" class="col-md-auto">
        <p id="pwdMatch" class="invalid"><b>Password must be the same</b></p>
      </div>
      <button id="signUpBtn" class="w-100 btn btn-lg btn-primary" type="submit">S'inscrire </button><br>
      <a href="signin.php" style="margin-top:20px;">Se connecter</a>
      <p class="mt-5 mb-3 text-muted">&copy; We Share 2021</p>
    </form>
  </main>
  <script src="assets/JS/form-validation.js"></script>
</body>

</html>
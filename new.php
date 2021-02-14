<?php
require 'inc/Autoloader.php';


  if (empty(Session::getInstance()->read('id'))) {
  Session::getInstance()->setFlash('danger','Vous devez etre connecté');
  App::redirect('signin.php');
}
if ( !empty($_POST) && !empty($_FILES)) {
    $db = App::getDatabase();
    $errors = [];
   if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_FILES['img']) ){

    $session_id = Session::getInstance()->read('id');
    $name_file = $_FILES['img']['name'];
    $name_extension = strrchr($name_file, ".");
    $extensions_autorisation = array('.png','.PNG','.jpg','.JPG');
    $file_tmp_name = $_FILES['img']['tmp_name'];
    $file_dest = 'uploads/'.$name_file;
    $date =  date("Y-m-d H:i:s");

    if (in_array($name_extension, $extensions_autorisation)) {
        if (move_uploaded_file( $file_tmp_name,$file_dest)) {
  
        $insert = $db->query("INSERT INTO advertisements (title, photo, Description,date,id_organisaton)
        VALUES (?,?,?,?,?)",[$_POST['title'],$file_dest,$_POST['description'],$date,$session_id]);
  
         Session::getInstance()->setFlash('success','Annonce bien crée');
         App::redirect('my.php');
       }
     }
     else{
        $errors['img']= "Pour l'images seuls les extenetions PNG ou JPG sont autorisées";
      }
  }
  else{
    $errors[]="tous les champs doivent être remplis";
  }
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon-16x16.png">
    <link rel="mask-icon" href="assets/images/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle annonce</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
</head>
<body>
    <center style="margin-top: 5%;" >
    <form method="POST" action="" enctype="multipart/form-data">
        
        <div class="col-md-7 col-lg-8">
          <h3 class="mb-3">Ajouter une nouvelle annonce </h3>

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

            <div class="row g-3">
                <div class="col-sm-10">
                    <label for="InputTitle" class="form-label visually-hidden">Titre de l'annonce</label>
                    <input type="text" class="form-control" name ="title" id="InputTitle" placeholder="Titre de l'annonce" value="" required>
                </div>
                <div class="col-sm-10">
                    <label class="form-label visually-hidden" for="customFile">Choisie une image pour votre annonce</label>
                    <input type="file" class="form-control" name ="img" id="customFile" placeholder="Choisie une image pour votre annonce" required />
                </div>
                <div class="col-sm-10">
                    <label for="InputDiscription" class="form-label visually-hidden">Discription de l'annonce</label>
                    <textarea type="text" name ="description" class="form-control" id="InputDiscription" placeholder="Vuillez saisir la discription de l'annonce" value="" required></textarea>
                </div>
                <div class="d-grid col-6 mx-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
        
    </form>
</center>
</body>
</html>

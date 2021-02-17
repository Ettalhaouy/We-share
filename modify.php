
<?php
require 'inc/Autoloader.php';


if (empty(Session::getInstance()->read('id'))) {
    Session::getInstance()->setFlash('danger','Vous devez être connecté');
    App::redirect('signin.php');
  }


$db = App::getDatabase();
$id = Session::getInstance()->read('id_modif');
$query = $db->query('SELECT * FROM advertisements WHERE id=?',[$id])->fetch();;
$date =  date("Y-m-d H:i:s");
$status = false;
$errors = [];
if (!empty($_POST['title'])) {
    $insert = $db->query("UPDATE advertisements SET title=?,date=? WHERE id=?",[$_POST['title'],$date,$id]);
    $status = true;
}

if (!empty($_POST['description'])) {
    $insert = $db->query("UPDATE advertisements SET Description=?,date=?  WHERE id=?",[$_POST['description'],$date,$id]);
    $status = true;

}




if (!empty($_FILES['img'])) {

    $name_file = $_FILES['img']['name'];
    $name_extension = strrchr($name_file, ".");
    $extensions_autorisation = array('.png','.PNG','.jpg','.JPG');
    $file_tmp_name = $_FILES['img']['tmp_name'];
    $file_dest = 'uploads/'.$name_file;
    
    if (in_array($name_extension, $extensions_autorisation)) {
        if (move_uploaded_file( $file_tmp_name,$file_dest)) {
        $insert = $db->query("UPDATE advertisements SET photo=?,date=? WHERE id=?",[$file_dest,$date,$id]);
       }
       $status = true;
     }
     else{
        $errors["img"] = "Pour l'image seuls les extensions PNG ou JPEG sont autorisées";
      }
      
}

if($status){
    Session::getInstance()->setFlash('success','La modification a été mise en place');
    App::redirect('my.php');
}

?>

  <?php include 'layouts/login_header.html';?>
    <title>Modifier Annonce | We-Share</title>
    <style>
        html,body {
        height: 100%;
        }

        body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        }

        img{ width: 200px; height: 200px;}
        .form-signin-signup {
        width: 100%;
        max-width: 55%;
        padding: 15px;
        margin: auto;
        }

        .form-signin-signup .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
        }
        .form-signin-signup .form-select {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
        }

        .form-signin-signup .form-control:focus {
        z-index: 2;
        }
        .form-signin-signup input[type="text"] {
        margin-bottom: 10px;
        border-radius: 5px;

        }
        .form-signin-signup input[type="email"] {
        margin-bottom: 10px;
        border-radius: 5px;

        }
    
        .form-signin-signup input[type="file"] {
        margin-bottom: 10px;
        border-radius: 5px;
        
        }
        textarea {
        margin-bottom: 10px;
        border-radius: 5px;
        
        }
        .form-signin-signup button{
            max-width: 40%;
        }

    </style>
  </head>
  <body class="text-center">
    
<main class="form-signin-signup">
  <form action="" method="POST" enctype="multipart/form-data">
    <img class="mb-4 rounded-circle" src="assets/images/We-Share-logo.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Modifier L'annonce</h1>

    <!-- errors controle -->
    <?php  if (!empty($errors)):?>
      <div class="alert alert-danger">
        <p>Votre modification a connu des problèmes lors de la soumission :</p>
        <?php foreach ($errors as $error): ?>
          <ul>
            <li><?= $error; ?></li>
          <?php endforeach; ?>
          </ul>
      </div>
    <?php endif; ?>


    <label for="inputEmail" class="visually-hidden">Choisissez un titre convenable</label>
    <input type="text" id="inputEmail" name="title" class="form-control" placeholder="Choisissez un titre convenable" value="<?php echo $query->title; ?>"  autofocus>

    <label class="form-label visually-hidden" for="customFile">Choisissez une image pour votre annonce</label>
    <input type="file" class="form-control" name ="img" id="customFile" placeholder="Choisissez une image pour votre annonce"  />
    
    <label for="InputDiscription" class="form-label visually-hidden">Choisissez une description convenable</label>
    <textarea type="text" name ="description" class="form-control" id="InputDiscription" placeholder="Choisissez une description convenable" value="prev" rows="6" cols="50" ><?php echo $query->Description; ?>
    </textarea>
            

    <button class="w-100 btn btn-lg btn-primary" type="submit">Modifier</button>
    <p class="mt-5 mb-3 text-muted">&copy; We Share 2021</p>
  </form>
</main>

  
  </body>
</html>

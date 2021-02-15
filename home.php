<?php
require 'inc/Autoloader.php';


  if (empty(Session::getInstance()->read('id'))) {
  Session::getInstance()->setFlash('danger','Vous devez etre connecté');
  App::redirect('signin.php');
}

$type_account = Session::getInstance()->read('genre');

if($type_account == "1"){
  $session_id = Session::getInstance()->read('id');
  $db = App::getDatabase();
  $account = $db->query('SELECT login FROM users  WHERE id = ?',[$_SESSION['id']])->fetch();
}else{
    $session_id = Session::getInstance()->read('id');
    $db = App::getDatabase();
    $account = $db->query('SELECT login FROM organisations  WHERE id = ?',[$_SESSION['id']])->fetch();
}

$advertisements = $db->query('SELECT * FROM advertisements',[])->fetchAll();
$nb_advertisements = $db->query('SELECT COUNT(*) as nb FROM advertisements ',[])->fetch();
$nb_ads = (int)$nb_advertisements->nb;




?>
<?php include 'layouts/private_header.html'; ?>

    <!-- flash controle -->
    <?php if (Session::getInstance()->hasFlashes()): ?>
     <?php foreach (Session::getInstance()->getFlashes() as $type => $message): ?>
       <div class="alert alert-<?=$type; ?>"><li><?=$message; ?> </li></div>
     <?php endforeach; ?>
   <?php endif;?>

<?php  if ($nb_ads > 0):?>

    <!-- Page Content -->
  <div class="container" style="margin-top: 3%;">
    <div class="row justify-content-around">

<?php 

    for($i = 0; $i < $nb_ads; $i++) {

      $id = (int)$advertisements[$i]->id;
      $current_ads = $db->query('SELECT title,nb_Donation,id_organisaton,photo,date,SUBSTRING(Description, 1, 160) as text FROM `advertisements` WHERE id = ?; ',[$id])->fetch();
      $org = $db->query('SELECT * FROM organisations WHERE id = ?; ',[$current_ads->id_organisaton])->fetch();
     if($type_account == "1") {
     echo '
  
      <div class="col-lg-5 mb-3 shadow p-3 mb-5 bg-white rounded align-items-center">
        <div class="card h-100">
        <form method="POST" action="about_ads.php">
          <a href="#"><img class="card-img-top" src="'.$current_ads->photo.'" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">'. $current_ads->title.'</a>
            </h4>
            <span id="id_hide'.$id.'" hidden>'.$id.'</span>
            <P class="card-text"> <a href="#">'.$org->login.'</a>  | '.$current_ads->date.'</P>
            <p class="card-text">'.$current_ads->text.'....<br> 
                <a href="#">Lire plus</a>
            </p>
            <hr>
            <svg class="d-inline" style="margin-left: 20px;" xmlns="http://www.w3.org/2000/svg" width="35" height="50" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
            </svg>
            <h4 class="d-inline" style="margin-left: 200px;"><span>'.$current_ads->nb_Donation .'</span> DH</h4>
            <hr>
            <button type="button" onclick="myFunction'.$id.'()" class="btn btn-primary btn-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                    <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                    <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
                </svg>
                Donate
            </button>
            <button type="button" class="btn btn-secondary btn-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16">
                    <path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"/>
                </svg>
                Share
            </button>
            <button type="button" class="btn btn-secondary btn-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
                À propos de l\'organisation
            </button>
          </div>
          <script>
          function myFunction'.$id.'() {
         
          let var_id'.$id.' =  document.getElementById("id_hide'.$id.'").innerText;
          let link = "http://localhost/We-share/about_ads.php?id=" + var_id'.$id.';
          window.open(link,"_self");
          }
      </script>
          <form>
        </div>
      </div>

      ';}
      else{
        echo '
      <div class="col-lg-5 mb-3 shadow p-3 mb-5 bg-white rounded align-items-center">
      <div class="card h-100">
      <form method="POST" action="about_ads.php">
        <a href="#"><img class="card-img-top" src="'.$current_ads->photo.'" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">'. $current_ads->title.'</a>
          </h4>
          <span id="id_hide'.$id.'" hidden>'.$id.'</span>
          <P class="card-text"> <a href="#">'.$org->login.'</a>  | '.$current_ads->date.'</P>
          <p class="card-text">'.$current_ads->text.'....<br> 
              <a href="#">Lire plus</a>
          </p>
          <hr>
          <svg class="d-inline" style="margin-left: 20px;" xmlns="http://www.w3.org/2000/svg" width="35" height="50" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
              <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
              <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
          </svg>
          <h4 class="d-inline" style="margin-left: 200px;"><span>'.$current_ads->nb_Donation .'</span> DH</h4>
          <hr>
          <button type="button" onclick="myFunction'.$id.'()" class="btn btn-primary btn-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                  <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                  <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
              </svg>
              Consulter
          </button>
          <button type="button" class="btn btn-secondary btn-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16">
                  <path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"/>
              </svg>
              Share
          </button>
          <button type="button" class="btn btn-secondary btn-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
              </svg>
              À propos de l\'organisation
          </button>
        </div>
        <script>
        function myFunction'.$id.'() {
       
        let var_id'.$id.' =  document.getElementById("id_hide'.$id.'").innerText;
        let link = "http://localhost/We-share/about_ads.php?id=" + var_id'.$id.';
        window.open(link,"_self");
        }
    </script>
        <form>
      </div>
    </div>

    ';
      }
    }
  ?>    
    
    </div>
  </div>

<?php  else: ?>
  <style>

    .display-3{
      margin: 15%;
      
    }
  </style>
  <center>
  <h1 class="display-3">No content yet !</h1>
  <center>
<?php  endif; ?>

</body>
</html>
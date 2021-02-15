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
  $account = $db->query('SELECT login FROM users  WHERE id = ?',[$session_id])->fetch();
}else{
    $session_id = Session::getInstance()->read('id');
    $db = App::getDatabase();
    $account = $db->query('SELECT login FROM organisations  WHERE id = ?',[$session_id])->fetch();
}


?>

<?php include 'layouts/private_header.html'; ?>

    <!-- flash controle -->
    <?php if (Session::getInstance()->hasFlashes()): ?>
     <?php foreach (Session::getInstance()->getFlashes() as $type => $message): ?>
       <div class="alert alert-<?=$type; ?>"><li><?=$message; ?> </li></div>
     <?php endforeach; ?>
   <?php endif;?>


<?php  if ($type_account == "1"):?>


    <div class="container">
        <div class="table-responsive">
            <table class="table text-md-center mt-5">
                <thead>
                    <tr class="bg-secondary">
                        <th class="col-4">Title</th>
                        <th class="col-4">Date</th>
                        <th class="col-1">Amount</th>
                    </tr>
                </thead>

                <?php 
                // ! to implement later
                $advertisements = $db->query('SELECT COUNT(*) as nb FROM `donations` WHERE id_user = ? ',[$session_id])->fetch();
                $nb_ann = (int)$advertisements->nb;
                for($i = 0; $i < $nb_ann; $i++) {
                echo '
                <tr>
                    <td>Title_var</td>
                    <td>date_var</td>
                    <td>date_var</td>
                </tr>';
                }
                ?>
              
            </table>
          </div>
    </div>



<?php  else: ?>

    <div class="container">
        <div class="table-responsive">
            <form method="POST" action="new.php">
            <table class="table text-md-center mt-5">
                <thead>
                    <tr class="bg-secondary">
                        <th class="col-4">Title</th>
                        <th class="col-4">Date</th>
                        <th class="col-1">Edit</th>
                    </tr>
                </thead>
                <?php
                $advertisements = $db->query('SELECT COUNT(*) as nb FROM `advertisements` WHERE id_organisaton = ?',[$session_id])->fetch();
                $nb_ads = (int)$advertisements->nb;
                $ids = $db->query('SELECT id FROM `advertisements` WHERE id_organisaton = ?; ',[$session_id])->fetchAll();
                
                    for($i = 0; $i < $nb_ads; $i++) {
                        $id = (int)$ids[$i]->id;
                        $current_ads = $db->query('SELECT * FROM `advertisements` WHERE id = ?; ',[$id])->fetch();
                        
                echo '
                    <tr>
                        <td> '.$current_ads->title.'</td>
                        <td>'.$current_ads->date.'</td>
                        <span id="id_hide'.$id.'" hidden>'.$id.'</span>
                        <td class="text-md-center">
                            <button type="button" onclick="delete'.$id.'()" class="btn btn-danger">Suprimmer</button>
                        </td>
                    </tr>
                    <script>
                    function delete'.$id.'() {
                   
                    let var_id'.$id.' =  document.getElementById("id_hide'.$id.'").innerText;
                    let link = "http://localhost/We-share/delete.php?id=" + var_id'.$id.';
                    window.open(link,"_self");
                    }
                      </script> '
                      ;
                    }
                ?>
              
            </table>
          </div>
          <div class="d-flex justify-content-center mt-lg-5">
            <button class="btn btn-primary" type="submit">
                <a href="new.php" style="color:white;text-decoration:none;"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                    <path d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
                Ajouter une annonce
            </button>
                </a>
            <form>
          </div>
    </div>
<?php  endif; ?>



</body>
</html>
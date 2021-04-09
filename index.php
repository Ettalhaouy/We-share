<?php
require 'inc/Autoloader.php';

$type_account = Session::getInstance()->read('genre');


$db = App::getDatabase();

$advertisements = $db->query('SELECT * FROM advertisements', [])->fetchAll();
$nb_advertisements = $db->query('SELECT COUNT(*) as nb FROM advertisements ', [])->fetch();
$nb_ads = (int) $nb_advertisements->nb;

?>
<?php include 'layouts/private_header.html'; ?>

<!-- flash controle -->
<?php if (Session::getInstance()->hasFlashes()) : ?>
  <?php foreach (Session::getInstance()->getFlashes() as $type => $message) : ?>
    <div class="alert alert-<?= $type; ?>">
      <div><?= $message; ?> </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

<?php if ($nb_ads > 0) : ?>

  <!-- Page Content -->
  <div class="container" style="margin-top: 3%;">
    <div class="row justify-content-around">
      <?php
      for ($i = 0; $i < $nb_ads; $i++) {

        $id = (int) $advertisements[$i]->id;
        $current_ads = $db->query('SELECT title,nb_Donation,id_organisaton,photo,date,SUBSTRING(Description, 1, 160) as text FROM `advertisements` WHERE id = ?; ', [$id])->fetch();
        $orgId = (int) $current_ads->id_organisaton;
        $org = $db->query('SELECT * FROM organisations WHERE id = ?; ', [$current_ads->id_organisaton])->fetch();
        $randNumModel = rand(0,100);
                
        if (empty(Session::getInstance()->read('id'))) {
          echo '
    <div class="col-lg-4 mb-3 shadow p-3 mb-5 bg-white rounded align-items-center">
    <div class="card h-100">
    <form method="POST" action="about_ads.php">
      <a href="#"><img class="card-img-top" width="700" height="300" src="' . $current_ads->photo . '" alt=""></a>
      <div class="card-body">
        <h4 class="card-title">
          <a href="#">' . $current_ads->title . '</a>
        </h4>
        <span id="id_hide' . $id . '" hidden>' . $id . '</span>
        <P class="card-text"> <a href="#">' . $org->login . '</a>  | ' . $current_ads->date . '</P>
        <p class="card-text">' . $current_ads->text . '....<br>
            <a href="http://localhost/We-share/about_ads.php?id=' . $id . '">Lire plus</a>
        </p>
        <hr>
        <svg class="d-inline" style="margin-left: 20px;" xmlns="http://www.w3.org/2000/svg" width="35" height="50" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
            <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
            <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
        </svg>
        <h4 class="d-inline" style="margin-left: 6%;"><span>' . $current_ads->nb_Donation . '</span> DH</h4>
        <hr>
        <button type="button" onclick="myFunction' . $id . '()" class="btn btn-primary btn-block">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
            </svg>
            Faire un don
        </button>
        <button type="button" data-toggle="modal" data-target="#myModal' . $randNumModel . '" class="btn btn-secondary btn-block">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
            </svg>
            À propos de l\'organisation
        </button>
      </div>
        <script>
          function myFunction' . $id . '() {

          let var_id' . $id . ' =  document.getElementById("id_hide' . $id . '").innerText;
          let link = "http://localhost/We-share/about_ads.php?id=" + var_id' . $id . ';
          window.open(link,"_self");
          }
        </script>
              <script>
              fetch("extrainfos.json")
              .then(response => response.json())
              .then(data => {
                id = ' . $org->id . ';
                console.log(id);
                for(i=0;i<Object.keys(data[id]).length ;i++){
                  const header =  `<div class="header">${Object.keys(data[id])[i]}</div>`;
                  const content = `<div class="content">${Object.values(data[id])[i]}</div>`;
                  document.getElementById(\'modal-elt' . $randNumModel . '\').innerHTML += header;
                  document.getElementById(\'modal-elt' . $randNumModel . '\').innerHTML += content;
                }
              })
              </script>
          <style>
            .header{
              color:#025CE2;
              font-size: 1.5rem;
              text-transform: uppercase;
            }
            .content{
              font-size: 1.25rem;
              font-style: oblique;
              margin-bottom: 10%;
            }
          </style>
          <!-- The Modal -->
          <div class="modal fade" id="myModal' . $randNumModel . '">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
    
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">À propos de ' . $org->login . '</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
    
              <!-- Modal body -->
              <div class="modal-body">
                <center>
                <img style="width: 40%; height: 10%; border-radius: 50%;" class="mb-4 rounded-circle" src="assets/images/We-Share-logo.png" alt="">
                <br>
                <div id="modal-elt' . $randNumModel . '"></div>
    
                <p class="mt-5 mb-3 text-muted">&copy; We Share 2021</p>
                </center>
              </div>
    
              <!-- Modal footer -->
              <div class="modal-footer">
    
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
    
            </div>
          </div>
        </div>  
      <form>
    </div>
  </div>
      ';
 
        } else {
          echo '
      <div class="col-lg-4 mb-3 shadow p-3 mb-5 bg-white rounded align-items-center">
      <div class="card h-100">
      <form method="POST" action="about_ads.php">
        <a href="#"><img class="card-img-top" width="700" height="300" src="' . $current_ads->photo . '" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">' . $current_ads->title . '</a>
          </h4>
          <span id="id_hide' . $id . '" hidden>' . $id . '</span>
          <P class="card-text"> <a href="#">' . $org->login . '</a>  | ' . $current_ads->date . '</P>
          <p class="card-text">' . $current_ads->text . '....<br>
              <a href="http://localhost/We-share/consult.php?id=' . $id . '">Lire plus</a>
          </p>
          <hr>
          <svg class="d-inline" style="margin-left: 20px;" xmlns="http://www.w3.org/2000/svg" width="35" height="50" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
              <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
              <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
          </svg>
          <h4 class="d-inline" style="margin-left: 6%;"><span>'. $current_ads->nb_Donation.' </span>DH</h4>
          <hr>
          <button type="button"  onclick="consult' . $id . '()"  class="btn btn-primary btn-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cursor-fill" viewBox="0 0 16 16">
              <path d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103z"/>
              </svg>
              Consulter
          </button>
          <button type="button"  data-toggle="modal" data-target="#myModal' . $randNumModel. '"  class="btn btn-secondary btn-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
              </svg>
              À propos de l\'organisation
          </button>
        </div>
        <script>
        function consult' . $id . '() {

        let var_id' . $id . ' =  document.getElementById("id_hide' . $id . '").innerText;
        let link = "http://localhost/We-share/consult.php?id=" + var_id' . $id . ';
        window.open(link,"_self");
        }
        </script>
                  <script>
                  fetch("extrainfos.json")
                  .then(response => response.json())
                  .then(data => {
                    id = ' . $org->id . ';
                    console.log(id);
                    for(i=0;i<Object.keys(data[id]).length ;i++){
                      const header =  `<div class="header">${Object.keys(data[id])[i]}</div>`;
                      const content = `<div class="content">${Object.values(data[id])[i]}</div>`;
                      document.getElementById(\'modal-elt' . $randNumModel  . '\').innerHTML += header;
                      document.getElementById(\'modal-elt' . $randNumModel  . '\').innerHTML += content;
                    }
                  })
              </script>
              <style>
                .header{
                  color:#025CE2;
                  font-size: 1.5rem;
                  text-transform: uppercase;
                }
                .content{
                  font-size: 1.25rem;
                  font-style: oblique;
                  margin-bottom: 10%;
                }
              </style>
            <!-- The Modal -->
            <div class="modal fade" id="myModal' . $randNumModel  . '">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">À propos de ' . $org->login . '</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                  <center>
                  <img style="width: 40%; height: 10%; border-radius: 50%;" class="mb-4 rounded-circle" src="assets/images/We-Share-logo.png" alt="">
                  <br>
                  <div id="modal-elt' . $randNumModel  . '"></div>

                  <p class="mt-5 mb-3 text-muted">&copy; We Share 2021</p>
                  </center>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

              </div>
            </div>
            </div>
        <form>
      </div>
    </div>

    ';
        }
      }
      ?>
    </div>
  </div>

<?php else : ?>
  <style>
    .display-3 {
      margin: 15%;

    }
  </style>
  <center>
    <h1 class="display-3">Pas de contenu pour le moment !</h1>
    <center>
    <?php endif; ?>

    </body>

    </html>
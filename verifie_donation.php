<?php
require 'inc/Autoloader.php';
$db = App::getDatabase();

$ads = $db->query("SELECT organisations.id, organisations.login , advertisements.title FROM organisations, advertisements WHERE organisations.id=advertisements.id_organisaton ", [])->fetchAll();

if(!empty($_POST) && !empty($_FILES)){    
    if (!empty($_POST['donationAmount'])  && !empty($_POST['Appels']) && !empty($_FILES['img'])) {
        $errors = [];
        $Auth = new Auth;
        $name_file = $_FILES['img']['name'];
        $name_extension = strrchr($name_file, ".");
        $extensions_autorisation = array('.png', '.PNG', '.jpg', '.JPG', '.jpeg', '.JPEG');
        $file_tmp_name = $_FILES['img']['tmp_name'];
        $file_dest = 'donations_verfications/' . $name_file;
        $date = date("Y-m-d H:i:s");
        if($Auth->VirementVerification($db,$date,$_POST['Appels'],$_POST['donationAmount'],$name_extension,$extensions_autorisation,$file_dest,$file_tmp_name)){

            Session::getInstance()->setFlash('success', "L'upload est effectué avec succés");
            App::redirect('index.php');

        }
        else {
            $errors['img'] = "Pour l'image seuls les extensions PNG , JPG ou JPG sont autorisées";
        }
    }
    else {
        $errors[] = "Tous les champs doivent être remplis";
    } 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <title>donation vérification</title>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/styles/verifie_donation.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>  
</head>
<body>
     <!-- errors controle -->
     <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
          <p>L'upload a subi des problémes lors du traitement :</p>
          <?php foreach ($errors as $error) : ?>
              <div><?= $error; ?></div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>


<form action="" method="POST" enctype="multipart/form-data">
    <div class="container CardForm">

        <!-- For demo purpose -->
        <header class="text-white text-center">
            <h1 class="display-4">Vérifier votre donation</h1>
            <p class="lead mb-0">Merci d'uploader votre reçu de virement bancaire pour vérifier votre donation</p><br><br>
            <input type="number" class="form-control" id="amountInput" name="donationAmount" placeholder="Enter Amount">
            <br>
            <select id="Appels" name="Appels" class="form-select">
                    <option selected>Sélectionner l'appel à don concernée</option>
            <?php for($i=0;$i<count($ads);$i++) { ?>
                    <option value="<?php echo $ads[$i]->id;?>"><?php echo $ads[$i]->title ." - ". $ads[$i]->login;?></option>
            <?php } ?>
            </select>
                <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
               
        </header>
    
    
        <div class="row py-4">
            <div class="col-lg-6 mx-auto">
    
                <!-- Upload image input-->
                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                    <input id="upload" type="file" onchange="readURL(this);" name="img" class="form-control border-0">
                    <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                    <div class="input-group-append">
                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg">uploader</button>
        </div>
    </div>
</form>
    <script>
        
/*  ==========================================
    SHOW UPLOADED IMAGE
* ========================================== */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageResult')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(function () {
    $('#upload').on('change', function () {
        readURL(input);
    });
});

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input = document.getElementById( 'upload' );
var infoArea = document.getElementById( 'upload-label' );

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'File name: ' + fileName;
}

    </script>
</body>
</html>
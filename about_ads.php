<?php
require 'inc/Autoloader.php';


if (empty(Session::getInstance()->read('id'))) {
Session::getInstance()->setFlash('danger','Vous devez être connecté');
App::redirect('signin.php');
}
$db = App::getDatabase();
$ads = $db->query('SELECT * FROM advertisements  WHERE id = ?',[$_GET['id']])->fetch();


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon-16x16.png">
        <link rel="mask-icon" href="../assets/images/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Noureddine Ettalhaouy, Ismail Chakrane , Faysal Belkhchicha ">
        <title>A propose d'annonce</title>
    
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
        
    </head>
<body>
    <div class="container">
        <div class="card mb-3  container">
            <img  style="margin: 20px 0px;" src="<?php echo $ads->photo;?>" class="card-img-top" alt="...">
            <div class="card-body">
            <h3 class="card-title"><?php echo $ads->title;?></h3>
            <p class="card-text"><small class="text-muted"><?php echo $ads->date;?></small></p>
            <p class="card-text">
            <?php echo $ads->Description;?>
            </p>
            
            </div>
            <div style="margin: 20px 80px;">
                <button type="button" class="btn btn-primary btn-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                        <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                        <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
                    </svg>
                    Faire un don 
                </button>
            </div>
        </div>
    </div>
</body>
</html>
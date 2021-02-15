<?php
require 'inc/Autoloader.php';


  if (empty(Session::getInstance()->read('id'))) {
  Session::getInstance()->setFlash('danger','Vous devez etre connecté');
  App::redirect('signin.php');
}

$db = App::getDatabase();
$ads = $db->query(' DELETE FROM advertisements WHERE id = ?',[$_GET['id']]);
Session::getInstance()->setFlash('success',"L'annonce est bien supprimer");
App::redirect('my.php');

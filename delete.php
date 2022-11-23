<?php
require 'inc/Autoloader.php';

if (empty(Session::getInstance()->read('id'))) {
    Session::getInstance()->setFlash('danger', 'Vous devez être connecté');
    App::redirect('signin.php');
}

$db = App::getDatabase();
$donationsDelete = $db->query(' DELETE FROM donations WHERE id_events = ?', [$_GET['id']]);

$ads = $db->query(' DELETE FROM advertisements WHERE id = ?', [$_GET['id']]);
Session::getInstance()->setFlash('success', "L'annonce a été bien supprimer");
App::redirect('my.php');

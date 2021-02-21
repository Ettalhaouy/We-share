<?php
require 'inc/Autoloader.php';

if (empty(Session::getInstance()->read('id'))) {
    Session::getInstance()->setFlash('danger', 'Vous devez être connecté');
    App::redirect('signin.php');
}

Session::getInstance()->write('id_modif', $_GET["id"]);
App::redirect('modify.php');

<?php

class Auth
{

  public function register($db,$email,$login,$password,$table)
  {
    $password = password_hash($password,PASSWORD_BCRYPT);
    $db->query("INSERT INTO $table SET email=?,login=?,password=?",[$email,$login,$password]);
    $user_id = $db->lastInsertId();
   
  }

}
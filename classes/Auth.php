<?php

class Auth
{

  public function register($db,$email,$password)
  {
    $password = password_hash($password,PASSWORD_BCRYPT);
    $token = Str::random(60);

    $db->query("INSERT INTO users SET email=?, password=?,confirmation_token=?",[$email,$password,$token]);
    $user_id = $db->lastInsertId();

   
  }

  public function confirm($db,$user_id,$token,$session)
  {

    $user = $db->query('SELECT * FROM users WHERE id = ?',[$user_id])->fetch();
    if ($user && $user->confirmation_token == $token)
    {
       $db->query('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?',[$user_id]);
       $session->write('id',$user_id);
       $session->write('auth',$user);
       return true;
    }
    else
    {
      $db->query('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?',[$user_id]);
      $session->write('id',$user_id);
      $session->write('auth',$user);
      return false;
    }
  }
}
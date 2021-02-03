<?php

class App
{

  static $db = null;

  static function getDatabase()
  {
    if (!self::$db) {
      // it depends on your OS 
      self::$db = new Database ('root','','weshare');
    }
    return self::$db;
  }

  static function redirect($page)
  {
    header("location: $page");
    exit();
  }

}
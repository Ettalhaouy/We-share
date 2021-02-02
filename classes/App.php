<?php

class App
{

  static $db = null;

  static function getDatabase()
  {
    if (!self::$db) {
      // it depends on your OS 
      self::$db = new Database ('root','','mcharty');
    }
    return self::$db;
  }

  static function redirect($page)
  {
    header("location: $page");
    exit();
  }

}
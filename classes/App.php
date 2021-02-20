<?php

class App
{

    static $db = null;

    public static function getDatabase()
    {
        if (!self::$db) {
            // it depends on your OS
            self::$db = new Database('root', '', 'weshare');
        }
        return self::$db;
    }

    public static function redirect($page)
    {
        header("location: $page");
        exit();
    }

}

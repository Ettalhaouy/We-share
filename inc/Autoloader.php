<?php

spl_autoload_register('app_autoload');

function app_autoload($class)
{

    // it depends on your OS
    //require "/opt/lampp/htdocs/We-share/classes/$class.php";
    require "/wamp64/www/Github/We-share/classes/$class.php";

}

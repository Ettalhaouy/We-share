<?php

spl_autoload_register('app_autoload');

function app_autoload($class)
{

    // it depends on your OS
    if(PHP_OS === 'Linux'){
        require "/opt/lampp/htdocs/We-share/classes/$class.php";
    }else{
        require "/wamp64/www/We-share/classes/$class.php";
    }


}

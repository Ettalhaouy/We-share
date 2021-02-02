<?php

spl_autoload_register('app_autoload');


function app_autoload($class){

    // it depends on your OS 
    require "/opt/lampp/htdocs/mcharty/classes/$class.php";

<?php

session_start();

require_once '/../application/utils/Bootstrap.php';
require_once '/../application/utils/ActionBase.php';
require_once '/../application/utils/DataBase.php';
require_once '/../application/utils/DataBaseConnector.php';

$global = include_once '/../config/global.php';

spl_autoload_register(function ($class) {
   $class = ucfirst(strtolower($class));
   $pathAction = dirname(__FILE__) . "/../application/actions/{$class}.php";
   $pathData = dirname(__FILE__) . "/../application/data/{$class}.php";

   if (file_exists($pathAction)) {
       require_once $pathAction;
   }

   if (file_exists($pathData)) {
       require_once $pathData;
   }
});

if (!isset($_SERVER['PATH_INFO'])) {
    $_SERVER['PATH_INFO'] = 'home';
}

$class = str_replace('/', '', $_SERVER['PATH_INFO']) . 'Action';
$data = str_replace('/', '', $_SERVER['PATH_INFO']) . 'Data';

$bootstrap = new Bootstrap($global);

if (class_exists($class)) {
    $action = new $class($bootstrap);

    if (class_exists($data)) {
        $dataBase = new DataBaseConnector($global['data_base']);
        $action->setData(new $data($dataBase));
    }

    $action->doRequest();
    
   
} else {
    $bootstrap->renderView('/http/error.phtml');
}


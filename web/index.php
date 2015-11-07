<?php
require __DIR__ . '/../config/autoload.php';

use Layer\Connector\ConnectDb;


$db = new ConnectDb($config);


$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'device';
$controllerName = 'Controllers\\' . ucfirst($controllerName) . 'Controller';

$controller = new $controllerName($db);

$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';
$actionName = $actionName . 'Action';

$response = $controller->$actionName();

echo $response;




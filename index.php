<?php

use App\Router\Router;
use App\Controller\AccueilController;
use App\Controller\Controller;
use App\Router\Route;
use Doctrine\Common\Collections\Expr\Value;

require_once 'vendor/autoload.php';
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Fonction de fabrique pour créer des instances de contrôleur
function createController($controllerClass, $additionalArgument = null) {
    return new $controllerClass($additionalArgument);
}
$router = new Router($_SERVER['REQUEST_URI']);
$router->setBasePath($_ENV['FOLDER_PATH']);
var_dump($router);
$accueil=require_once'./src/accueil/accueilRoute.php';
foreach($accueil as $key=>$value){
$router->add($value[0],$value[1],$value[2],$value[3]);
}
// Créez une instance unique du contrôleur générique
$genericController = new Controller();
$router->run();

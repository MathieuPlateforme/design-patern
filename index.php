<?php

use App\Router\Router;
use App\Controller\Controller;

require_once 'vendor/autoload.php';
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Fonction de fabrique pour créer des instances de contrôleur
function createController($controllerClass, $additionalArgument = null)
{
    return new $controllerClass($additionalArgument);
}
$router = new Router($_SERVER['REQUEST_URI']);

$routes = [
    require_once './src/Router/accueilRoute.php',
    require_once './src/Router/articlesRoute.php',
    require_once './src/Router/profileRoute.php',
    require_once './src/Router/connexionRoute.php',
    require_once './src/Router/adminRoute.php',
    require_once './src/Router/inscriptionRoute.php',
    require_once './src/Router/articleRoute.php',
];
$router->setBasePath($_ENV['FOLDER_PATH']);

foreach ($routes as $route) {
    $router->addRoutes($route);
}

$genericController = new Controller();
$router->run();

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
$accueil = require_once'./src/Router/accueilRoute.php';
$posts = require_once './src/Router/articlesRoute.php';
$profile = require_once './src/Router/profileRoute.php';
$connexion = require_once './src/Router/connexionRoute.php';
$admin = require_once './src/Router/adminRoute.php';
$inscription = require_once './src/Router/inscriptionRoute.php';
$articleRoute = require_once './src/Router/articleRoute.php';

$router->setBasePath($_ENV['FOLDER_PATH']);
$router->addRoutes($accueil);
$router->addRoutes($posts);
$router->addRoutes($profile);
$router->addRoutes($connexion);
$router->addRoutes($admin);
$router->addRoutes($inscription);
$router->addRoutes($articleRoute);

$genericController = new Controller();
$router->run();

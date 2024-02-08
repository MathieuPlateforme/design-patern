<?php

use App\Router\Router;
use App\Controller\AccueilController;
use App\Controller\LoginController;
use App\Controller\RegistrationController;
use App\Controller\ProfileController;
use App\Controller\PostController;
use App\Controller\PostsController;
use App\Controller\AdminController;
use App\Controller\Controller;

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

// Créez une instance unique du contrôleur générique
$genericController = new Controller();

// Routes
$router->get('/', [new AccueilController($router, $genericController), 'index'], "home");
$router->get('/register', [new RegistrationController($router, $genericController), 'index'], "register");
// ... autres routes ...

$router = new Router($_SERVER['REQUEST_URI']);
$router->setBasePath($_ENV['FOLDER_PATH']);

$router->get('/', [createController(AccueilController::class), 'index'], "home");

$router->get('/register', [createController(RegistrationController::class), 'index'], "register");
$router->post('/register', [createController(RegistrationController::class), 'registerUser']);

$router->get('/login', [createController(LoginController::class), 'index'], "login");
$router->post('/login', [createController(LoginController::class), 'loginUser']);
$router->get('/logout', [createController(LoginController::class), 'logoutUser']);

$router->get('/profile', [createController(ProfileController::class), 'index'], "profile");

$router->get('/posts/:page', [createController(PostsController::class), 'paginatedPosts'], "posts")->with('page', '[0-9]+');
$router->get('/post/:id', [createController(PostController::class), 'viewPost'], "post")->with('id', '[0-9]+');
$router->post('/comments/:post_id', [createController(PostController::class), 'createComment'], "add_comment")->with('post_id', '[0-9]+');

$router->get('/admin/:action/:entity', [createController(AdminController::class), 'admin'], "admin")->with('action', 'list')->with('entity', 'user|post|comment|category');
$router->get('/admin/:action/:entity/:id', [createController(AdminController::class), 'admin'], "admin-entity")->with('action', 'show')->with('entity', 'user|post|comment|category')->with('id', '[0-9]+');
$router->post('/admin/:action/:entity/:id', [createController(AdminController::class), 'admin'], "admin-entity")->with('action', 'edit|delete')->with('entity', 'user|post|comment|category')->with('id', '[0-9]+');

$router->run();

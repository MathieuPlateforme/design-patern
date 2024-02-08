<?php

use App\Controller\Controller;
use App\Controller\LoginController;

$connexionRoute = [
    [
        '/connexion', function () {
            $controller = new Controller();
            $controller->render('login');
        }, "connexion", 'GET',
    ],
    [
        '/login', function () {
            try {
                $controller = new LoginController();
                $controller->loginUser($_POST['email'], $_POST['password']);
            } catch (\Exception $e) {
                $controller->render('login', ['error' => $e->getMessage()]);
            }
        }, "login", 'POST'
    ],
    [

        '/logout', function () {
            $controller = new LoginController();
            $controller->logoutUser();
        }, "logout", 'GET'
    ]
];
return $connexionRoute;


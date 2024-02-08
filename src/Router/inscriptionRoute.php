<?php

use App\Controller\Controller;
use App\Controller\RegistrationController;

$inscriptionRoute = [
    [
        '/inscritpion', function () {
            $controller = new Controller();
            $controller->render('register');
        }, "inscription", 'GET',
    ],
    [
        '/register', function () {
            try {
                $controller = new RegistrationController();
                $controller->registerUser($_POST['email'], $_POST['password'], $_POST['password_confirm'], $_POST['firstname'], $_POST['lastname']);
                $controller->redirect('login');
            } catch (\Exception $e) {
                $controller->render('register', ['error' => $e->getMessage()]);
            }
        }, 'register', 'POST'
    ]
];
return $inscriptionRoute;



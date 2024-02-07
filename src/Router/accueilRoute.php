<?php

namespace App\Accueil;

use App\Controller\Controller;

$accueilroute = [
    [

        "/", function () {
            $controller = new Controller();
            $controller->renderByURL($_SERVER['REQUEST_URI']);
        },'accueil','GET'

    ],
];
return $accueilroute;

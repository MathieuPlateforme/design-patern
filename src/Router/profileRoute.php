<?php

use App\Controller\ProfileController;

$profilRoute = [
    [

        "/profile", function () {
            $controller = new ProfileController();
            $controller->profile();
        },'profile','GET'

    ],
];
return $profilRoute;

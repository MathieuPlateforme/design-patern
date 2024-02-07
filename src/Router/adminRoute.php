<?php

use App\Controller\AdminController;

$adminRoute = [
    [

        "/admin/:action/:entity", function ($action,$entity) {
            $controller = new AdminController();
            $controller->admin($action, $entity);
        }, 'admin', 'GET'

    ],
    [
        "/admin/:action/:entity/:id", function ($action = 'list', $entity = 'user', $id = null) {
            $controller = new AdminController();
            $controller->admin($action, $entity,$id);
        }, 'admin', 'GET'
    ],
    [
        '/admin/:action/:entity/:id', function ($action = 'list', $entity = 'user', $id = null) {
            $controller = new AdminController();
            $controller->admin($action, $entity, $id);
        },'admin','POST'
    ]
];
return $adminRoute;

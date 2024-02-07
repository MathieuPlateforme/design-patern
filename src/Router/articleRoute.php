<?php

use App\Controller\Controller;
use App\Controller\PostController;

$articleRoute = [
    [

        "/post/:id", function ($id) {
            $controller = new PostController();
            $controller->viewPost($id);
        }, "article",'GET'

    ],
    [
        '/comments/:post_id', function ($post_id) {
            try {
                $controller = new PostController();
                $controller->createComment($_POST['content'], $post_id);
            } catch (\Exception $e) {
                $controller->viewPost($post_id, ['error' => $e->getMessage()]);
            }
        }, "add_comment",'POST'
    ]
];
return $articleRoute;

<?php
use App\Controller\PostController;

$posts = [
    [
        '/articles/:page', function () {
            $controller = new PostController($page=1);
            $controller->paginatedPosts($page);
        },"articles",'GET'

    ],
];
return $posts;

<?php
use App\Controller\PostsController;

$posts = [
    [
        '/articles/:page', function () {
            $controller = new PostsController($page=1);
            $controller->paginatedPosts($page);
        },"articles",'GET'

    ],
];
return $posts;

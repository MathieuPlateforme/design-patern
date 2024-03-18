<?php

use App\Class\Post;
use App\Controller\PostsController;
use App\Entity\Post as EntityPost;

$posts = [
    [
        '/articles/:page', function ($page) {
            $controller = new PostsController($page);
            $controller->paginatedPosts($page);
        }, "articles", 'GET'
    ],
    [
        '/article/create', function () {
            $controller = new PostsController();
            $controller->createPostForm();
        }, "create_post_form", 'GET'
    ],
    [
        'article/sending',function(){
            $controller=new Post();
            $controller->switchAction($_POST['action'],$_POST['title'], $_POST['content'],$_POST['category']);
        },"switch_road",'POST'
    ],
];

return $posts;

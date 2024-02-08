<?php

namespace App\Controller;

use App\Entity\Post;
use App\Controller\Controller;
use App\Service\PostService;
use Datetime;

class PostsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function paginatedPosts($page)
    {
        $postService = new PostService();
        $posts = $postService->findAllPaginated($page);
        $pages = count($postService->findAll()) / 10;
        $this->render('posts', ['posts' => $posts, 'pages' => $pages]);
    }
}
<?php

namespace App\Controller;

use App\Class\Category;
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

    public function paginatedPosts($page, $sortOrder = 'asc')
    {
        $postService = new PostService();
        $posts = $postService->findAllPaginated($page);
        $pages = count($postService->findAll()) / 10;
        $postsIterate = $postService->sortByAlphabet("asc", $posts);

        $this->render('posts', ['posts' => $postsIterate, 'pages' => $pages]);
    }
    public function createPostForm()
    {
        $categories = (new Category())->findAll();

        $this->render('newArticle',['categories'=>$categories]);
    }
}

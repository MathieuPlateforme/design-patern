<?php

namespace App\Controller;

use App\Controller\Controller;

class PostController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function paginatedPosts($page)
    {
        $post = new Post();
        $posts = $post->findAllPaginated($page);
        $pages = count($post->findAll()) / 10;
        $this->render('posts', ['posts' => $posts, 'pages' => $pages]);
    }

    public function viewPost($id, $error = null)
    {
        if (is_numeric($id) === false) {
            throw new \Exception("L'identifiant du post n'est pas valide");

            return;
        }
        $post = new Post();
        $post = $post->findOneById((int) $id);
        $this->render('post', ['post' => $post, 'error' => $error]);
    }
}
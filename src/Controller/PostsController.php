<?php

namespace App\Controller;

use App\Entity\Post;
use App\Controller\Controller;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Entity\Comment;
use Datetime;

class PostsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function paginatedPosts($page)
    {
        $postRepository = new PostRepository();
        $arrayPost = $postRepository->findAllPaginated($page);
        foreach ($arrayPost as $arrayPost) {
            $post = $postRepository->createEntity($arrayPost);
            $posts[] = $post;
        }
        $pages = count($postRepository->findAll()) / 10;
        $this->render('posts', ['posts' => $posts, 'pages' => $pages]);
    }

    public function findByPost(int $id){
        $commentRepository = new CommentRepository();
        $commentsData = $commentRepository->findByPost($id);
        foreach ($commentsData as $comment) {
            $comments[] = $commentRepository->createEntity($comment);
        }

        return $comments;
    }
}
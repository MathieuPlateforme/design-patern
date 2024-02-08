<?php

namespace App\Service;

use App\Entity\Post;
use App\Entity\Comment;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;

class PostService
{

    public function __construct()
    {
    }

    public function findAllPaginated(int $page)
    {
        $postRepository = new PostRepository();
        $arrayPost = $postRepository->findAllPaginated($page);
        foreach ($arrayPost as $arrayPost) {
            $post = $postRepository->createEntity($arrayPost);
            $posts[] = $post;
        }
        return $posts;
    }

    public function findByPost(int $id){
        $commentRepository = new CommentRepository();
        $commentsData = $commentRepository->findByPost($id);
        foreach ($commentsData as $comment) {
            $comments[] = $commentRepository->createEntity($comment);
        }

        return $comments;
    }

    public function findAll(){
        $postRepository = new PostRepository();
        return $postRepository->findAll();
    }
}

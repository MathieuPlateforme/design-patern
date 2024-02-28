<?php

namespace App\Service;

use App\Entity\Post;
use App\Entity\Comment;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Collection\PostsCollection;

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

    public function sortByAlphabet($direction, $posts){
        $postsCollection = new PostsCollection($posts);
        $iterator = $postsCollection->getIterator();
        
        $sortedPosts = [];

        while ($iterator->valid()) {
            $sortedPosts[] = $iterator->current();
            usort($sortedPosts, function($a, $b) use ($direction) {
                return ($direction === 'asc') ? 
                    strcasecmp($a->getTitle(), $b->getTitle()) :
                    -strcasecmp($a->getTitle(), $b->getTitle());
            });
            $iterator->next();
        }

        return $sortedPosts;
    }
    
}

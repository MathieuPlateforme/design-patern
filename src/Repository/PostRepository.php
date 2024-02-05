<?php

namespace App\Repository;

use App\Entity\Post;
use App\Repository\BaseRepository;

class PostRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Post::class);
    }

    protected function getTableName(): string
    {
        return 'post';
    }
}
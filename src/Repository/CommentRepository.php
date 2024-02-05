<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Repository\BaseRepository;

class CommentRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Comment::class);
    }

    protected function getTableName(): string
    {
        return 'comment';
    }
}
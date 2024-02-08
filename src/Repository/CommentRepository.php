<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Repository\BaseRepository;
use App\Database\Database;
use App\Repository\UserRepository;

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

    public function createEntity(array $data): Comment
    {
        var_dump($data);
        return (new Comment())
            ->setId($data['id'] ?? null)
            ->setContent($data['content'] ?? null)
            ->setCreatedAt($data['created_at'] ?? null)
            ->setUser((new UserRepository())->findOneById($data['user_id']) ?? null)
            ->setPost($data['post'] ?? null);
    }

    public function findByPost(int $id)
    {
        $pdo = Database::getConnection();
        $query = $pdo->prepare('SELECT * FROM comment WHERE post_id = :id');
        $query->execute([
            'id' => $id
        ]);
        return $query->fetchAll();
    }
}
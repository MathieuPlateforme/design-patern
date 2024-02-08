<?php

namespace App\Repository;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\BaseRepository;
use App\Database\Database;
use App\Service\PostService;
use App\Repository\UserRepository;
use App\Repository\CategoryRepository;
use DateTime;

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

    public function createEntity(array $data): Post
    {
        $post = new Post();
        $post->setId($data['id']);
        $post->setTitle($data['title']);
        $post->setContent($data['content']);
        $post->setCreatedAt(new DateTime($data['created_at']));
        $post->setUpdatedAt($data['updated_at'] ? new DateTime($data['updated_at']) : null);
        $post->setUser((new UserRepository())->findOneById($data['user_id']));
        $post->setCategory((new CategoryRepository())->findOneById($data['category_id']));
        $post->setComments((new PostService())->findByPost($data['id']));
        return $post;
    }

    public function findAllPaginated(int $page)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $sql = 'SELECT * FROM post ORDER BY created_at DESC LIMIT :limit OFFSET :offset';
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $results = [];
        return $arrayPost = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
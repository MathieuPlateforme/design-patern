<?php

namespace App\Repository;

use App\Entity\User;
use App\Repository\BaseRepository;
use App\Database\Database;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    protected function getTableName(): string
    {
        return 'user';
    }

    public function createEntity(array $data): User
    {
        return (new User())
            ->setId($data['id'])
            ->setFirstname($data['firstname'])
            ->setLastname($data['lastname'])
            ->setPassword($data['password'])
            ->setEmail($data['email'])
            ->setRole(json_decode($data['role']));
    }

    public function findOneByEmail(string $email)
    {
        $connection = Database::getConnection();
        $query = $connection->prepare('SELECT * FROM user WHERE email = :email');
        $query->bindValue(':email', $email, \PDO::PARAM_STR);
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    }
}
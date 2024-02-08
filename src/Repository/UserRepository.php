<?php

namespace App\Repository;

use App\Entity\User;
use App\Repository\BaseRepository;

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
            ->setRole(str_split($data['role']));
    }
}
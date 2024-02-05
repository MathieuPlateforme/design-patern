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
}
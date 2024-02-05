<?php

namespace App\Repository;

use App\Entity\Category;
use App\Repository\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Category::class);
    }

    protected function getTableName(): string
    {
        return 'category';
    }
}
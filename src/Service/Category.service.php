<?php

namespace App\Service;

use App\Class\Category;
use App\Database\Database;

class CategoryService
{
    public function findOneById(int $id): ?Category
    {
        $pdo = Database::getConnection();
        $query = $pdo->prepare('SELECT * FROM category WHERE id = :id');
        $query->execute(['id' => $id]);
        $categoryData = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$categoryData) {
            return null;
        }

        $category = new Category();
        $category->setId($categoryData['id'])
            ->setName($categoryData['name']);

        return $category;
    }

    public function findAll(): array
    {
        $pdo = Database::getConnection();
        $query = $pdo->prepare('SELECT * FROM category');
        $query->execute();
        $categoriesData = $query->fetchAll(\PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($categoriesData as $categoryData) {
            $category = new Category();
            $category->setId($categoryData['id'])
                ->setName($categoryData['name']);
            $categories[] = $category;
        }

        return $categories;
    }

    public function save(Category $category): Category
    {
        $pdo = Database::getConnection();

        if (is_null($category->getId())) {
            $query = $pdo->prepare('INSERT INTO category (name) VALUES (:name)');
            $query->execute(['name' => $category->getName()]);
            $category->setId($pdo->lastInsertId());
        } else {
            $query = $pdo->prepare('UPDATE category SET name = :name WHERE id = :id');
            $query->execute(['name' => $category->getName(), 'id' => $category->getId()]);
        }

        return $category;
    }

    public function delete(Category $category)
    {
        $pdo = Database::getConnection();
        $query = $pdo->prepare('DELETE FROM category WHERE id = :id');
        $query->bindValue(':id', $category->getId(), \PDO::PARAM_INT);
        $query->execute();
    }
}

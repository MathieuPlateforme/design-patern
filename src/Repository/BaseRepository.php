<?php

namespace App\Repository;

use PDO;
use App\Database\Database;

abstract class BaseRepository {
    protected PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
        $this->table = $this->getTableName();
    }

    abstract protected function createEntity(array $data);

    public function save(array $data)
    {
        var_dump($data);
        $fields = implode(', ', array_keys($data));
        $values = implode(', ', array_map(fn($key) => ':' . $key, array_keys($data)));
    
        $query = $this->connection->prepare("INSERT INTO {$this->table} ($fields) VALUES ($values)");
        $query->execute($data);
    }

    public function findAll(): array
    {
        $query = $this->connection->prepare("SELECT * FROM {$this->table}");
        $query->execute();
    
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOneById(int $id)
    {
        $query = $this->connection->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    
        $data = $query->fetch(PDO::FETCH_ASSOC);
    
        if (!$data) {
            return null; // or throw an exception, depending on your preference
        }
    
        return $this->createEntity($data);
    }

    public function update(int $id, array $data)
    {
        $fields = implode(', ', array_map(fn($key) => $key . ' = :' . $key, array_keys($data)));
    
        $query = $this->connection->prepare("UPDATE {$this->table} SET $fields WHERE id = :id"); 
        $query->execute(array_merge($data, ['id' => $id]));
    }

    public function delete(int $id)
    {
        $query = $this->connection->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }

}
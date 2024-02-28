<?php 

namespace App\Iterator;

use App\Entity\Post;

class PostsIterator implements \Iterator
{
    

    public function __construct(private array $collection, private ?int $position = 0)
    {
    }

    public function current(): mixed
    {
        return $this->collection[$this->position];
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }
    
    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->collection[$this->position]);
    }
}
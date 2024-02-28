<?php

namespace App\Collection;

use App\Iterator\PostsIterator;

class PostsCollection implements Collection
{
    private $elements;

    public function __construct($elements)
    {
        $this->elements = $elements;
    }

    public function getIterator()
    {
        return new PostsIterator($this->elements);
    }
}

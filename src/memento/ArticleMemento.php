<?php

class ArticleMemento
{
    private $title;
    private $content;
    private $category;

    public function __construct($title, $content, $category)
    {
        $this->title = $title;
        $this->content = $content;
        $this->category = $category;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCategory()
    {
        return $this->category;
    }
}

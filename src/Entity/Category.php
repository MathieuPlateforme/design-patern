<?php 

namespace App\Entity;

class Category {
    public function __construct(
        private ?int $id = null,
        private ?string $name = null,
        private ?array $posts = []
    ) {
    }

    /**
     * Get the value of id
     * 
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param ?int $id
     * @return  self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     * 
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param ?string $name
     * @return  self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of posts
     * 
     * @return Post[]
     */
    public function getPosts(): array
    {
        return $this->posts;
    }

    /**
     * Set the value of posts
     *
     * @param Post[] $posts 
     * @return  self
     */
    public function setPosts(array $posts): self
    {
        $this->posts = $posts;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'posts' => count($this->posts)
        ];
    }
}
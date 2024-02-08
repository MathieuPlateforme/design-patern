<?php 

namespace App\Entity;

use DateTime;

class Comment {
    public function __construct(
        private ?int $id = null,
        private ?string $content = null,
        private ?DateTime $createdAt = null,
        private ?User $user = null,
        private ?Post $post = null
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): Comment
    {
        $this->id = $id;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): Comment
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime|string $createdAt): Comment
    {
        if (is_string($createdAt)) {
            $createdAt = new DateTime($createdAt);
        }
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): Comment
    {
        $this->user = $user;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): Comment
    {
        $this->post = $post;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'user_id' => $this->user->getId(),
            'post_id' => $this->post->getId()
        ];
    }
}
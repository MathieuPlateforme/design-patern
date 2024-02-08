<?php

namespace App\Entity;

class User {
    public function __construct(
        private ?int $id = null,
        private ?string $email = null,
        private ?string $password = null,
        private ?string $firstname = null,
        private ?string $lastname = null,
        private ?array $role = [],
        private ?array $posts = [],
        private ?array $comments = []
    ) {
    }

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole(): array
    {
        return $this->role;
    }

    /**
     * Set the value of role
     * 
     * @param array $role
     * @return  self
     */
    public function setRole(array $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * addRole
     *
     * @param string $role
     * @return self
     */
    public function addRole(string $role): self
    {
        $this->role[] = $role;

        return $this;
    }

    /**
     * removeRole
     *
     * @param string $role
     * @return self
     */
    public function removeRole(string $role): self
    {
        $key = array_search($role, $this->role);
        if ($key !== false) {
            unset($this->role[$key]);
        }

        return $this;
    }

   

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'password' => $this->password,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'role' => $this->role
        ];
    }
}
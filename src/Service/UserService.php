<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findOneByEmail(string $email)
    {
        $user = $this->userRepository->findOneByEmail($email);
        if ($user) {
            $this->id = $user['id'];
            $this->email = $user['email'];
            $this->password = $user['password'];
            $this->firstname = $user['firstname'];
            $this->lastname = $user['lastname'];
            $this->role = json_decode($user['role'], true);
            return $this;
        } else {
            return false;
        }
    }
}

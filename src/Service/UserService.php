<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

class UserService
{

    public function __construct()
    {
       
    }

    public function findOneByEmail(string $email)
    {
        $userRepository=new UserRepository;
        $userData = $userRepository->findOneByEmail($email);
        if ($userData) {
            return $userRepository->createEntity($userData); 
        } else {
            return false;
        }
    }
}

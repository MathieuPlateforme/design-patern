<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Repository\UserRepository;
use App\Service\UserService;
use App\Entity\User;

class RegistrationController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function registerUser($email, $password, $confirmPassword, $firstname, $lastname)
    {
        $userRepository = new UserRepository();
        $userService = new UserService($userRepository);

        if (empty($email) || empty($password) || empty($confirmPassword) || empty($firstname) || empty($lastname)) {
            throw new \Exception("Tous les champs sont obligatoires");

            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("L'email n'est pas valide");

            return;
        }

        if ($userService->findOneByEmail($email)) {
            throw new \Exception("L'email existe déjà");

            return;
        }

        if ($password === $confirmPassword) {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setRole(['ROLE_USER']);
            var_dump($user);
            $userRepository->save($user->toArray());

            return;
        } else {
            throw new \Exception("Les mots de passe ne correspondent pas");

            return;
        }
    }
}
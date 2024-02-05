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

    public function createUser(User $user): User
    {
        // Logique pour créer un nouvel utilisateur
        // Par exemple, vous pourriez valider les données de l'utilisateur ici
        // Ensuite, utilisez le UserRepository pour enregistrer l'utilisateur dans la base de données
        return $this->userRepository->save($user);
    }

    public function deleteUser(User $user)
    {
        // Logique pour supprimer un utilisateur
        // Vous pourriez vérifier certaines conditions avant de supprimer l'utilisateur, par exemple, s'il n'a pas de posts associés
        $this->userRepository->delete($user);
    }

    public function getUserById(int $userId): ?User
    {
        // Logique pour récupérer un utilisateur par son identifiant
        // Utilisez le UserRepository pour récupérer l'utilisateur depuis la base de données
        return $this->userRepository->findById($userId);
    }

    public function getUserByUsername(string $username): ?User
    {
        // Logique pour récupérer un utilisateur par son nom d'utilisateur
        // Utilisez le UserRepository pour récupérer l'utilisateur depuis la base de données
        return $this->userRepository->findByUsername($username);
    }

    // Autres méthodes selon les besoins de votre application
}

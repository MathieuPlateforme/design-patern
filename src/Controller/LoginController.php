<?php

namespace App\Controller;

use App\Controller\Controller;

class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function loginUser($email, $password)
    {
        $user = new User();

        if (empty($email) || empty($password)) {
            throw new \Exception("Tous les champs sont obligatoires");
            $this->redirect('login');

            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("L'email n'est pas valide");
            $this->redirect('login');

            return;
        }

        $user = $user->findOneByEmail($email);

        if ($user && password_verify($password, $user->getPassword())) {
            $user->setPassword('');
            $_SESSION['user'] = $user;

            $this->redirect('home');

            return;
        } else {
            throw new \Exception("Les identifiants sont incorects");
            $this->redirect('login');

            return;
        }
    }

    public function logoutUser()
    {
        unset($_SESSION['user']);
        $this->redirect('home');
    }
}
<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Entity\User;
use App\Service\UserService;

class LoginController extends Controller
{
    private $userEntity;
    public function __construct()
    {
        $this->userEntity = new User();
        parent::__construct();
    }

    public function loginUser($email, $password)
    {
        $user = new UserService();
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
        var_dump($password);
        $passhash=$user->getPassword();
        var_dump(password_verify($password,$passhash));
        var_dump($user);
        if ($user && password_verify($password,$passhash)) {
            $this->userEntity->setPassword('');
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

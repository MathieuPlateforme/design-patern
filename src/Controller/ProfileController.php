<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Repository\UserRepository;

class ProfileController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function profile()
    {
        $userRepository = new UserRepository();
        if (self::getUser() === null) {
            $this->redirect('login');

            return;
        }
        $user = $userRepository->findOneById($_SESSION['user']->getId());
        if ($user) {
            $user->setPassword('');
            $this->render('profile', ['user' => $user]);

            return;
        }

        $this->redirect('login');

        return;
    }
}
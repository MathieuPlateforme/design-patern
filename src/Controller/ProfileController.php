<?php

namespace App\Controller;

use App\Controller\Controller;

class ProfileController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function profile()
    {
        $user = new User();
        if (self::getUser() === null) {
            $this->redirect('login');

            return;
        }
        $user = $user->findOneById($_SESSION['user']->getId());
        if ($user) {
            $user->setPassword('');
            $this->render('profile', ['user' => $user]);

            return;
        }

        $this->redirect('login');

        return;
    }
}
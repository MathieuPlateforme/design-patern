<?php

namespace App\Controller;

require_once(__DIR__ . '/../handler/authHandler/FileHandler.php');
require_once(__DIR__ . '/../handler/authHandler/regexHandler.php');
require_once(__DIR__ . '/../handler/authHandler/jwtHandler.php');

use App\Service\UserService;
use FieldsFilledHandler;
use EmailPasswordValidationHandler;
use JwtHandler;

class LoginController extends Controller
{
    private $authenticationHandler;

    public function __construct()
    {
        parent::__construct();

        // Créez la chaîne de responsabilité
        $fieldsFilledHandler = new FieldsFilledHandler;
        $regexHandler = new EmailPasswordValidationHandler;
        $jwtHandler = new JwtHandler;
        // Configurez les gestionnaires dans l'ordre de la chaîne

        $this->authenticationHandler = $fieldsFilledHandler;
        $this->authenticationHandler->setNextHandler($regexHandler);
        $regexHandler->setNextHandler($jwtHandler);
    }

    public function loginUser()
    {
        try {
            // Récupérez les informations d'identification à partir du tableau POST
            $userCredentials = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ];
            $this->authenticationHandler->handleRequest($userCredentials);
            // Instanciez le service UserService
            $userService = new UserService();

            // Passe la requête à la chaîne de responsabilité


            $user = $userService->findOneByEmail($userCredentials['email']);
            $passhash=$user->getPassword();
            if ($user && password_verify($userCredentials['password'],$passhash)) {
                $user->setPassword('');
                $_SESSION['user'] = $user;
    
                $this->redirect('accueil');
    
                return;
            } else {
                throw new \Exception("Les identifiants sont incorects");
                $this->redirect('login');
    
                return;
            }
        } catch (\Exception $e) {
            // Stocker le message d'erreur dans la session
            $_SESSION['error_message'] = $e->getMessage();

            // Rediriger vers la page de connexion (ou rester sur la même page)
            $this->redirect('login');
        }
    }

    public function logoutUser()
    {
        unset($_SESSION['user']);
        unset($_SESSION['jwt']);
        $this->redirect('accueil');
    }
}

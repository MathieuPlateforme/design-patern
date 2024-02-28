<?php

namespace App\Controller;

require_once(__DIR__ . '/../handler/authHandler/baseHandler.php');
require_once(__DIR__.'/../handler/authHandler/FileHandler.php');
use App\Service\UserService;
use BaseAuthenticationHandler;
use FieldsFilledHandler;

class LoginController extends Controller
{
    private $authenticationHandler;

    public function __construct()
    {
        parent::__construct();

        // Créez la chaîne de responsabilité
        $baseHandler = new BaseAuthenticationHandler;
        $fieldsFilledHandler = new FieldsFilledHandler;
        
        // Configurez les gestionnaires dans l'ordre de la chaîne
        $fieldsFilledHandler->setNextHandler($baseHandler);

        $this->authenticationHandler = $fieldsFilledHandler;
    }

    public function loginUser()
    {
        try {
            // Récupérez les informations d'identification à partir du tableau POST
            $userCredentials = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ];

            // Instanciez le service UserService
            $userService = new UserService();

            // Passe la requête à la chaîne de responsabilité
            $this->authenticationHandler->handleRequest($userCredentials);

            // Si nous arrivons ici, l'authentification a réussi
            $user = $userService->findOneByEmail($userCredentials['email']);
            $user->setPassword('');

            $_SESSION['user'] = $user;
            $this->redirect('accueil');
        }catch (\Exception $e) {
            // Stocker le message d'erreur dans la session
            $_SESSION['error_message'] = $e->getMessage();
    
            // Rediriger vers la page de connexion (ou rester sur la même page)
            $this->redirect('login');
        }
    }

    public function logoutUser()
    {
        unset($_SESSION['user']);
        $this->redirect('accueil');
    }
}

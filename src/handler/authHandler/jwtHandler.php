<?php 
require_once(__DIR__.'./BaseHandler.php');

class JwtHandler extends BaseAuthenticationHandler
{
    private $secretKey;

    public function __construct()
    {
        $this->secretKey = $_ENV['SKEY'];
    }

    public function handleRequest($credentials, $updatedResponse = null)
    {

        try {
            $token = $this->generateJwt($credentials);
            $_SESSION['jwt'] = $token;

            echo 'JwtHandler: JWT généré avec succès et stocké en session. Continue au gestionnaire suivant. </br>';

            // Ajoutez le JWT à la réponse ou effectuez d'autres actions nécessaires
            if ($updatedResponse !== null) {
                $updatedResponse['jwt'] = $token;
            }
            parent::handleRequest($credentials, $updatedResponse);
        } catch (Exception $e) {
            // En cas d'erreur lors de la génération du JWT
            echo 'JwtHandler: Erreur lors de la génération du JWT. </br>';
            // Vous pouvez gérer l'erreur ici ou la propager plus haut si nécessaire
            throw $e;
        }
    }

    private function generateJwt($credentials)
    {
        
        $payload = [
            'email' => $credentials['email'],
        ];

        return \Firebase\JWT\JWT::encode($payload, $this->secretKey, 'HS256');
    }
}

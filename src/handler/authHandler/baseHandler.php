<?php

require_once(__DIR__.'./IAuthHandler.php');

class BaseAuthenticationHandler implements IAuthenticationHandler
{
    private $nextHandler;

    public function setNextHandler(IAuthenticationHandler $handler)
    {
        $this->nextHandler = $handler;
    }

    public function handleRequest($credentials, $updatedResponse = null)
    {
        echo 'Handling Base Authentication, continue </br >';

        // Si un gestionnaire suivant est défini, passe la requête à ce gestionnaire
        if ($this->nextHandler !== null) {
            try {
                $this->nextHandler->handleRequest($credentials, $updatedResponse);
            } catch (Exception $e) {
                // Attrape n'importe quelle exception générique et la renvoie
                throw $e;
            }
        }
    }
}

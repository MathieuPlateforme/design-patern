<?php

require_once(__DIR__ . './baseHandler.php');

class FieldsFilledHandler extends BaseAuthenticationHandler
{
    public function handleRequest($userCredentials, $updatedResponse = null)
    {
        
        if (empty($userCredentials['email']) || empty($userCredentials['password'])) {
            echo 'FieldsValidationHandler: Username and password are required. </br>';
            throw new \Exception("Tous les champs sont obligatoires");
        }

        if (!filter_var($userCredentials['email'], FILTER_VALIDATE_EMAIL)) {
            echo 'FieldsValidationHandler: Invalid email format. </br>';
            throw new \Exception("L'email n'est pas valide");
        }

        // Si tous les champs sont remplis, continue le traitement
        echo 'FieldsFilledHandler: All fields are filled. Continue to the next handler. </br>';

        // Appelle la méthode de gestion de la classe parent (BaseAuthenticationHandler)
        parent::handleRequest($userCredentials, $updatedResponse);
    }
}

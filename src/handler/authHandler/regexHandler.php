<?php

// EmailPasswordValidationHandler.php
require_once(__DIR__.'./BaseHandler.php');

class EmailPasswordValidationHandler extends BaseAuthenticationHandler
{
    public function handleRequest($credentials, $updatedResponse = null)
    {
        $email = $credentials['email'];
        $password = $credentials['password'];

        if (!$this->validateEmail($email)) {
            // Lancer une exception en cas d'e-mail non valide
            throw new Exception('Invalid Email');
        }

        if (!$this->validatePassword($password)) {
            // Lancer une exception en cas de mot de passe non valide
            throw new Exception('Invalid Password');
        }

        // Si l'e-mail et le mot de passe sont valides, continue le traitement
        echo 'EmailPasswordValidationHandler: E-mail et mot de passe sont valides. Continue au gestionnaire suivant. </br>';

        // Appelle la méthode de gestion de la classe parent (BaseAuthenticationHandler)
        parent::handleRequest($credentials, $updatedResponse);
    }

    private function validateEmail($email)
    {
        // Utilisation de filter_var avec FILTER_VALIDATE_EMAIL pour valider l'e-mail
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function validatePassword($password)
    {
        // Utilisation d'une regex pour vérifier que le mot de passe contient uniquement des lettres et des chiffres
        return preg_match('/^[a-zA-Z0-9]+$/', $password) === 1;
    }
}
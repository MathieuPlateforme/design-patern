<?php 

interface IAuthenticationHandler {
    public function handleRequest($credentials, $updatedResponse);
}
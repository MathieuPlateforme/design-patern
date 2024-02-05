<?php

namespace App\Controller;

use App\Controller\Controller;

class AccueilController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        try {
            $genericController=New Controller;
            // Logique métier ici
            $data = $this->getSomeData(); // Exemple de logique métier

            // Utiliser le contrôleur générique pour le rendu
            $genericController->render('index', ['data' => $data]);
        } catch (\Exception $e) {
            // Gérer les erreurs
            $genericController->render('error', ['error' => $e->getMessage()]);
        }
    }

    private function getSomeData()
    {
        // Logique métier pour obtenir des données
        return ['example' => 'data'];
    }
}

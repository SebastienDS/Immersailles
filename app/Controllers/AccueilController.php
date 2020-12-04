<?php

namespace App\Controllers;

use App\Models\Annee;

class AccueilController extends Controller {

    public function index() {
        $currentDate = (int)htmlentities($_GET['currentDate'] ?? Annee::first());
        $currentEtage = (int)htmlentities($_GET['etage'] ?? 0);

        return $this->view('accueil', [
            'title' => 'Accueil',
            'style' => [
                'timeline',
            ],
            'currentDate' => $currentDate,
            'dates' => Annee::all(10),
            'currentEtage' => $currentEtage,
        ]);
    }

    public function enSavoirPlus() {
        return $this->view('findOutMore', [
            'title' => 'En savoir plus',
        ]);
    }
}

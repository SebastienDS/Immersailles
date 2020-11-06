<?php

namespace App\Controllers;

use App\Models\Annee;

class AccueilController extends Controller {

    public function index() {
        $currentDate = $_GET['currentDate'] ?? Annee::first();

        return $this->view('accueil', [
            'title' => 'Accueil',
            'style' => [
                'timeline',
            ],
            'currentDate' => $currentDate,
            'dates' => Annee::all(10),
        ]);
    }

    public function enSavoirPlus() {
        return $this->view('findOutMore', [
            'title' => 'En savoir plus',
        ]);
    }
}

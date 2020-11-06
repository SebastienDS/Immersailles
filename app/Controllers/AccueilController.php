<?php

namespace App\Controllers;

class AccueilController extends Controller {

    public function index() {
        return $this->view('accueil', [
            'title' => 'Accueil',
            'style' => [
                'timeline',
            ]
        ]);
    }

    public function enSavoirPlus() {
        return $this->view('findOutMore', [
            'title' => 'En savoir plus',
        ]);
    }
}

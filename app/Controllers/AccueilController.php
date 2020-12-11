<?php

namespace App\Controllers;

use App\Models\Annee;
use App\Models\Niveau;
use App\Models\Etage;

class AccueilController extends Controller {

    private static function getCurrentEtage(array $etages) {
        foreach ($etages as $etage) {
            if ($etage->nombre) {
                return $etage->etage;
            }
        }
    }

    public function index() {
        $currentDate = (int)htmlentities($_GET['currentDate'] ?? Annee::first());
        $etages = Etage::getEtages($currentDate);

        $currentEtage = (int)htmlentities($_GET['etage'] ?? self::getCurrentEtage($etages));
        $map = Niveau::getMap($currentEtage, $currentDate);

        return $this->view('accueil', [
            'title' => 'Accueil',
            'style' => [
                'timeline',
            ],
            'currentDate' => $currentDate,
            'dates' => Annee::all(10),
            'currentEtage' => $currentEtage,
            'map' => $map,
            'etages' => $etages
        ]);
    }

    public function enSavoirPlus() {
        return $this->view('findOutMore', [
            'title' => 'En savoir plus',
        ]);
    }
}

<?php

namespace App\Controllers;

use App\Models\Annee;
use App\Models\Niveau;
use App\Models\Etage;
use App\Models\Marker;
use App\Models\ObjetHistorique;

class AccueilController extends Controller {

    private static $range = 10;

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

        $markers = Marker::getForLevel($map->idNiveau ?? -1);

        $annees = Annee::all();
        foreach ($annees as $i => $annee) {
            if ((int)$annee->annee === $currentDate) {
                $dates = Annee::range(max($i - self::$range / 2, 0), self::$range);
                break;
            }
        }

        return $this->view('accueil', [
            'title' => 'Accueil',
            'style' => [
                'timeline',
            ],
            'currentDate' => $currentDate,
            'dates' => $dates,
            'currentEtage' => $currentEtage,
            'map' => $map,
            'etages' => $etages,
            'markers' => $markers
        ]);
    }

    public function enSavoirPlus() {
        return $this->view('findOutMore', [
            'title' => 'En savoir plus',
        ]);
    }

    public function addMarker() {
        $this->isConnected(['admin', 'contributeur']);


        $wikiData = $_POST['IDWikiData'];
        $niveau = $_POST['idNiveau'];
        $X = floatval($_POST['X']);
        $Y = floatval($_POST['Y']);

        if (!ObjetHistorique::exists($wikiData)) {
            ObjetHistorique::create($wikiData);
        }
        if (!Marker::exists($wikiData, $niveau, $X, $Y)) {
            Marker::create($wikiData, $niveau, $X, $Y, $_SESSION['id']);
        }
        
        return header('Location: '. SCRIPT_NAME . '/immersailles.php?'. http_build_query($_GET));
    }
}

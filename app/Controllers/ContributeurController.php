<?php


namespace App\Controllers;

use App\Models\Annee;
use App\Models\Contient_A_N;
use App\Models\Etage;
use App\Models\Niveau;
use App\Models\Marker;


class ContributeurController extends Controller {

    private static $depotDirectory = 'depot/maps/';
    private static $plansDirectory = 'public/img/plans/';

    public function accueil() {
        $this->isConnected(['contributeur']);

        return $this->view('contributeur/accueil', [
            'title' => 'Accueil',
        ]);
    }

    public function mapManagement() {
        $this->isConnected(['contributeur', 'admin']);

        return $this->view('contributeur/mapManagement', [
            'title' => 'Map Management',
        ]);
    }

    public function mapInfos(string $mapName) {
        $this->isConnected(['contributeur', 'admin']);

        $etages = Etage::all();

        return $this->view('contributeur/mapInfos', [
            'title' => 'Map Infos',
            'etages' => $etages
        ]);
    }

    public function addMapFromDepot(string $mapName) {
        $this->isConnected(['contributeur', 'admin']);

        $id = Niveau::getNextId();
        $map = 'plan'. $id;

        $annee = (int)$_POST['annee'];
        $etage = (int)$_POST['etage'];

        Niveau::create($map, $etage);

        if (!Annee::exists($annee)) {
            Annee::create($annee);
        }

        if (Contient_A_N::exists($annee, $etage)) {
            Niveau::delete($id);
            return header('Location: '. SCRIPT_NAME . "/immersailles.php/contributeur/map/infos/$mapName");
        }
        Contient_A_N::create($annee, $id);
        rename(self::$depotDirectory . $mapName, self::$plansDirectory . $map . '.png');
        return header('Location: '. SCRIPT_NAME . '/immersailles.php/contributeur/addMap');
    }

    public function deleteMarker(int $idNiveau, string $idObjet, float $X, float $Y) {
        Marker::delete($idNiveau, $idObjet, $X, $Y);
    }

    public function addMap() {
        $this->isConnected(['contributeur', 'admin']);
        
        $maps = array_diff(scandir(self::$depotDirectory), ['..', '.']);

        return $this->view('contributeur/addMap', [
            'title' => 'Ajout d\'un plan',
            'maps' => $maps
        ]);
    }

    public function deleteMap() {
        $this->isConnected(['contributeur', 'admin']);

        $maps = Niveau::all();

        return $this->view('contributeur/deleteMap', [
            'title' => 'Suppression d\'un plan',
            'maps' => $maps
        ]);
    }

    public function removeMap(int $idNiveau, int $annee) {
        $this->isConnected(['contributeur', 'admin']);

        $map = 'plan'. $idNiveau . '.png';
        
        Niveau::delete($idNiveau);
        Annee::delete($annee);
        rename(self::$plansDirectory . $map, self::$depotDirectory . $map);

        return header('Location: '. SCRIPT_NAME . '/immersailles.php/contributeur/deleteMap');
    }
}
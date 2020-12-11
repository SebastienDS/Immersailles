<?php


namespace App\Controllers;

use App\Models\Annee;
use App\Models\Contient_A_N;
use App\Models\Etage;
use App\Models\Niveau;

class ContributeurController extends Controller {

    private static $depotDirectory = 'depot/maps';

    public function accueil() {
        $this->isConnected(['contributeur']);

        return $this->view('contributeur/accueil', [
            'title' => 'Accueil',
        ]);
    }

    public function mapManagement() {
        $this->isConnected(['contributeur', 'admin']);

        
        $maps = array_diff(scandir(self::$depotDirectory), ['..', '.']);

        return $this->view('contributeur/mapManagement', [
            'title' => 'Map Management',
            'maps' => $maps
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

    public function addMap(string $mapName) {
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
        rename("depot/maps/$mapName", "public/img/plans/$map.png");
        return header('Location: '. SCRIPT_NAME . '/immersailles.php/contributeur/mapManagement');
    }
}
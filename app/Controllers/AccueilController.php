<?php

namespace App\Controllers;

use App\Models\Annee;

class AccueilController extends Controller {

    public function index() {
        $currentDate = (int)htmlentities($_GET['currentDate'] ?? Annee::first());
        $currentEtage = (int)htmlentities($_GET['etage'] ?? 0);

        $infos = $this->getInfos("Q7742");
        $image = $this->getImage($infos, 370);

        return $this->view('accueil', [
            'title' => 'Accueil',
            'style' => [
                'timeline',
            ],
            'currentDate' => $currentDate,
            'dates' => Annee::all(10),
            'currentEtage' => $currentEtage,
            'image' => $image
        ]);
    }

    private function getInfos(string $idWiki) {
        return json_decode(file_get_contents("https://www.wikidata.org/wiki/Special:EntityData/${idWiki}.json"))->entities->$idWiki;
    }

    private function getImage($infos, int $size) {
        $img = str_replace(' ', '_', $infos->claims->P18[0]->mainsnak->datavalue->value);
        $md5 = md5($img);

        $firstLetter = $md5[0]; 
        $twoFirstLetters = substr($md5, 0, 2);
        return "https://upload.wikimedia.org/wikipedia/commons/thumb/${firstLetter}/${twoFirstLetters}/${img}/${size}px-${img}";
    }

    public function enSavoirPlus() {
        return $this->view('findOutMore', [
            'title' => 'En savoir plus',
        ]);
    }
}

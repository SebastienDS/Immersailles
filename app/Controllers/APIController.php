<?php


namespace App\Controllers;

use DateTime;
use Exception;

class ApiController extends Controller {

    private static $month = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

    public function getInfos(string $id) {
        $infos = $this->getData($id);
        if ($infos) {
            $infos = [
                'name' => $this->getName($infos),
                'image' => $this->getImage($infos, 370),
                'description' => $this->getDescription($infos),
                'birth' => $this->getBirth($infos),
                'death' => $this->getDeath($infos)
            ];
        }
        
        echo json_encode($infos);
    }
    
    private function getData(string $idWiki) {
        $content = @file_get_contents("https://www.wikidata.org/wiki/Special:EntityData/${idWiki}.json");
        if (!$content) return [];
        return json_decode($content)->entities->$idWiki;
    }

    private function getImage($infos, int $size) {
        $img = str_replace(' ', '_', $infos->claims->P18[0]->mainsnak->datavalue->value);
        $md5 = md5($img);

        $firstLetter = $md5[0]; 
        $twoFirstLetters = substr($md5, 0, 2);
        return "https://upload.wikimedia.org/wikipedia/commons/thumb/${firstLetter}/${twoFirstLetters}/${img}/${size}px-${img}";
    }

    private function getName($infos) {
        return $infos->claims->P1559[0]->mainsnak->datavalue->value->text;
    }

    private function getDescription($infos) {
        return ucfirst($infos->descriptions->fr->value);
    }

    private function getBirth($infos) {
        $date = substr($infos->claims->P569[0]->mainsnak->datavalue->value->time, 1, 10);
        return self::toDate($date);
    }
    
    private function getDeath($infos) {
        $date = substr($infos->claims->P570[0]->mainsnak->datavalue->value->time, 1, 10);
        return self::toDate($date);
    }

    private static function toDate($date) {
        $format = (new DateTime($date))->format('j m Y');
        $array = explode(' ', $format);
        $array[1] = self::$month[(int)$array[1] - 1];
        return implode(' ', $array);
    }
}
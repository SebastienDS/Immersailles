<?php


namespace App\Models;

use App\Controllers\Controller;
use Database\DBConnection;
use PDO;

class Etage extends Model {

    public static $table = 'Etage';


    public static function getEtages(int $annee): array {
        $table = static::$table;
        $niveauTable = Niveau::$table;
        $contientTable = Contient_A_N::$table;
    
        $stmt = DBConnection::getPDO()->prepare("SELECT idEtage as etage, sum(CASE WHEN annee = ? THEN 1 ELSE 0 END) as nombre 
            FROM $table LEFT JOIN $niveauTable ON idEtage = niveau NATURAL LEFT JOIN $contientTable GROUP BY idEtage ORDER BY idEtage");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute([$annee]);
        return $stmt->fetchAll();
    }
}
<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

class ObjetHistorique extends Model {

    public static $table = 'ObjetHistorique';


    public static function exists($wikiData): int {
        $table = self::$table;
        
        $stmt = DBConnection::getPDO()->prepare("SELECT idObjet FROM $table WHERE idObjet = ?");
        $stmt->execute([$wikiData]);
        return $stmt->rowCount() > 0;
    }

    public static function create($wikiData) {
        $table = self::$table;

        $stmt = DBConnection::getPDO()->prepare("INSERT INTO $table (idObjet) VALUES (?)");
        $stmt->execute([$wikiData]);
    }

}
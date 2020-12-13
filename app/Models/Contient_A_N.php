<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

class Contient_A_N extends Model {

    public static $table = 'contient_A_N';

    public static function exists(int $annee, int $niveau): int {
        $table = self::$table;
        $niveauTable = Niveau::$table;
        
        $stmt = DBConnection::getPDO()->prepare("SELECT annee FROM $table NATURAL JOIN $niveauTable WHERE annee = ? and niveau = ?");
        $stmt->execute([$annee, $niveau]);  
        return $stmt->rowCount() > 0;
    }

    public static function create(int $annee, int $idNiveau): int {
        $table = self::$table;

        $stmt = DBConnection::getPDO()->prepare("INSERT INTO $table (annee, idNiveau) VALUES (?, ?)");
        $stmt->execute([$annee, $idNiveau]);
        return DBConnection::getPDO()->lastInsertId();
    }

    public static function delete(int $idNiveau, int $annee) {
        $tableName = self::$table;
        $stmt = DBConnection::getPDO()->prepare("DELETE FROM $tableName WHERE idNiveau = ? AND annee = ?");
        $stmt->execute([$idNiveau, $annee]);
    }
}
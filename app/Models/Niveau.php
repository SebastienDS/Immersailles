<?php


namespace App\Models;


use Database\DBConnection;
use PDO;
use stdClass;

class Niveau extends Model {

    public static $table = 'Niveau';

    public static function create(string $map, int $niveau): int {
        $table = self::$table;

        $stmt = DBConnection::getPDO()->prepare("INSERT INTO $table (map, niveau) VALUES (?, ?)");
        $stmt->execute([$map, $niveau]);
        return DBConnection::getPDO()->lastInsertId();
    }

    public static function delete(int $id) {
        $tableName = self::$table;
        $stmt = DBConnection::getPDO()->prepare("DELETE FROM $tableName WHERE idNiveau = ?");
        $stmt->execute([$id]);
    }

    public static function getMap(int $niveau, int $annee) {
        $tableName = self::$table;
        $contientTable = Contient_A_N::$table;

        $stmt = DBConnection::getPDO()->prepare("SELECT idNiveau, map FROM $tableName NATURAL JOIN $contientTable WHERE niveau = ? AND annee = ?");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute([$niveau, $annee]);
        return $stmt->rowCount() > 0 ? $stmt->fetch() : new stdClass();
    }
}
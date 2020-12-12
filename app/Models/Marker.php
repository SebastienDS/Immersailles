<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

class Marker extends Model {

    public static $table = 'marker';
    
    public static function create($wikiData, $niveau, $X, $Y, int $idProfil) {
        $table = self::$table;

        $stmt = DBConnection::getPDO()->prepare("INSERT INTO $table (idObjet, idNiveau, X, Y, idProfil) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$wikiData, $niveau, $X, $Y, $idProfil]);
    }

    public static function exists($wikiData, $niveau, $X, $Y): int {
        $table = self::$table;
        
        $stmt = DBConnection::getPDO()->prepare("SELECT idObjet FROM $table WHERE idObjet = ? AND idNiveau = ? AND X = ? AND Y = ?");
        $stmt->execute([$wikiData, $niveau, $X, $Y]);
        return $stmt->rowCount() > 0;
    }
    
    public static function getForLevel(int $idNiveau): array {
        $table = static::$table;
        $stmt = DBConnection::getPDO()->prepare("SELECT idObjet as idWikiData, X, Y FROM $table WHERE idNiveau = ?");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute([$idNiveau]);
        return $stmt->fetchAll();
    }

    public static function delete($idNiveau, $idObjet, $X, $Y) {
        $tableName = self::$table;
        $stmt = DBConnection::getPDO()->prepare("DELETE FROM $tableName WHERE idNiveau = ? AND idObjet = ? AND X LIKE ? AND Y LIKE ?");
        $stmt->execute([$idNiveau, $idObjet, $X, $Y]);

        var_dump($stmt, $idNiveau, $idObjet, $X, $Y);
    }
}
<?php


namespace App\Models;


use Database\DBConnection;

class Marker extends Model {

    public static $table = 'Marker';
    
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
}
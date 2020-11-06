<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

class Annee extends Model {

    public static $table = 'Année';
    
    public static function all(): array {
        $table = self::$table;
        $stmt = DBConnection::getPDO()->query("SELECT * FROM {$table} ORDER BY annee");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stmt->fetchAll();
    }
}
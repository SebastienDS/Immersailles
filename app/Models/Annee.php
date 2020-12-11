<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

class Annee extends Model {

    public static $table = 'Année';
    
    public static function first(): int {
        $table = self::$table;
        
        $stmt = DBConnection::getPDO()->query("SELECT annee FROM ${table} ORDER BY annee limit 1");
        $stmt->setFetchMode(PDO::FETCH_NUM);
        return $stmt->rowCount() ? $stmt->fetch()[0] : 0;
    }

    public static function all(int $limit=0): array {
        $table = self::$table;
        
        $limitStr = '';
        if ($limit !== 0) {
            $limitStr = " LIMIT ${limit}";
        }
    
        $stmt = DBConnection::getPDO()->query("SELECT * FROM ${table} ORDER BY annee ${limitStr}");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stmt->fetchAll();
    }

    public static function exists(int $annee): int {
        $table = self::$table;
        
        $stmt = DBConnection::getPDO()->prepare("SELECT annee FROM ${table} WHERE annee = ?");
        $stmt->execute([$annee]);
        return $stmt->rowCount() > 0;
    }

    public static function create(int $annee): int {
        $table = self::$table;

        $stmt = DBConnection::getPDO()->prepare("INSERT INTO $table (annee) VALUES (?)");
        $stmt->execute([$annee]);
        return DBConnection::getPDO()->lastInsertId();
    }
}
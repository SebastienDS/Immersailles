<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

abstract class Model {

    public static $table = '';

    public static function all(): array {
        $table = static::$table;
        $stmt = DBConnection::getPDO()->query("SELECT * FROM ${table}");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stmt->fetchAll();
    }

    public static function findById(int $id): Model {
        $table = static::$table;
        $stmt = DBConnection::getPDO()->prepare("SELECT * FROM ${table} WHERE id = ?");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function getNextId(): int {
        $table = static::$table;
    
        $stmt = DBConnection::getPDO()->query("SHOW TABLE STATUS LIKE '$table'");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        return $stmt->fetch()->Auto_increment;
    }
}
<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

class Profil extends Model {

    public static $table = 'Profil';

    public static function deleteProfil(int $idProfil) {
        $tableName = self::$table;
        $stmt = DBConnection::getPDO()->prepare("DELETE FROM $tableName WHERE idProfil = ?");
        $stmt->execute([$idProfil]);
    }

    public static function create(string $username, string $email, string $password): int {
        $tableName = self::$table;

        $stmt = DBConnection::getPDO()->prepare("INSERT INTO $tableName (username, email, motDePasse) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, sha1($password)]);
        return DBConnection::getPDO()->lastInsertId();
    }

    public static function getIdWhere(array $whereConditions): int {
        $tableName = static::$table;
        $queryCondition = implode(' and ', array_map(function($condition) {
            return "$condition = :$condition";
        }, array_keys($whereConditions)));

        $stmt = DBConnection::getPDO()->prepare("SELECT idProfil FROM {$tableName} WHERE {$queryCondition}");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute($whereConditions);
        return $stmt->fetch()->idProfil;
    }
}
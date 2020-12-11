<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

class Contributeur extends Model {

    public static $table = 'Contributeur';

    public static function isConnected(string $username, string $password) {
        $table = self::$table;
        $profilTable = Profil::$table;

        $stmt = DBConnection::getPDO()->prepare("SELECT count(idProfil) 
            FROM ${profilTable} 
            NATURAL JOIN ${table}
            WHERE username = ? AND motDePasse = ?"
        );
        $stmt->execute([$username, sha1($password)]);
        return $stmt->fetchColumn();
    }

    public static function all(): array {
        $table = self::$table;
        $profilTable = Profil::$table;

        $stmt = DBConnection::getPDO()->query("SELECT idProfil, username, email FROM $table NATURAL JOIN $profilTable");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stmt->fetchAll();
    }

    public static function deleteProfil(int $idProfil) {
        $tableName = self::$table;
        $stmt = DBConnection::getPDO()->prepare("DELETE FROM $tableName WHERE idProfil = ?");
        $stmt->execute([$idProfil]);

        Profil::deleteProfil($idProfil);
    }

    public static function create(string $username, string $email, string $password): int {
        $table = self::$table;

        $idProfil = Profil::create($username, $email, $password);

        $stmt = DBConnection::getPDO()->prepare("INSERT INTO $table (idProfil) VALUES (?)");
        $stmt->execute([$idProfil]);
        return DBConnection::getPDO()->lastInsertId();
    }
}
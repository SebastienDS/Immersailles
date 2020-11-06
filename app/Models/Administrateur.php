<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

class Administrateur extends Model {

    public static $table = 'Administrateur';

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
}
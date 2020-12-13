<?php


namespace App\Models;


use Database\DBConnection;


class Session extends Model {

    public static $table = 'Session';


    public static function create(int $idProfil): int {
        $table = self::$table;

        $stmt = DBConnection::getPDO()->prepare("INSERT INTO $table (dateTime, idProfil) VALUES (?, ?)");
        $stmt->execute([date("Y-m-d H:i:s"), $idProfil]);
        return DBConnection::getPDO()->lastInsertId();
    }

}
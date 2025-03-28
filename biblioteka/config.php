<?php
class Database {
    private static $pdo = null;

    public static function getConnection() {
        if (self::$pdo === null) {
            self::$pdo = new PDO('mysql:host=localhost;dbname=biblioteka', 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$pdo;
    }
}
?>

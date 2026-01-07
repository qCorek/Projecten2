<?php
declare(strict_types=1);

namespace App\Database;

use App\Config\Config;
use PDO;
use PDOException;

final class Connection
{
    private static ?PDO $pdo = null;

    public static function pdo(): PDO
    {
        if (self::$pdo instanceof PDO) {
            return self::$pdo;
        }

        self::$pdo = self::createPdo();
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return self::$pdo;
    }

    private static function createPdo(): PDO
    {
        // SQLite (default, easiest for school projects)
        $dsn = 'sqlite:' . Config::SQLITE_PATH;

        // For MySQL, example:
        // $dsn = 'mysql:host=localhost;dbname=crud;charset=utf8mb4';
        // return new PDO($dsn, 'username', 'password');

        try {
            return new PDO($dsn);
        } catch (PDOException $e) {
            throw new PDOException('Database connection failed: ' . $e->getMessage(), (int)$e->getCode());
        }
    }
}

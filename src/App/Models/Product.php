<?php

namespace Main\App\Models;

use Main\Config;
use \PDO;

class Product
{
    public string|PDO $pdo;
    protected static $connected = false;
    protected static function connect(): PDO|bool
    {
        if (!self::$connected) {
            $connection = new \PDO('mysql:host='.Config::DB_HOST.';port=3306;dbname='.Config::DB_NAME.';charset=utf8mb4', Config::DB_USERNAME, Config::DB_PASSWORD);
            self::$connected = $connection;
        }
        return self::$connected;
    }
    public static function query(string $sql, array $params = []): ?array
    {
        $statement = Product::connect()->prepare($sql);
        $statement->execute($params);
        return $statement->fetchall(PDO::FETCH_ASSOC) ?: null;
    }
    public static function insert(string $sql): bool|\PDOStatement
    {
        return Product::connect()->prepare($sql);
    }
    public static function delete(string $sql): bool|\PDOStatement
    {
        return Product::connect()->prepare($sql);
    }
}
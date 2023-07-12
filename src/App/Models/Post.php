<?php

namespace Main\App\Models;

use Main\Config;
use \PDO;

class Post
{
    public string|PDO $pdo;
    public function __construct()
    {
        try {
            $this->pdo = new \PDO('mysql:host='.Config::DB_HOST.';port=3306;dbname='.Config::DB_NAME.';charset=utf8mb4', Config::DB_USERNAME, Config::DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (\PDOException $ex) {
            $this->pdo = $ex->getMessage();
        }
    }
    public function query(string $sql, array $params = []): ?array
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        return $statement->fetchall(PDO::FETCH_ASSOC) ?: null;
    }
    public function insert(string $sql): bool|\PDOStatement
    {
        return $this->pdo->prepare($sql);
    }
    public function delete(string $sql)
    {
        return $this->pdo->prepare($sql);
    }
}
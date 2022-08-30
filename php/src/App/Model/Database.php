<?php

namespace App\Model;

use App\Inc\DotEnv;

(new DotEnv(__DIR__ . '/../../.env'))->load();

class Database
{
    protected $conn = null;

    protected function getConnection()
    {
        try {
            $dsn = 'mysql:host=' . $_SERVER['DB_HOST'] . ';dbname=' . $_SERVER['DB_NAME'] . '';
            $this->conn = new \PDO($dsn, $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);
            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die('Connection error : ' . $e->getMessage());
        }
        return $this->conn;
    }
}
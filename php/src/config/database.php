<?php
class Database
{
    private const DB_HOST = 'db';
    private const DB_USER = 'root';
    private const DB_PASS = 'pass';
    private const DB_NAME = 'database';

    private $dsn = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . '';

    protected $conn = null;

    public function getConnection()
    {
        try {
            $this->conn = new PDO($this->dsn, self::DB_USER, self::DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Connection error : ' . $e->getMessage());
        }
        return $this->conn;
    }
}
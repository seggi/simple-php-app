<?php
class Config
{
    private const DB_HOST = 'db';
    private const DB_USER = 'root';
    private const DB_PASS = 'pass';
    private const DB_NAME = 'database';

    private $dsn = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . '';

    protected $conn = null;

    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, self::DB_USER, self::DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Connection Failed : ' . $e->getMessage());
        }
        return $this->conn;
    }

    public function test_input($data)
    {
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);

        return $data;
    }

    public function message($content, $status)
    {
        return json_encode(["message" => $content, 'error' => $status]);
    }
}
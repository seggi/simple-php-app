<?php

namespace App\Model;

use App\Model\Database;

class Product extends Database
{
    public $conn;
    private const product_table = "products";

    public $id;
    public $sku;
    public $name;
    public $price;
    public $product_size;
    public $product_height;
    public $product_weight;
    public $product_length;
    public $product_width;

    public function __construct()
    {
        $this->conn = $this->getConnection();
    }

    public function read()
    {
        $query = "SELECT p.id, p.sku, p.name, p.price, p.currency, 
        p.product_weight, p.name, p.product_height, p.product_size, p.product_length, p.product_width
        FROM " . self::product_table . " p ORDER BY p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function checkSku($sku)
    {
        $query = "SELECT * FROM " . self::product_table . " WHERE sku=:sku";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":sku", $sku);
        $stmt->execute();

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            return "Empty";
        }
        return "Not empty";
    }

    public function create()
    {
        $query = "INSERT INTO " . self::product_table . " 
        SET  sku=:sku, name=:name, price=:price, product_length=:product_length, 
        product_height=:product_height, product_size=:product_size, 
        product_weight=:product_weight, product_width=:product_width";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":product_size", $this->product_size);
        $stmt->bindParam(":product_height", $this->product_height);
        $stmt->bindParam(":product_weight", $this->product_weight);
        $stmt->bindParam(":product_width", $this->product_width);
        $stmt->bindParam(":product_length", $this->product_length);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete()
    {
        $sql = "DELETE FROM " . self::product_table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
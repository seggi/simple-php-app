<?php

namespace App\Model;

use App\Model\Database;

class Product extends Database
{
    public $conn;
    private const product_table = "products";
    private const product_type_table = "product_types";
    private const product_type_spec_table = "product_type_spec";

    public $id;
    public $sku;
    public $name;
    public $price;
    public $type_values;
    public $product_type_id;
    public $product_type_name;
    public $product_type_spec_id;
    public $type_spec;

    public function __construct()
    {
        $this->conn = $this->getConnection();
    }

    public function read()
    {
        $query = "SELECT p.id, p.sku, p.name, p.price, p.currency, p.type_values, pt.name, pts.type_spec
        FROM " . self::product_table . " p LEFT JOIN " . self::product_type_table . " pt ON p.product_type_id  = pt.id 
        LEFT JOIN " . self::product_type_spec_table . " pts ON pt.type_spec_id = pts.id GROUP BY p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne()
    {
        $query = "SELECT
        c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
        FROM
        " . $this->table_name . " p
        LEFT JOIN 
        categories c ON p.category_id = c.id WHERE p.id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->price = $row['price'];
        $this->description = $row['description'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }

    public function create()
    {
        $query = "INSERT INTO " . self::product_table . " 
        SET  sku=:sku, name=:name, price=:price, product_type_id=:product_type_id, type_values=:type_values";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":product_type_id", $this->product_type_id);
        $stmt->bindParam(":type_values", $this->type_values);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
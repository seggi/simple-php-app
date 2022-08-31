<?php

namespace App\Controller;

use App\Model\Product;

class ProductController extends Product
{
    public function fetchAllProduct()
    {
        $stmt = $this->read();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $products_arr = array();
            $products_arr["records"] = array();

            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $product_item = array(
                    "id" => $id,
                    "name" => $name,
                    // "description" => html_entity_decode($description),
                    "price" => $price,
                    "value" => $values,
                    "currency" => $currency,
                    "type_spec" => $type_spec
                );

                array_push($products_arr["records"], $product_item);
            }

            http_response_code(200);
            echo json_encode($products_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "No products found."));
        }
    }

    public function saveProduct()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (
            !empty($data->name) && !empty($data->price) &&
            !empty($data->description) && !empty($data->category_id)
        ) {
            $this->name = $data->name;
            $this->price = $data->price;
            $this->description = $data->description;
            $this->category_id = $data->category_id;
            $this->created = date('Y-m-d H:i:s');

            if ($this->create()) {
                http_response_code(201);
                echo json_encode(array("message" => "this was created."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Unable to create this."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to create product. Data is incomplete"));
        }
    }

    public function fetchProductById($id)
    {
        $this->id = $id;
        $this->readOne();

        if ($this->name != null) {
            $product_arr = array(
                "id" =>  $this->id,
                "name" => $this->name,
                "description" => $this->description,
                "price" => $this->price,
                "category_id" => $this->category_id,
                "category_name" => $this->category_name
            );

            http_response_code(200);
            echo json_encode($product_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Product does not exist."));
        }
    }
}
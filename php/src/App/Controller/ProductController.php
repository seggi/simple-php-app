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
                    "sku" => $sku,
                    "price" => $price,
                    "product_length" => $product_length,
                    "currency" => $currency,
                    "product_weight" => $product_weight,
                    "product_width" => $product_width,
                    "product_size" => $product_size,
                    "product_height" => $product_height
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
            !empty($data->sku)
        ) {
            $uniqKey =  uniqid();
            $this->name = $data->name;
            $this->price = $data->price;
            $this->product_length = $data->product_length;
            $this->product_weight = $data->product_weight;
            $this->product_size = $data->product_size;
            $this->product_width = $data->product_width;
            $this->product_height = $data->product_height;
            $this->sku = $data->sku;

            if ($this->checkSku($this->sku) == "Empty") {
                if ($this->create()) {
                    http_response_code(201);
                    echo json_encode(array("message" => "Product was added."));
                } else {
                    http_response_code(503);
                    echo json_encode(array("message" => "Unable to add product."));
                }
            } else {
                http_response_code(200);
                echo json_encode(array("message" => "Product with same SKU already exits."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to add product. Data is incomplete"));
        }
    }

    public function deleteProduct()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        foreach ($data as $address) {
            $this->id = $address['id'];
            $this->delete();
        }

        http_response_code(200);
        echo json_encode(array("message" => "Product deleted."));
    }
}
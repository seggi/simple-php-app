<?php

namespace App\Api;

use App\Controller\ProductController;

class ProductRoute
{
    private $requestMethod;
    private $productId;
    private $productController;

    public function __construct($requestMethod, $productId)
    {
        $this->productId = $productId;
        $this->requestMethod = $requestMethod;
        $this->productController = new ProductController();
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->productId) {
                    $this->productController->fetchProductById($this->productId);
                } else {
                    $this->productController->fetchAllProduct();
                }
                break;

            case 'POST':
                $this->productController->saveProduct();
                break;

            case 'DELETE':
                $this->productController->deleteProduct();
                break;

            default:
                $this->notFoundResponse();
                break;
        }
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
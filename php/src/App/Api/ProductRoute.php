<?php

namespace App\Api;

use App\Controller\ProductController;

class ProductRoute
{
    private $requestMethod;
    private $productId;
    private $productController;

    public function __construct($requestMethod, $userId)
    {
        $this->userId = $userId;
        $this->requestMethod = $requestMethod;
        $this->productController = new ProductController();
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->productId) {
                    echo "No yet implemented";
                }
                $this->productController->data();
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
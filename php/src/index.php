<?php

use App\Api\ProductRoute;

require_once("./vendor/autoload.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST, PUT, PATCH, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Origin, X-Api-Key, X-Requested-With, Content-Type, Accept, Authorization');




$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// if ($uri[1] !== 'product') {
//     header("HTTP/1.1 404 Not Found");
//     exit();
// }

$productId = isset($_GET['id']) ? $_GET['id'] : null;
// if (isset($uri[2])) {
//     $productId = (int) $uri[2];
// }

$requestMethod = $_SERVER["REQUEST_METHOD"];

$route = new ProductRoute($requestMethod, $productId);
$route->processRequest();
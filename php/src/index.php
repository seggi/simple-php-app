<?php

use App\Api\ProductRoute;

require_once("./vendor/autoload.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, PUT, PATCH, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Origin, X-Api-Key, X-Requested-With, Content-Type, Accept, Authorization');

$config['index_page'] = '';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$productId = isset($_GET['id']) ? $_GET['id'] : null;
$requestMethod = $_SERVER["REQUEST_METHOD"];

$route = new ProductRoute($requestMethod, $productId);
$route->processRequest();
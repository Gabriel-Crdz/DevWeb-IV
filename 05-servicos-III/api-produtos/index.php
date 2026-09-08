<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/src/controller/ProdutoController.php';
$controller = new ProdutoController();
$metodo = $_SERVER['REQUEST_METHOD'];
if ($metodo === 'GET') {
    $controller->listar();
    require_once "listar.php";
}
else if ($metodo === 'POST') {
    $produto = $controller->criar();
    require_once "form.php";
}
else{
    http_response_code(405);
    echo json_encode(["erro"=>"Metodo não permitido"]);
}

?>


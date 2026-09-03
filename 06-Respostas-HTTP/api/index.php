<?php
$dadosPost = json_decode((file_get_contents('php://input')), true)

$banco = new BancoDados();

$service = new ProdutoService($banco);

$controller = new ProdutoController($service);

echo $controller->criar($dadosPost);

?>
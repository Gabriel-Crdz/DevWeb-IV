<?php

http_response_code(201); // 201: algo foi criado
header("Content-Type: application/json");

echo json_encode(["status" => 201,
    "Mensagem"=> "Requisição bem sucedida!"]);

?>
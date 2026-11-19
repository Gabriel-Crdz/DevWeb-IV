<?php

header('Content-Type: application/json');

$url = "[URL do firebase][Nome da tabela].json?auth=[firebase secrets]";
  
$dados = file_get_contents($url);

echo $dados;
?>
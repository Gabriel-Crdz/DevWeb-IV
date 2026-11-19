<?php
$temp = $_GET['temp'] ?? null;
$umid = $_GET['umid'] ?? null;

if ($temp && $umid) {
    $url = "[URL do firebase][Nome da tabela].json?auth=[firebase secrets]";
  
    $dados = json_encode([
        "temperatura" => (float)$temp,
        "umidade" => (float)$umid
    ]);
  
    $opcoes = [
        "http" => [
        "method" => "POST",
        "header" => "Content-Type:application/json\r\n",
        'content' => $dados
        ]
    ];
  
    $resposta = file_get_contents($url, false, stream_context_create($opcoes));
    echo "Firebase respondeu: " . $resposta;
} else {
    echo "ERRO: Parametros ausentes.";
}
?>
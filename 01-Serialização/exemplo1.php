<?php

$vetor = ["nome" => "Carlos",
    "idade" => 21,
    "profissao" => "professor"
];

$dadosSerializado = serialize($vetor);
echo "Dados Serializados: " . $dadosSerializado;

echo "<br>";

$dadosRecuperados = unserialize($dadosSerializado);

echo "Dados Recuperados: ";
var_dump($dadosRecuperados);
?>
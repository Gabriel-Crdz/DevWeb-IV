<?php

$conteudo_json = file_get_contents("escola.json"); // Pega o conteudo do arquivo

// echo "<hr>Formato ARRAY<hr>";

// echo "<pre>";
// var_dump($conteudo_json);
// echo "</pre>";

// $dados = json_decode($conteudo_json);

// echo "<hr>Formato JSON<hr>";

// echo "<pre>";
// print_r($dados);
// echo "</pre>";

/* Mostrando um valor especifico */

$dados_obj = json_decode($conteudo_json);
$dados_array = json_decode(json_encode($dados_obj), true);

echo "Nome do aluno(Array): " . $dados_array['alunos'][0]['nome'] . "<br>";
echo "Nome do aluno(Obj): " . $dados_obj->alunos[0]->nome . "<br>";

?>
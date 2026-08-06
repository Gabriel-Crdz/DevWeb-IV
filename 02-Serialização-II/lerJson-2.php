<?php

$conteudo_json = file_get_contents("escola.json"); // Pega o conteudo do arquivo
$dados_obj = json_decode($conteudo_json);
$dados_array = json_decode(json_encode($dados_obj), true); // Transforma em array

/* Todos os dados */
// foreach($dados_array as $dados){
//     echo "<pre>";
//     print_r($dados);
//     echo "<pre>";
// }

foreach($dados_array['alunos'] as $dados){
    echo "Nome do aluno: " . $dados['nome'] . "<br>";
    echo "Turma: " . $dados['turma'] . "<br>";
    echo "Status: " . $dados["status"] . "<br>";

    /* Percorrendo o vetor dentro do vetor */
    echo "Boletim<br>";
    foreach($dados['boletim'] as $boletim){
        echo $boletim['materia'] . " - ";
        echo "Nota: " . $boletim['nota'] . "<br>";
    }
    
    echo "<hr>";
}

?>
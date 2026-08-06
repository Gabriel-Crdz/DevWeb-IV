<?php

$conteudo_json = file_get_contents("escola.json"); // Pega o conteudo do arquivo
$dados = json_decode($conteudo_json, true); // Transforma em array
$resultado = [];

foreach($dados['alunos'] as $aluno){
    $encontrou = true;
    foreach($_GET as $campo => $valor){
        if(!isset($aluno[$campo])){
            $encontrou=false;
            break;
        }

        if(stripos((string)($aluno[$campo]), $valor) === false){
            $encontrou = false;
            break;
        }
    }
    if($encontrou){
        $resultado[] = $aluno;
    }
}

echo "<pre>";
print_r($resultado);
echo "<pre>";

?>
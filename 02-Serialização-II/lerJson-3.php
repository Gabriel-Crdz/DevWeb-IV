<?php

$conteudo_json = file_get_contents("escola.json"); // Pega o conteudo do arquivo
$dados_obj = json_decode($conteudo_json);
$dados_array = json_decode(json_encode($dados_obj), true); // Transforma em array

if ($_POST) {
    $encontrou = false;
    foreach ($dados_array['alunos'] as $dados) {
        if ($_POST["nome"] === $dados['nome']) {
            $encontrou = true;
            echo "Nome do aluno: " . $dados['nome'] . "<br>";
            echo "Turma: " . $dados['turma'] . "<br>";
            echo "Status: " . $dados["status"] . "<br>";

            /* Percorrendo o vetor dentro do vetor */
            echo "Boletim<br>";
            foreach ($dados['boletim'] as $boletim) {
                echo $boletim['materia'] . " - ";
                echo "Nota: " . $boletim['nota'] . "<br>";
            }

            echo "<hr>";
        }
    }

    if(!$encontrou){
        echo "Aluno não encontrado!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lendo JSON</title>
</head>

<body>
    <form action="" method="POST">
        <input type="text" name="nome" placeholder="Nome do Aluno">
        <button type="submit">ENVIAR</button>
    </form>
</body>

</html>
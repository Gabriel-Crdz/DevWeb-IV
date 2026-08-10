<?php

if($_POST){
    $encontrou = false;
    $string = "https://viacep.com.br/ws/" . $_POST['cepInformado'] . "/json/";
    
    $url = $string;

    // echo $url ."<br>";

    $json = file_get_contents($url);

    $dados = json_decode($json);

    // var_dump($dados);
    if($dados->cep){
        $encontrou = true;
        echo "<table>";

        echo "<tr><th>CEP</th><th>Logadouro</th><th>Complemento</th><th>Unidade</th>";
        echo "<th>Bairro</th><th>Localidade</th><th>UF</th><th>Estado</th>";
        echo "<th>Regiao</th><th>IBGE</th><th>GIA</th><th>DDD</th><th>Siafi</th></tr>";

        echo "<tr>";
        echo "<td>" . $dados->cep . "</td>";
        echo "<td>" . $dados->logradouro . "</td>";
        echo "<td>" . $dados->complemento . "</td>";
        echo "<td>" . $dados->unidade . "</td>";
        echo "<td>" . $dados->bairro . "</td>";
        echo "<td>" . $dados->localidade . "</td>";
        echo "<td>" . $dados->uf . "</td>";
        echo "<td>" . $dados->estado . "</td>";
        echo "<td>" . $dados->regiao . "</td>";
        echo "<td>" . $dados->ibge . "</td>";
        echo "<td>" . $dados->gia . "</td>";
        echo "<td>" . $dados->ddd . "</td>";
        echo "<td>" . $dados->siafi . "</td>";

        echo "</tr></table>";
    }

    if(!$encontrou){
        echo "CEP NÃO VALIDO!!";
    }
}

?>

<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        td, th{
            border: 1px solid black;
            padding: 5px;
        }
        table{
            border-collapse: collapse;
        }
        form{
            margin-top: 30px;
        }
    </style>
    <title>CEP</title>
</head>
<body>
    <form action="" method="POST">

        <label for="">CEP:</label>
        <input type="text" name="cepInformado">

        <button type="submit">CONSULTAR</button>
    </form>
</body>
</html>
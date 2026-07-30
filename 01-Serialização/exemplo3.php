<?php

$jsonErrado = '{"nome": "Arthur", "idade":21, "profissao":"professor"}';

try{
    $jsonRecuperadoVetor = json_decode($jsonErrado, true, 512, JSON_THROW_ON_ERROR); // 2º parametro(true): decodifica em vetor, se não decodifica em objeto, 3º parametro: memoria usado, 4º parametro: exceção que ele lança
    $jsonRecuperadoObjeto = json_decode($jsonErrado, false, 512, JSON_THROW_ON_ERROR);
    echo "Json Recuperado Vetor: ";
    var_dump($jsonRecuperadoVetor);

    echo "<br><br>";

    echo "Json Recuperado Objeto: ";
    var_dump($jsonRecuperadoObjeto);
}
catch(JsonException $e){
    echo $e->getMessage();
}

?>
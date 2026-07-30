<?php

class Serializadora{
    public $nome;
    public $idade;
    public $profissao;

    public function __construct(String $nome, int $idade, String $profissao){
        $this->nome = $nome;
        $this->idade = $idade;
        $this->profissao = $profissao;
    }
}

$objeto = new Serializadora("Arnaldo Fritz", 35, "professor");

$objetoSerializado = serialize($objeto);

echo "Objeto Serializado: ";
echo $objetoSerializado;

echo "<br>";

$objetoRecuperado = unserialize($objetoSerializado);
echo "Objeto Recuperado: ";
var_dump($objetoRecuperado);

?>
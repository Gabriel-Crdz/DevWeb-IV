<?php

class Pessoa implements JsonSerializable{
    private String $nome;
    private int $idade;
    private float $salario;
    private DateTime $nascimento;

    public function __construct(string $nome, int $idade, float $salario, DateTime $nascimento){
        $this->nome = $nome;
        $this->idade = $idade;
        $this->salario = $salario;
        $this->nascimento = $nascimento;
    }

    public function jsonSerialize(){
        return [
            "nome" => $this->nome,
            "idade" => $this->idade,
            "nascimento" => $this->nascimento->format('d/m/Y')
        ];
    }

}

$objeto = new Pessoa("Carlos", 26, 2000, new DateTime());

$dadoSerializado = json_encode($objeto, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo $dadoSerializado;

/* Salvando em um Arquivo */

file_put_contents("pessoa.json", $dadoSerializado);
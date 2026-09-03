<?php

/* Exemplo de Acoplamento */
// class BancoDados{
//     public function salvar($nome){
//         return "Produto'{$nome}' salvo com sucesso!";
//     }
// }

// class ProdutoController{
//     public function criar($nome){
//         $banco = new BancoDados();
//         return $banco->salvar($nome);
//     }
// }
// $controller = new ProdutoController();
// echo $controller->criar("Teclado");

/* Desacoplando o BancoDados do metodo */

class BancoDados{
    public function salvar(string $nome){
        return "Produto'{$nome}' salvo com sucesso!";
    }
}

class ProdutoController{
    private BancoDados $banco;

    public function __construct(BancoDados $banco){
        $this->banco = $banco;
    }
    public function criar(string $nome){
        return $this->banco->salvar($nome);
    }
}

$banco = new BancoDados();
$controller = new ProdutoController($banco);
echo $controller->criar("Teclado");


?>
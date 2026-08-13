<?php
class ProdutoDTO {
    public int $id;
    public string $nome;
    public float $preco;

    public function __construct(int $id, string $nome, float $preco) {
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
        // A SENHA NÃO ENTRA AQUI DE JEITO NENHUM!
    }
    public function toArray(): array {
        return [
            'id'    => $this->id,
            'nome'  => $this->nome,
            'preco' => $this->preco
        ];
    }
}
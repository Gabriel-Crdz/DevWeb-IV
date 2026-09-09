<?php
class ProdutoCreateDTO{
    public string $nome;
    public float $preco;
    public int $estoque;

    private $precoOriginal;
    private $estoqueOriginal;

    public function __construct(array $dados) {
        $this->nome = trim((string)($dados['nome'] ?? ''));
        $this->precoOriginal = $dados['preco'] ?? '';
        $this->estoqueOriginal = $dados['estoque'] ?? '';

        $this->preco = is_numeric($this->precoOriginal) ? (float)$this->precoOriginal : 0.0;
        $this->estoque = is_numeric($this->estoqueOriginal) ? (int)$this->estoqueOriginal : 0;
    }

    public function validar(): array {
        $erros = [];

        if ($this->nome === '') {
            $erros[] = 'O campo nome é obrigatório.';
        }

        if ($this->precoOriginal === '' || $this->precoOriginal === null) {
            $erros[] = 'O campo preço é obrigatório.';
        } elseif (!is_numeric($this->precoOriginal)) {
            $erros[] = 'O preço deve ser um número válido.';
        } elseif ($this->preco <= 0) {
            $erros[] = 'O preço deve ser maior que zero.';
        }

        if ($this->estoqueOriginal === '' || $this->estoqueOriginal === null) {
            $erros[] = 'O campo estoque é obrigatório.';
        } elseif (filter_var($this->estoqueOriginal, FILTER_VALIDATE_INT) === false) {
            $erros[] = 'O estoque deve ser um número inteiro válido.';
        } elseif ($this->estoque < 0) {
            $erros[] = 'O estoque não pode ser negativo.';
        }

        return $erros;
    }
}

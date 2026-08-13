<?php
require_once '../ProdutoDTO.php';
class ProdutoService {
    private $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function cadastrar($nome, $preco, $estoque) {
        if (empty($nome) || empty($preco) || empty($estoque)) {
            throw new Exception("Preencha todos os campos!");
        }
        $stmt = $this->pdo->prepare('SELECT id FROM usuarios WHERE email = ?');
        $stmt->execute([$nome]);
        if ($stmt->fetch()) {
            throw new Exception("Este e-mail já está cadastrado!");
        }

        $stmt = $this->pdo->prepare('INSERT INTO produtos (nome, preco, estoque) VALUES (?, ?, ?)');
        $stmt->execute([$nome, $preco, $estoque]);

        return "Produto cadastrado com sucesso!";
    }

    public function cadastrarComDTO($nome, $preco, $estoque): ProdutoDTO {

        if (empty($nome) || empty($preco) || empty($estoque)) {
            throw new Exception("Preencha todos os campos!");
        }
        $stmt = $this->pdo->prepare('SELECT id FROM usuarios WHERE email = ?');
        $stmt->execute([$nome]);
        if ($stmt->fetch()) {
            throw new Exception("Este e-mail já está cadastrado!");
        }
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
        $stmt->execute([$nome, $email, $senhaHash]);
        $idGerado = (int) $this->pdo->lastInsertId();
        return new ProdutoDTO($idGerado, $nome, $preco);
    }

    public function listarTodos(): array {
        $stmt = $this->pdo->query('SELECT id, nome, email FROM usuarios');
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];
        foreach ($usuarios as $u) {
            $dtos[] = new UsuarioDTO((int)$u['id'], $u['nome'], $u['email']);
        }
        return $dtos;
    }

    public function deletar(int $id): bool {
        $stmt = $this->pdo->prepare('SELECT id FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);
        if (!$stmt->fetch()) {
            throw new Exception("Usuário não encontrado!");
        }

        $stmt = $this->pdo->prepare('DELETE FROM usuarios WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
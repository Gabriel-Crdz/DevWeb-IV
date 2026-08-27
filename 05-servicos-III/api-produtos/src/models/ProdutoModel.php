<?php
require_once __DIR__ . '/../../config/Database.php';

class ProdutoModel{
    private PDO $conn;

    public function __construct(){
        $this->conn = Database::getConnection();
    }

    public function criar(ProdutoCreateDTO $dto): int{
        $sql = "insert into produtos(nome, preco, estoque) values" . "(:nome, :preco, :estoque)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":nome", $dto->nome);
        $stmt->bindValue(":preco", $dto->preco);
        $stmt->bindValue(":estoque", $dto->estoque);
        $stmt->execute();
        
        return (int) $this->conn->lastInsertId();
    }

    public function buscarPorId(int $id):?array{
        $sql = "select * from produtos where id = :id AND ativo = 1";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $produto = $stmt->fetch();

        return $produto ?: null;
    }

}

?>

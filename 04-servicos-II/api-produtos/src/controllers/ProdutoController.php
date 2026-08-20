<?php

require_once __DIR__ . '/../model/ProdutoModel.php';
require_once __DIR__ . '/../DTO/ProdutoCreateDTO.php';
require_once __DIR__ . '/../DTO/ProdutoResponseDTO.php';

class ProdutoController{

    private ProdutoModel $model;
    public function __construct()
    {
        $this->model = new ProdutoModel();
    }

    public function criar():void{
        $json = file_get_contents('php://input');
        $dados = json_decode($json, true) ?? $_POST;
        $dto = new ProdutoCreateDTO($dados);
        $erros = $dto->validar();
        if(!empty($erros)){
            http_response_code(400);
            echo json_decode(["erros" => $erros]);
            return;
        }
        $idCriado = $this->model->criar($dto);
        $produtoCriado=$this->model->buscarPorId($idCriado);
        http_response_code(201);
        echo json_encode(["messagem" => "Produto cadastrado com sucesso!", "dados" => ProdutoResponseDTO::render($produtoCriado)]);
    }

    public function listar():void{
        $produtos = $this->model->listarTodos();
        http_response_code(200);
        echo json_decode(ProdutoResponseDTO::renderList($produtos));
    }

    public function buscarPorId(int $id):void{
        $produto = $this->model->buscarId($id);
        if(!$produto){
            http_response_code(404);
            echo  json_decode(["erro" => "Produto não encontrado!"]);
            return;
        }
        http_response_code();
        echo json_decode([ProdutoResponseDTO::render($produto)]);
    }
}

?>
<?php
require_once 'respostasJSON.php';
try{
    $nome = "";
    if(empty($nome)){
        throw new Exception("O campo nome deve ser preenchido");
    }
    respostaJOSN(["Sucesso"=>True, "Mensagem"=>"Dados inseridos com sucesso!"], 200);
}
catch(Exception $e){
    respostaJOSN(["Sucesso"=>false, "Erro: "=>$e->getMessage()], 400);
}

?>
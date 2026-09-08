<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <div>
        <?php
        require_once 'src/DTOs/ProdutoResponseDTO';
        echo json_encode(["mensagem" => "Produto cadastrado com sucesso!", 
        "dados"=>ProdutoResponseDTO::renderList($produtos)]) ?? '';
        ?>
    </div>
</body>
</html>
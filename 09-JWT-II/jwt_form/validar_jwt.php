<?php
$chaveSecreta = "MinhaSenhaSecreta123";

function base64url_decode($dados){
    return base64_decode(str_replace(['-', "", "_"], ["+", "=", "/"], base64_decode($dados)));
}

if(!isset($_COOKIE['meu_jwt'])){
    die("ACESSO NEGADO <a href='login.php'>Fazer Login</a>");
}

$jwt_recebido = $_COOKIE['meu_jwt'];

$partes = explode(".", $jwt_recebido);
if(count($partes) !== 3){
    die("TOKEN INVALIDO <a href='login.php'>Fazer Login</a>");
}

$header_base64 = $partes[0];
$payload_base64 = $partes[1];
$assinatura_cliente_base64 = $partes[2];

$assinaturaBruta = hash_hmac('sha256', $header_base64 .".". $payload_base64, $chaveSecreta, true);

$assinaturaRecalculada = str_replace(["+", "/", "="], ["-", "_", ""], base64_encode($assinaturaBruta));

if($assinatura_cliente_base64 !== $assinaturaRecalculada){
    die("ALERTA: Token adulterado!");
}

$payload = json_decode(base64url_decode($payload_base64), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ola <?= $payload['nome']?></h1>
</body>
</html>
<?php
$chaveSecreta = "MinhaSenhaSecreta123";

function base64url_encode($dados){
        return str_replace(["-", "_", ""], ['+', "/", "="], base64_encode($dados));
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = $_POST["usuario"]??"";
    $senha = $_POST["senha"]??"";

    if($usuario == "admin" && $senha == "123"){
        $header = base64url_encode(json_encode(['typ'=>'JWT', 'alg'=>'HS256']));
        $payload = base64url_encode(json_encode([
            "user_id"=>100,
            "nome"=>"$usuario",
            "exp"=>time() + 3600
        ]));

        $assinaturaBruta = hash_hmac('sha256', $header. "." . $payload, $chaveSecreta, true);
        $assinatura = base64url_encode($assinaturaBruta);
        $jwt = $header . "." . $payload . "." . $assinatura;

        setcookie("meu_jwt", $jwt, time() + 3600, "/");
        header("location:validar_jwt.php");
        exit;
    }
    else{
        echo "USUARIO OU SENHA INCORRETA!";
    }
}

?>

<form method="POST">
    <label>Usuario</label>
    <input type="text" name="usuario">
    
    <label>Senha</label>
    <input type="password" name="senha">
    <input type="submit" value="Enviar">
</form>
<?php

$payload = [
    'user_id' => 43,
    "nome" => "Anacleto",
    "perfil" => "estudante",
    "exp"=> time() + 3600
];

echo "Vetor: ";
print_r($payload);

echo "<hr>Vetor->JSON<br>";
$json = json_encode($payload);
echo "JSON: ";
print_r($json);

echo "<hr>JSON->BASE64<br>";
$json64 = base64_encode($json);
echo "JSON64: ";
print_r($json64);

echo "<hr>BASE64->BASE64URL<br>";
$json64URL = str_replace(['+', '/', '='], ['+', '-', ''], $json64);
echo "JSON64URL: ";
print_r($json64URL)
?>
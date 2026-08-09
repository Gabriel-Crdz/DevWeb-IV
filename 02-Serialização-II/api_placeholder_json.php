<?php

$url = "https://jsonplaceholder.typicode.com/users/";
$string = file_get_contents($url);
$json_array = json_decode($string, true);

echo "<pre>";
print_r($json_array);
echo "<pre>";

echo "<table border=1>";
echo "<tr>";

echo "<td>ID</td><td>Nome</td><td>Usuario</td><td>email</td>
<td>endereço</td><td>Telefone</td><td>Website</td><td>Companhia</td>";

echo "</tr>";

foreach($json_array as $dados){
    echo "<tr>";
    echo "<td>" . $dados['id'] . "</td>";
    echo "<td>" . $dados['name'] . "</td>";
    echo "<td>" . $dados['username'] . "</td>";
    echo "<td>" . $dados['email'] . "</td>";

    echo "<td>" . $dados['address']['street'] . " - ";
    echo $dados['address']['suite'] . " - ";
    echo $dados['address']['city'] . " - ";
    echo $dados['address']['zipcode'] . " - ";
    echo $dados['address']['geo']['lat'] . " - ";
    echo $dados['address']['geo']['lng'];

    echo "<td>" . $dados['phone'] . "</td>";
    echo "<td>" . $dados['website'] . "</td>";

    echo "<td>" . $dados['company']['name'] . " - ";
    echo $dados['company']['catchPharse'] . " - ";
    echo $dados['company']['bs'] . "<td>";
    
    echo "</tr>";
}

echo "</table>";
?>
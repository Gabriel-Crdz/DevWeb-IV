<?php
// index.php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP + Firebase Realtime</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        #caixa-status { padding: 15px; border: 2px solid #2196F3; background-color: #e3f2fd; border-radius: 5px; }
        .texto-alerta { color: #0d47a1; font-weight: bold; }
    </style>
</head>
<body>

<h1>Mensagem em Tempo Real do Firebase</h1>

<div id="caixa-status">
    Mensagem atual: <span id="texto-status" class="texto-alerta">A carregar dados...</span>
</div>

<script type="module">
    // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
    import {getDatabase, onValue, ref} from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

    // Your web app's Firebase configuration
    const firebaseConfig = {
        apiKey: "AIzaSyCnHMydNlTz0hzsVo7iGD2WkWKYnptYYag",
        authDomain: "fir-php-44733.firebaseapp.com",
        databaseURL: "https://fir-php-44733-default-rtdb.firebaseio.com",
        projectId: "fir-php-44733",
        storageBucket: "fir-php-44733.firebasestorage.app",
        messagingSenderId: "1037636789107",
        appId: "1:1037636789107:web:1104cc9df8cfc4de175b06"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const db = getDatabase(app);
    const caminhoMensagem = ref(db, 'mensagem');
    onValue(caminhoMensagem, (snapshot) => {
        const valor = snapshot.val(); // Captura os dados atuais do banco(uma foto do banco atual)      
        if(valor !== null){
            document.getElementById("texto-status").innerHTML = valor
        }  
        else{
            document.getElementById("texto-status").innerHTML = "Nenhuma mensagem";
        }
    }); 

</script>
</body>
</html>
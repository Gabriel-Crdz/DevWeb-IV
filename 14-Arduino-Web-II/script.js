function buscarTodos(){
    fetch('ler.php') // Execução assincrona
    .then(resposta/* Salva o retorno do ler.php em json */ => resposta.json())
    .then(dados => { // O json retorna para o proximo then
        if(dados){
            const listaDeChaves = Object.keys(dados); // Constante com a lista das chaves de referencia do banco
            const ultimaChave = listaDeChaves[listaDeChaves.length - 1]; // Captura o ultimo registro
            const ultimaLeitura = dados[ultimaChave]; // Captura todos os dados do ultimo registro

            document.getElementById('temp').innerText = ultimaLeitura.temperatura;
            document.getElementById('umid').innerText = ultimaLeitura.umidade;
        
            const listaHtml = document.getElementById('historico');
            listaHtml.innerHTML = "";
            listaDeChaves.forEach(chave =>{
                const item = dados[chave];
                listaHtml.innerHTML += `<li>Temperatura: ${item.temperatura} ºC | Umidade: ${item.umidade} %</li>`;
            });
        }
    });
}

buscarTodos();
setInterval(buscarTodos, 5000);
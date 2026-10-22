// Import the functions you need from the SDKs you need// Importações usando a versão estável do Firebase
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
import { getDatabase, ref, push, onValue, remove, update, get } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

// Your web app's Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyAYAA6AQg9LPXAdP-e9MjsYupFA9XHXROk",
    authDomain: "aula-php-02.firebaseapp.com",
    projectId: "aula-php-02",
    storageBucket: "aula-php-02.firebasestorage.app",
    messagingSenderId: "526470815271",
    appId: "1:526470815271:web:1f1f874f36ae7c162ef802"
  };
// Inicializa o Firebase
const app = initializeApp(firebaseConfig);
const db = getDatabase(app);

const cardPh = document.getElementById("card-ph");
const cardTem = document.getElementById("card-temp");
const cardTurb = document.getElementById("card-turb");
const tabelaLeitura = document.getElementById("tabela-leituras");
const formEditar = document.getElementById("form-editar");

const leituraRef=ref(db, "leituras");
if(tabelaLeitura){

    onValue(leituraRef, (snapshot) => { // Captura os valores do banco

    if(snapshot.exists()){
        const dados = snapshot.val();
        let ultimaLeitura = null;

        Object.keys(dados).forEach((id) => { // Percorre o banco, é cria um objeto com todos os dados
            const item = dados[id];
            ultimaLeitura = item;
            const tr = document.createElement("tr");
            tr.innerHTML = "<td>" + item.data + " " +item.hora + "</td>" +
                           "<td>" + item.ph + " | " + item.temperatura + " ºC | " + item.turbidez + " NTU</td>" +
                            "<td><button class='btn-acao btn-alterar' data-id='"+ id +"'>Alterar<button>"  +
                            "<button class='btn-acao btn-excluir' data-id='"+ id +"'>Excluir<button></td>";
            tabelaLeitura.prepend(tr);
        });

        if(ultimaLeitura){
            cardPh.innerHTML = ultimaLeitura.ph;
            cardTem.innerHTML = ultimaLeitura.temperatura + "ºC"
            cardTurb.innerHTML = ultimaLeitura.turbidez + " NTU"
        }
    }
    tabelaLeitura.addEventListener("click", (evento) =>{
        const id = evento.target.getAttribute("data-id"); // Captura o id do item

        if(evento.target.classList.contains("btn-alterar")){
            window.location.href = "editar.php?id=" + id // Chama a pagina de edição
        }

        if(evento.target.classList.contains("btn-excluir")){ // Valida pela classe do botao
            if(confirm("Tem certeza que quer excluir?")){
                const itemRef = ref(db, "leituras/"+ id); // Identifica o item no banco
                remove(itemRef); // Remove o item do banco
            }
        }
    })
    });
}

if(formEditar){
    const parametros = new URLSearchParams(window.location.search); // Semelhante ao metodo GET, captura os parametros da URL da pagina atual
    const id = parametros.get("id") // Captura o id do item
    const itemRef = ref(db, "leituras/" + id);
    
    get(itemRef).then((snapshot) => {// Captura o objeto com o id especificado
        if(snapshot.exists()){
            const dados = snapshot.val();
            document.getElementById("ph").value = dados.ph;
            document.getElementById("temperatura").value = dados.temperatura;
            document.getElementById("turbidez").value = dados.turbidez
        }
    });
}

let t = 60;
function gravarLeitura(){
    const agora = new Date();
    const painel = document.getElementById('painel').innerHTML = "Nova leitura em:" + t-- + "s";

    if(t <= 0){
        const novaLeitura = {
            ph: Number((Math.random()*(8.5 - 6.5) + 6.5).toFixed(1)),
            temperatura: Number((Math.random()*(28 - 22) + 22).toFixed(1)),
            turbidez: Number((Math.random()*(15 - 5) + 5).toFixed(1)),
            data: agora.toLocaleDateString("pt-BR"),
            hora: agora.toLocaleTimeString("pt-BR")
        }

        push(leituraRef, novaLeitura); // Grava no objeto Ref
        t = 60;
    }
}

setInterval(gravarLeitura, 1000) // 
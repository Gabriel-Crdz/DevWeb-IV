import { db, ref, push, onValue, remove } from './firebase.js';
const leituraRef=ref(db,"leituras");
const cardPh= document.getElementById("card-ph");
const cardTemp=document.getElementById("card-temp");
const cardTurb=document.getElementById("card-turb");
const tabelaLeitura=document.getElementById("tabela-leituras");

const dataInicial = document.getElementById("data-inicial");
const dataFinal = document.getElementById("data-final");

function mostrarLeituras(dados) {
    tabelaLeitura.innerHTML = "";
    let ultimaLeitura = null;
    Object.keys(dados).forEach((id) => {
        const item = dados[id];
        ultimaLeitura = item;

        // Compara datas no formato já armazenado: dd/mm/aaaa.
        const partes = (item.data || "").split("/");
        const dataLeitura = partes[2] + "-" + partes[1] + "-" + partes[0];
        if (dataInicial.value && dataLeitura < dataInicial.value) return;
        if (dataFinal.value && dataLeitura > dataFinal.value) return;

        const tr = document.createElement("tr");
        tr.innerHTML = "<td>" + item.data + " às " + item.hora + "</td>" +
            "<td>" + item.temperatura + "ºC | Ph: " +
            item.ph + " | Turb :" +
            item.turbidez + "NTU</td>" +
            "<td><button class='btn-acao btn-alterar' data-id='" + id + "'>Alterar</button>" +
            "<button class='btn-acao btn-excluir' data-id='" + id + "'>Excluir</button></td>";
        tabelaLeitura.prepend(tr);
    });
    if (ultimaLeitura) {
        cardPh.innerHTML = ultimaLeitura.ph;
        cardTemp.innerHTML = ultimaLeitura.temperatura + " ºC";
        cardTurb.innerHTML = ultimaLeitura.turbidez + " NTU";
    } else {
        cardPh.textContent = "--";
        cardTemp.textContent = "-- °C";
        cardTurb.textContent = "-- NTU";
    }
}

onValue(leituraRef, (snapshot) => {
    const dados = snapshot.val() || {};

    mostrarLeituras(dados);

    document.getElementById("btn-buscar").onclick = () => {
        if (dataInicial.value && dataFinal.value &&
            dataInicial.value > dataFinal.value) {
            alert("A data inicial não pode ser posterior à data final.");
            return;
        }

        mostrarLeituras(dados);
    };

    document.getElementById("btn-limpar").onclick = () => {
        dataInicial.value = "";
        dataFinal.value = "";
        mostrarLeituras(dados);
    };
});

tabelaLeitura.addEventListener("click", (evento) => {
    const id = evento.target.getAttribute("data-id");
    if (evento.target.classList.contains("btn-excluir")) {
        if (confirm("Tem certeza que quer excluir?")) {
            const itemRef = ref(db, "leituras/" + id);
            remove(itemRef);
        }
    }
    if (evento.target.classList.contains("btn-alterar")) {
        window.location.href = "editar.php?id=" + id;
    }
});

let t = 60;
function gravarLeitura(){
    const agora = new Date();
    document.getElementById('painel').innerHTML="Nova leitura em "+t--+"s";
    if(t<=0){
        const novaLeitura={
            ph: Number((Math.random()*(8.5 - 6.5)+6.5).toFixed(1)),
            temperatura:Number((Math.random()*(28 - 22)+22).toFixed(1)),
            turbidez:Number((Math.random()*(15 - 5)+5).toFixed(1)),
            data: agora.toLocaleDateString("pt-BR"),
            hora: agora.toLocaleTimeString("pt-BR")
        };
        push(leituraRef,novaLeitura);
        t=60;
    }
}
setInterval(gravarLeitura,1000);


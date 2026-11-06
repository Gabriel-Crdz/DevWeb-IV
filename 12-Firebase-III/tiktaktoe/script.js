// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyDBOnEzro5KaHkWIDPXbTNCNdgn8QFCQHg",
  authDomain: "jogo-da-velha-fbb22.firebaseapp.com",
  databaseURL: "https://jogo-da-velha-fbb22-default-rtdb.firebaseio.com",
  projectId: "jogo-da-velha-fbb22",
  storageBucket: "jogo-da-velha-fbb22.firebasestorage.app",
  messagingSenderId: "70499751886",
  appId: "1:70499751886:web:b74008cc9e1e512e7d7d9f"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

const database = firebase.database();
const celulas = document.querySelectorAll('.celula');
const displayJogadorAtual = document.getElementById('jogador-atual');
const displayPlacarX = document.getElementById('placar-x');
const displayPlacarO = document.getElementById('placar-o');
const botaoReiniciar = document.getElementById('botao-reiniciar');
const salaRef = document.getElementById('salas/sala_01');
let meuSimbolo = "X";

function atualizarInterface(dados){
    celulas.forEach((celula) =>{
        const indice = celula.getAttribute('data-indice');
        celula.textContent = dados.tabuleiro[indice] || "";

    });
    displayJogadorAtual.textContent = dados.turno;
    displayPlacarX.textContent = dados.placar.x;
    displayPlacarO.textContent = dados.placar.o;
}

salaRef.on('value', (snapshot) =>{
    const dados = snapshot.val();
    if(dados){
        atualizarInterface(dados);
    }
});

function realizarJogada(indice){
    salaRef.once('value').then((snapshot) =>{
        const dados = snapshot.val();
        if(dados.tabuleiro[indice] !== "") return;

        dados.tabuleiro[indice] = dados.turno;
        const vencedor = verificarVencedor(dados.tabuleiro);
        
        if(vencedor){
            const novoPlacar = {...dados.placar};
            novoPlacar[vencedor]++;

            alert("O jogador ${vencedor} venceu!");
            reiniciarJogo();
        }
        else {
             const proximoTurno = dados.turno === "X" ? "O" : "X";

             salaRef.update({
                tabuleiro: dados.tabuleiro,
                turno: proximoTurno
             });
        }
    });
}

function reiniciarJogo(){
    salaRef.update({
        tabuleiro: ["", "", "", "", "", "", "", "", ""],
        turno: "X"
    });
}
botaoReiniciar.addEventListener("click", reiniciarJogo);
celulas.forEach((celula) =>{
    celula.addEventListener("click", ()=>{
        const indice = celula.getAttribute('data-indice');
        realizarJogada(indice);
    });
});

const combinacoes = [
    [0, 1, 2], [3, 4, 5], [6,7,8],
    [0,3,6], [1,4,7], [2,5,8],
    [0,4,8], [2, 4, 6]
];

function verificarVencedor(tabuleiro){
    for(let combinacao of combinacoes){
        const [a, b, c] = combinacao;
        if(tabuleiro[a] && tabuleiro[a] === tabuleiro[b] && tabuleiro[a] === tabuleiro[c]){
            return tabuleiro[a];
        }

    }
    return null;
}
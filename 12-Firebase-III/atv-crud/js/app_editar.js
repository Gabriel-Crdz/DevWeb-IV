import { db, ref, get, update } from './firebase.js';
    const parametros = new URLSearchParams(window.location.search);
    const id = parametros.get("id");
    const itemRef = ref(db, "leituras/" + id);
    get(itemRef).then((snapshot) => {
        if (snapshot.exists()) {
            const dados = snapshot.val();
            document.getElementById("ph").value = dados.ph;
            document.getElementById("temperatura").value = dados.temperatura;
            document.getElementById("turbidez").value = dados.turbidez;
        }
    });

document.getElementById("form-editar").addEventListener("submit", (evento) => {
    evento.preventDefault();
    update(itemRef, {
        ph: Number(document.getElementById("ph").value),
        temperatura: Number(document.getElementById("temperatura").value),
        turbidez: Number(document.getElementById("turbidez").value)
    }).then(() => {
        window.location.href = "index.php";
    }).catch((erro) => {
        alert("Erro ao salvar alterações: " + erro.message);
    });
});

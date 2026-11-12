// firebase.js
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
import { getDatabase, ref, push, onValue, remove, update, get } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

const firebaseConfig = {
    apiKey: "AIzaSyBwQlFhAteeCRV5hApLltuXibHlSXZ02y8",
    authDomain: "aquario-ee43e.firebaseapp.com",
    databaseURL: "https://aquario-ee43e-default-rtdb.firebaseio.com",
    projectId: "aquario-ee43e",
    storageBucket: "aquario-ee43e.firebasestorage.app",
    messagingSenderId: "90042235344",
    appId: "1:90042235344:web:b6341213ffecd5b29be1d5"
};

const app = initializeApp(firebaseConfig);
export const db = getDatabase(app);
export { ref, push, onValue, remove, update, get };
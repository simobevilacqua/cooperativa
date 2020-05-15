// carico da localStorage l'elenco degli utenti
var utentiJSON 	= localStorage.getItem("localUtentiJSON");
var utentiObj 	= JSON.parse(utentiJSON);


/*var utentiObj.utenti = [
    {
        idUtente : "am-Luongo",
        nomeCognome : "Leonardo Luongo",
        email : "leonardo.luongo@gmail.com",
        tipoUtente : "amministratore"
    },
    {
        idUtente : "ut-Luongo",
        nomeCognome : "Leonardo Luongo",
        email : "leonardo.luongo@gmail.com",
        tipoUtente : "utente"
    },
    {
        idUtente : "am-Pisetta",
        nomeCognome : "Paolo Pisetta",
        email : "paolo.pisetta@gmail.com",
        tipoUtente : "amministratore"
    },
    {
        idUtente : "ut-Pisetta",
        nomeCognome : "Paolo Pisetta",
        email : "paolo.pisetta@gmail.com",
        tipoUtente : "utente"
    }
];*/

sortDir = true;//true:crescente, false:decrescente

function sort(field) {
    if(sortDir) {
        for(var i=0; i<utentiObj.utenti.length-1; i++) {
            for(var j=i; j<utentiObj.utenti.length; j++) {
                if(utentiObj.utenti[i][field] > utentiObj.utenti[j][field]) {
                    tmp = utentiObj.utenti[i];
                    utentiObj.utenti[i] = utentiObj.utenti[j];
                    utentiObj.utenti[j] = tmp;
                }
            }
        }
        sortDir = !sortDir;
    } else {
        for(var i=0; i<utentiObj.utenti.length-1; i++) {
            for(var j=i; j<utentiObj.utenti.length; j++) {
                if(utentiObj.utenti[i][field] < utentiObj.utenti[j][field]) {
                    tmp = utentiObj.utenti[i];
                    utentiObj.utenti[i] = utentiObj.utenti[j];
                    utentiObj.utenti[j] = tmp;
                }
            }
        }
        sortDir = !sortDir;
    }
    load();
}

function eliminautente(i){
	utentiObj.utenti.splice(i, 1);
	load();
	utentiJSON = JSON.stringify(utentiObj);
	localStorage.setItem("localUtentiJSON", utentiJSON);
}

function modificautente(i){
	localStorage.setItem("indiceUtente", i);
}
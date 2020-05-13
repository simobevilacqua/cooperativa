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

function load() {
    $("#alt").empty();
    $("#res").remove();
    
    //carica l'intestazione della tabella
    $("#alt").append("<thead><tr><th><a id='username' onclick='sort(this.id)'>ID utente</a></th><th><a id='nome' onclick='sort(this.id)'>Nome Cognome</a></th><th><a id='email' onclick='sort(this.id)'>Email</a></th><th><a id='permesso' onclick='sort(this.id)'>Tipo utente</a></th><th><a id='modifica'>Modifica</a></th><th><a id='elimina'>Elimina</a></th></tr></thead>");

    //var sql = "SELECT * FROM " + table_name;
    for(var i=0; i<utentiObj.utenti.length; i++) {
        $("#alt").append("<tbody><tr><td>"+utentiObj.utenti[i].username
			+"</td><td>"+utentiObj.utenti[i].nome
			+"</td><td>"+utentiObj.utenti[i].email
			+"</td><td>"+utentiObj.utenti[i].permesso
			+"</td><td><a href='gestione-utente-modifica.html' class='button special fit' onclick='modificautente("+i+")'>Modifica</a></td>"
			+"<td><a href='#' class='button special fit' onclick='eliminautente("+i+")'>Elimina</a></td></tr></tbody>");
    }
}

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
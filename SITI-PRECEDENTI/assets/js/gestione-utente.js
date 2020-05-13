var proc = [
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
];

function load() {
    $("#alt").empty();
    $("#res").remove();
    
    //carica l'intestazione della tabella
    $("#alt").append("<thead><tr><th><a id='idUtente' onclick='sort(this.id)'>ID utente</a></th><th><a id='nomeCognome' onclick='sort(this.id)'>Nome Cognome</a></th><th><a id='email' onclick='sort(this.id)'>Email</a></th><th><a id='tipoUtente' onclick='sort(this.id)'>Tipo utente</a></th><th><a id='modifica' onclick='sort(this.id)'>Modifica</a></th><th><a id='elimina' onclick='sort(this.id)'>Elimina</a></th></tr></thead>");

    //var sql = "SELECT * FROM " + table_name;
    for(var i=0; i<proc.length; i++) {
        $("#alt").append("<tbody><tr><td>"+proc[i].idUtente+"</td><td>"+proc[i].nomeCognome+"</td><td>"+proc[i].email+"</td><td>"+proc[i].tipoUtente+"</td><td><a href='gestione-utente-modifica.html' class='button special fit'>Modifica</a></td><td><a href='#' class='button special fit'>Elimina</a></td></tr></tbody>");
    }
}

sortDir = true;//true:crescente, false:decrescente

function sort(field) {
    if(sortDir) {
        for(var i=0; i<proc.length-1; i++) {
            for(var j=i; j<proc.length; j++) {
                if(proc[i][field] > proc[j][field]) {
                    tmp = proc[i];
                    proc[i] = proc[j];
                    proc[j] = tmp;
                }
            }
        }
        sortDir = !sortDir;
    } else {
        for(var i=0; i<proc.length-1; i++) {
            for(var j=i; j<proc.length; j++) {
                if(proc[i][field] < proc[j][field]) {
                    tmp = proc[i];
                    proc[i] = proc[j];
                    proc[j] = tmp;
                }
            }
        }
        sortDir = !sortDir;
    }
    load();
}
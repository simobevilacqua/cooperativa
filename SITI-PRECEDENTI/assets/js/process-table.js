var proc = [
    {
        idProg : "a001",
        desc : "backup utenti",
        codUtente : "ut-Luongo",
        descUtente : "Leonardo Luongo",
        tipoUtente : "utente",
        idProc : "11",
        tipoProc : "periodico",
        dataI : "2018-05-23",
        dataF : "2018-07-16",
        stato : "terminato"
    },
    {
        idProg : "a001",
        desc : "backup processi",
        codUtente : "am_Pisetta",
        descUtente : "Paolo Pisetta",
        tipoUtente : "amministratore",
        idProc : "400",
        tipoProc : "periodico",
        dataI : "2019-01-05",
        dataF : "----",
        stato : "attesa"
    },
    {
        idProg : "d087",
        desc : "restore utenti",
        codUtente : "ut-Pisetta",
        descUtente : "Paolo Pisetta",
        tipoUtente : "utente",
        idProc : "123",
        tipoProc : "richiesta",
        dataI : "2018-12-09",
        dataF : "----",
        stato : "esecuzione"
    },
    {
        idProg : "d140",
        desc : "calcolo stipendi",
        codUtente : "am-Luongo",
        descUtente : "Leonardo Luongo",
        tipoUtente : "amministratore",
        idProc : "628",
        tipoProc : "richiesta",
        dataI : "2019-02-24",
        dataF : "----",
        stato : "esecuzione"
    }
];

function search() {
    $("#alt").empty();
    $("#res").remove();
    //var table_name = "";
    var idProgVal = mod.idProg.value;
    var statoVal = mod.stato.value;
    var utenteVal = mod.utente.value;
    var tipoVal = mod.tipo.value;
    var dataAVal = mod.dataAvvio.value;
    var dataFVal = mod.dataFine.value;
    var print = false;
    
    //carica l'intestazione della tabella
    $("#alt").append("<thead><tr><th><a id='idProg' onclick='sort(this.id)'>ID progr</a></th><th><a id='desc' onclick='sort(this.id)'>Descrizione</a></th><th><a id='codUtente' onclick='sort(this.id)'>Codice utente</a></th><th><a id='descUtente' onclick='sort(this.id)'>Descrizione Utente</a></th><th><a id='tipoUtente' onclick='sort(this.id)'>Tipo Utente</a></th><th><a id='idProc' onclick='sort(this.id)'>ID processo</a></th><th><a id='tipoProc' onclick='sort(this.id)'>Tipo processo</a></th><th><a id='dataI' onclick='sort(this.id)'>Data inizio</a></th><th><a id='dataF' onclick='sort(this.id)'>Data fine</a></th><th><a id='stato' onclick='sort(this.id)'>Stato</a></th></tr></thead>");
    
    //controllo dati inseriti e ricerca
    if(idProgVal == "" && statoVal == "" && utenteVal == "" && tipoVal == "" && dataAVal == "" && dataFVal == "") {
        //var sql = "SELECT * FROM " + table_name;
        for(var i=0; i<proc.length; i++) {
            $("#alt").append("<tbody><tr><td>"+proc[i].idProg+"</td><td>"+proc[i].desc+"</td><td>"+proc[i].codUtente+"</td><td>"+proc[i].descUtente+"</td><td>"+proc[i].tipoUtente+"</td><td>"+proc[i].idProc+"</td><td>"+proc[i].tipoProc+"</td><td>"+proc[i].dataI+"</td><td>"+proc[i].dataF+"</td><td>"+proc[i].stato+"</td></td></tbody>");
        }
        print = true;
    } else {
        //var sql = "SELECT * FROM " + table_name + " WHERE idProg = " + idProgVal + " OR stato = " + statoVal + " OR utente = " + utenteVal + " OR tipo = " + tipoVal + " OR dataA = " + dataAVal + " OR dataF = " + dataFVal;
        for(var i=0; i<proc.length; i++) {
            if((idProgVal == "" || idProgVal == proc[i].idProg) && (statoVal == "" || statoVal == proc[i].stato) && (utenteVal == "" || utenteVal == proc[i].codUtente) && (tipoVal == "" || tipoVal == proc[i].tipoProc) && (dataAVal == "" || dataAVal == proc[i].dataI) && (dataFVal == "" || dataFVal == proc[i].dataF)) {
                print = true;
                $("#alt").append("<tbody><tr><td>"+proc[i].idProg+"</td><td>"+proc[i].desc+"</td><td>"+proc[i].codUtente+"</td><td>"+proc[i].descUtente+"</td><td>"+proc[i].tipoUtente+"</td><td>"+proc[i].idProc+"</td><td>"+proc[i].tipoProc+"</td><td>"+proc[i].dataI+"</td><td>"+proc[i].dataF+"</td><td>"+proc[i].stato+"</td></tr></tbody>");
            }
        }
    }
    if(!print) {
        $("#alt").empty();
        $("#mod").append("<p id='res'>Nessun processo trovato</p>");
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
    search();
}

search();
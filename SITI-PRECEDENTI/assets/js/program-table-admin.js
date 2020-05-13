var proc = [
    {
        id: "a001",
        nome: "Backup",
        descrizione: "Programma per eseguire il backup di tutti i file nel sistema",
        durataprevista: "3:00 h",
        tipo: "periodico"
    },
    {
        id: "d002",
        nome: "Accensione PC",
        descrizione: "Accende tutti i PC del piano",
        durataprevista: "0:30 h",
        tipo: "periodico"
    },
    {
        id: "h003",
        nome: "Cancella account",
        descrizione: "Cancella account",
        durataprevista: "1:30 h",
        tipo: "periodico"
    
    }
];

var codice = "<a href='program-table-modifica.html' class='button special fit'>Modifica</a>";



function search() {
    $("#alt").empty();
    $("#res").remove();
    //var table_name = "";
    var id = mod.id.value;
    var nome = mod.nome.value;
    var print = false;
    
    //carica l'intestazione della tabella
    $("#alt").append("<thead><tr><th><a id='id' onclick='sort(this.id)'>Id</a></th><th><a id='nome' onclick='sort(this.id)'>Nome</a></th><th><a id='descrizione' onclick='sort(this.id)'>Descrizione</a></th><th><a id='durataprevista' onclick='sort(this.id)'>Durata Prevista</a></th><th><a id='tipo' onclick='sort(this.id)'>Tipo</a></th></tr></thead>");
    //controllo dati inseriti e ricerca
    if(id == "" && nome == "" && descrizione == "" && durataprevista == "" && tipo == "") {
        //var sql = "SELECT * FROM " + table_name;
        for(var i=0; i<proc.length; i++) {
            $("#alt").append("<tbody><tr><td>"+proc[i].id+"</td><td>"+proc[i].nome+"</td><td>"+proc[i].descrizione+"</td><td>"+proc[i].durataprevista+"</td><td>"+proc[i].tipo+"</td><td>"+codice+"</td></tr></tbody>");
        }
        print = true;
    } else {
        //var sql = "SELECT * FROM " + table_name + " WHERE idProg = " + idProgVal + " OR stato = " + statoVal + " OR utente = " + utenteVal + " OR tipo = " + tipoVal + " OR dataA = " + dataAVal + " OR dataF = " + dataFVal;
        for(var i=0; i<proc.length; i++) {
            if((id == "" || id == proc[i].id) && (nome == "" || nome == proc[i].nome) && (descrizione == "" || descrizione == proc[i].descrizione) && (durataprevista == "" || durataprevista == proc[i].durataprevista) && (tipo == "" || tipo == proc[i].tipo)) {
                print = true;
                $("#alt").append("<tbody><tr><td>"+proc[i].id+"</td><td>"+proc[i].nome+"</td><td>"+proc[i].descrizione+"</td><td>"+proc[i].durataprevista+"</td><td>"+proc[i].tipo+"</td><td>"+codice+"</td></tr></tbody>");
            }
        }
    }
    if(!print) {
        $("#alt").empty();
        $("#mod").append("<p id='res'>Nessun programma trovato</p>");
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
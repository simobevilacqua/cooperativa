// carico da localStorage l'elenco dei programmi
var programmiJSON 	= localStorage.getItem("localProgrammiJSON");
var programmiObj 	= JSON.parse(programmiJSON);

//function impostaID(id)
//{
//	localStorage.setItem("idProgramma", id);
//}

function search() {
    $("#alt").empty();
    $("#res").remove();
    //var table_name = "";
    var id = mod.id.value;
    
    var print = false;
    
    //carica l'intestazione della tabella
    $("#alt").append("<thead><tr><th><a id='id' onclick='sort(this.id)'>Id</a></th><th><a id='descrizione' onclick='sort(this.id)'>Descrizione</a></th><th><a id='durataprevista' onclick='sort(this.id)'>Durata Prevista</a></th><th><a id='tipo' onclick='sort(this.id)'>Tipo</a></th><th></th></tr></thead>");
    //controllo dati inseriti e ricerca
    if(id == "" && descrizione == "" && durataprevista == "" && tipo == "") {
       
        for(var i=0; i<programmiObj.programmi.length; i++) {
            $("#alt").append("<tbody><tr><td>"+programmiObj.programmi[i].id+
			"</td><td>"+programmiObj.programmi[i].descrizione+
			"</td><td>"+programmiObj.programmi[i].durataprevista+
			"</td><td>"+programmiObj.programmi[i].tipo+
			"</td><td><a href='#' class='button special fit' onclick='modificaprogramma("+i+")'>Modifica</a>"+
			"</td><td><a href='#' class='button special fit' onclick='eliminaprogramma("+i+")'>Elimina</a></td></tr></tbody>");
        }
        print = true;
    } else {
        
        for(var i=0; i<programmiObj.programmi.length; i++) {
            if((id == "" || id == programmiObj.programmi[i].id) && (descrizione == "" || descrizione == programmiObj.programmi[i].descrizione) && (durataprevista == "" || durataprevista == programmiObj.programmi[i].durataprevista) && (tipo == "" || tipo == programmiObj.programmi[i].tipo)) {
                print = true;
                $("#alt").append("<tbody><tr><td>"+programmiObj.programmi[i].id
				+"</td><td>"+programmiObj.programmi[i].descrizione
				+"</td><td>"+programmiObj.programmi[i].durataprevista
				+"</td><td>"+programmiObj.programmi[i].tipo
				+"</td><td><a href='program-table-modifica.php' class='button special fit' onclick='modificaprogramma("+i+")'>Modifica</a>"
				+"</td><td><a href='#' class='button special fit' onclick='eliminaprogramma("+i+")'>Elimina</a></td></tr></tbody>");
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
        for(var i=0; i<programmiObj.programmi.length-1; i++) {
            for(var j=i; j<programmiObj.programmi.length; j++) {
                if(programmiObj.programmi[i][field] > programmiObj.programmi[j][field]) {
                    tmp = programmiObj.programmi[i];
                    programmiObj.programmi[i] = programmiObj.programmi[j];
                    programmiObj.programmi[j] = tmp;
                }
            }
        }
        sortDir = !sortDir;
    } else {
        for(var i=0; i<programmiObj.programmi.length-1; i++) {
            for(var j=i; j<programmiObj.programmi.length; j++) {
                if(programmiObj.programmi[i][field] < programmiObj.programmi[j][field]) {
                    tmp = programmiObj.programmi[i];
                    programmiObj.programmi[i] = programmiObj.programmi[j];
                    programmiObj.programmi[j] = tmp;
                }
            }
        }
        sortDir = !sortDir;
    }
    search();
}

function modificaprogramma(i){
	localStorage.setItem("Indiceprogramma", i);
	window.location.assign("program-table-modifica.php");
}

function eliminaprogramma(i){
	programmiObj.programmi.splice(i, 1);
	search();
	programmiJSON = JSON.stringify(programmiObj);
	localStorage.setItem("localProgrammiJSON", programmiJSON);
}
search();
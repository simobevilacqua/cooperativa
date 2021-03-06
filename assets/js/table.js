//Variabili globali
var nPeriodicita = 0;
var posizioneProgramma = 0;
var posizioneAutorizzato = 0;
var posizioneNotificato = 0;

// carico da localStorage l'elenco dei programmi
var programmiJSON = localStorage.getItem("localProgrammiJSON");
var programmiObj = JSON.parse(programmiJSON);

//Metto a null tutti gli utenti autorizzati e quelli possono ricevere le notifiche
for(i = 0; i < programmiObj.programmi[posizioneProgramma].autorizzati.length; i++){
    programmiObj.programmi[posizioneProgramma].autorizzati[i] = {};
}
for(i = 0; i < programmiObj.programmi[posizioneProgramma].notifiche.length; i++){
    programmiObj.programmi[posizioneProgramma].notifiche[i] = {};
}

//Variabili che mi servono per sapere quali sono gli utenti presenti nel database
var json = "";
var objUtenti = "";

function utenti_disponibili(stringa){
    var vett = stringa.split(",");
    var json = "[";
    i = 0;
    while(i < vett.length){
        json += "{\"id\":" + "\"" + vett[i] + "\",";
        i++;
        json += "\"nome\":" + "\"" + vett[i] + "\",";
        i++;
        if((i) == (vett.length-1)){
            json += "\"tipo\":" + "\"" + vett[i] + "\"}";
        }else{
            json += "\"tipo\":" + "\"" + vett[i] + "\"},";
        }
        i++;
    }
    json += "]";
    //alert(json);
    objUtenti = JSON.parse(json);
}

function aggiorna_prerequisito() {

    var i = document.getElementById("configurazione_idprerequisito").selectedIndex - 1;
    document.getElementById("configurazione_prerequisito").value = programmiObj.programmi[i].descrizione;

}

function aggiorna_data() {
    var giorno = document.getElementById("configurazione_giorni").value;
    var ora = document.getElementById("id_ora_data").value;

    if (giorno == "") {
        alert("Inserisci un giorno.");
    } else {
        if (ora == "") {
            alert("Inserisci un orario.");
        } else {
            var trovato = ricercaGiornoOra(programmiObj.programmi[posizioneProgramma].periodicita, giorno, ora);
            if (trovato) {
                alert("Calendarizzazione già inserita.");
            } else {
                programmiObj.programmi[posizioneProgramma].periodicita[nPeriodicita] = {};
                programmiObj.programmi[posizioneProgramma].periodicita[nPeriodicita].giorno = giorno;
                programmiObj.programmi[posizioneProgramma].periodicita[nPeriodicita].ora = ora;
                var text = "<tr><td>" + giorno + "</td><td>" + ora + "</td>" +
                    "<td><a href='#' class='button special fit' onclick='eliminaGiorno(" + nPeriodicita + ");'>Elimina</a></td></tr>";
                nPeriodicita++;
                document.getElementById("id_elenco_data").innerHTML += text;
            }
        }
    }
}

function ricercaGiornoOra(periodicita, giorno, ora) {
    var i = 0
    var trovato = false;
    while (i < periodicita.length && !trovato) {
        if (periodicita[i].giorno == giorno && periodicita[i].ora == ora) {
            trovato = true;
        } else {
            i++;
        }
    }
    return trovato;
}

function RicercaUtente(utenti, id) {
    var trovato = false;
    var i = 0;
    while (i < utenti.length && !trovato) {
        if (utenti[i].id == id) {
            trovato = true;
        } else {
            i++;
        }
    }
    if (!trovato) {
        i = -1;
    }
    return i;
}

function aggiorna_autorizzazioneAvvio() {
    var scelta = document.getElementById("configurazione_idutente").selectedIndex - 1;
    var id = objUtenti[scelta].id;
    var tipo = objUtenti[scelta].tipo;
    var nome = objUtenti[scelta].nome;

    // cerco se l'utente selezionato è già stato inserito nell'elenco
    var i = RicercaUtente(programmiObj.programmi[posizioneProgramma].autorizzati, id);
    if (i != -1) {
        alert("Utente già inserito.");
    } else {
        var i = posizioneAutorizzato;
        text = "<tr><td>" + id + "</td><td>" + nome + "</td><td>" + tipo + "</td>" +
            "<td><a href='#' class='button special fit' onclick='eliminaUtentiAvvio(" + i + ");'>Elimina</a></td></tr>";
        document.getElementById("elenco_utentiAvvio").innerHTML += text;
        programmiObj.programmi[posizioneProgramma].autorizzati[posizioneAutorizzato].id = id;
        posizioneAutorizzato++;
    }
}

function aggiorna_autorizzazioneNotifiche() {
    var scelta = document.getElementById("configurazione_idutente1").selectedIndex - 1;
    var id = objUtenti[scelta].id;
    var tipo = objUtenti[scelta].tipo;
    var nome = objUtenti[scelta].nome;

    // cerco se l'utente selezionato è già stato inserito nell'elenco
    var i = RicercaUtente(programmiObj.programmi[posizioneProgramma].notifiche, id);
    if (i != -1) {
        alert("Utente già inserito.");
    } else {
        var i = posizioneNotificato;
        text = "<tr><td>" + id + "</td><td>" + nome + "</td><td>" + tipo + "</td>" +
            "<td><a href='#' class='button special fit' onclick='eliminaUtentiNotifiche(" + i + ");'>Elimina</a></td></tr>";
        document.getElementById("elenco_utentiNotifiche").innerHTML += text;
        programmiObj.programmi[posizioneProgramma].notifiche[posizioneNotificato].id = id;
        posizioneNotificato++;
    }
}

function eliminaGiorno(i) {
    programmiObj.programmi[posizioneProgramma].periodicita.splice(i, 1);
    var periodicita = programmiObj.programmi[posizioneProgramma].periodicita;
    nPeriodicita--;
    var text = "";
    for (i = 0; i < nPeriodicita; i++) {
        var giorno = periodicita[i].giorno;
        var ora = periodicita[i].ora;
        text += "<tr><td>" + giorno + "</td><td>" + ora + "</td>" +
            "<td><a href='#' class='button special fit' onclick='eliminaGiorno(" + i + ");'>Elimina</a></td></tr>";
    }
    document.getElementById("id_elenco_data").innerHTML = text;
}

function eliminaUtentiAvvio(i) {
    programmiObj.programmi[posizioneProgramma].autorizzati.splice(i, 1);
    var autorizzati = programmiObj.programmi[posizioneProgramma].autorizzati;
    var text = "";
    for (i = 0; i < autorizzati.length; i++) {
        var id = autorizzati[i].id;
        var j = RicercaUtente(objUtenti, id);
        if(j != -1){
            var nome = objUtenti[j].nome;
            var tipo = objUtenti[j].tipo;
            text += "<tr><td>" + id + "</td><td>" + nome + "</td><td>" + tipo + "</td>" +
                "<td><a href='#' class='button special fit' onclick='eliminaUtentiAvvio(" + i + ");'>Elimina</a></td></tr>";
        }
    }
    document.getElementById("elenco_utentiAvvio").innerHTML = text;
    posizioneAutorizzato--;
}

function eliminaUtentiNotifiche(i) {
    programmiObj.programmi[posizioneProgramma].notifiche.splice(i, 1);
    var notifiche = programmiObj.programmi[posizioneProgramma].notifiche;
    var text = "";
    for (i = 0; i < notifiche.length; i++) {
        var id = notifiche[i].id;
        var j = RicercaUtente(objUtenti, id);
        if(j != -1){
            var nome = objUtenti[j].nome;
            var tipo = objUtenti[j].tipo;
            text += "<tr><td>" + id + "</td><td>" + nome + "</td><td>" + tipo + "</td>" +
                "<td><a href='#' class='button special fit' onclick='eliminaUtentiNotifiche(" + i + ");'>Elimina</a></td></tr>";
        }
    }
    document.getElementById("elenco_utentiNotifiche").innerHTML = text;
    posizioneNotificato--;
}

function prendi_dati(){
    prendi_giorni();
    prendi_autorizzati();
    prendi_notificati();
}


//Funzione per prendere i giorni della calendarizzazione
function prendi_giorni(){
    var stringa = "";
    for(i = 0; i < nPeriodicita; i++){
        if(i == (nPeriodicita-1)){
            stringa += programmiObj.programmi[posizioneProgramma].periodicita[i].giorno + "," + programmiObj.programmi[posizioneProgramma].periodicita[i].ora;
        }else{
            stringa += programmiObj.programmi[posizioneProgramma].periodicita[i].giorno + "," + programmiObj.programmi[posizioneProgramma].periodicita[i].ora + ",";
        }   
    }
    var vett = new Array(stringa);
    modulo.calendario.value = vett;
}

//Funzione per predere gli utenti che sono autorizzati ad avviare un programma
function prendi_autorizzati(){
    var stringa = "";
    for(i = 0; i < posizioneAutorizzato; i++){
        if(i == (posizioneAutorizzato-1)){
            stringa += programmiObj.programmi[posizioneProgramma].autorizzati[i].id;
        }else{
            stringa += programmiObj.programmi[posizioneProgramma].autorizzati[i].id + ",";
        }   
    }
    var vett = new Array(stringa);
    modulo.autorizzati.value = vett;
}

//Funzione per predere gli utenti che ricevono le notifiche del programma
function prendi_notificati(){
    var stringa = "";
    for(i = 0; i < posizioneNotificato; i++){
        if(i == (posizioneNotificato-1)){
            stringa += programmiObj.programmi[posizioneProgramma].notifiche[i].id;
        }else{
            stringa += programmiObj.programmi[posizioneProgramma].notifiche[i].id + ",";
        }   
    }
    var vett = new Array(stringa);
    modulo.notificati.value = vett;
}
/*
function salvaProgramma() {
    var conferma = confirm("Vuoi salvare le impostazioni?");

    if (conferma) {
        programmiObj.programmi[posizioneProgramma].id = document.getElementById("id_programma").value;
        programmiObj.programmi[posizioneProgramma].descrizione = document.getElementById("descrizioneprogramma").value;
        programmiObj.programmi[posizioneProgramma].durataprevista = document.getElementById("durata").value;
        programmiObj.programmi[posizioneProgramma].prerequisito = document.getElementById("selezionePrerequisito").value;
        programmiObj.programmi[posizioneProgramma].tipo = document.getElementById("configurazione_tipoprogramma").value;
        programmiJSON = JSON.stringify(programmiObj);
        localStorage.setItem("localProgrammiJSON", programmiJSON);
        window.location.assign("program-table.html");
    }
}*/
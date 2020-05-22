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

function RicercaUtente(utenti, username) {
    var trovato = false;
    var i = 0;
    while (i < utenti.length && !trovato) {
        if (utenti[i].username == username) {
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
    var username = utentiObj.utenti[scelta].username;
    var tipo = utentiObj.utenti[scelta].permesso;
    var nome = utentiObj.utenti[scelta].nome;

    // cerco se l'utente selezionato è già stato inserito nell'elenco
    var i = RicercaUtente(programmiObj.programmi[posizioneProgramma].autorizzati, username);
    if (i != -1) {
        alert("Utente già inserito.");
    } else {
        var i = programmiObj.programmi[posizioneProgramma].autorizzati.length;
        text = "<tr><td>" + username + "</td><td>" + nome + "</td><td>" + tipo + "</td>" +
            "<td><a href='#' class='button special fit' onclick='eliminaUtentiAvvio(" + i + ");'>Elimina</a></td></tr>";
        document.getElementById("elenco_utentiAvvio").innerHTML += text;
        programmiObj.programmi[posizioneProgramma].autorizzati.push(username);
    }
}

function aggiorna_autorizzazioneNotifiche() {
    var scelta = document.getElementById("configurazione_idutente1").selectedIndex - 1;
    var username = utentiObj.utenti[scelta].username;
    var tipo = utentiObj.utenti[scelta].permesso;
    var nome = utentiObj.utenti[scelta].nome;

    // cerco se l'utente selezionato è già stato inserito nell'elenco
    var i = RicercaUtente(programmiObj.programmi[posizioneProgramma].notifiche, username);
    if (i != -1) {
        alert("Utente già inserito.");
    } else {
        var i = programmiObj.programmi[posizioneProgramma].notifiche.length;
        text = "<tr><td>" + username + "</td><td>" + nome + "</td><td>" + tipo + "</td>" +
            "<td><a href='#' class='button special fit' onclick='eliminaUtentiNotifiche(" + i + ");'>Elimina</a></td></tr>";
        document.getElementById("elenco_utentiNotifiche").innerHTML += text;
        programmiObj.programmi[posizioneProgramma].notifiche.push(username);
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
        var username = autorizzati[i];
        var j = RicercaUtente(utentiObj.utenti, username);
        var nome = utentiObj.utenti[j].nome;
        var tipo = utentiObj.utenti[j].pass;
        text += "<tr><td>" + username + "</td><td>" + nome + "</td><td>" + tipo + "</td>" +
            "<td><a href='#' class='button special fit' onclick='eliminaUtentiAvvio(" + i + ");'>Elimina</a></td></tr>";
    }
    document.getElementById("elenco_utentiAvvio").innerHTML = text;
}

function eliminaUtentiNotifiche(i) {
    programmiObj.programmi[posizioneProgramma].notifiche.splice(i, 1);
    var notifiche = programmiObj.programmi[posizioneProgramma].notifiche;
    var text = "";
    for (i = 0; i < notifiche.length; i++) {
        var username = notifiche[i];
        var j = RicercaUtente(utentiObj.utenti, username);
        var nome = utentiObj.utenti[j].nome;
        var tipo = utentiObj.utenti[j].pass;
        text += "<tr><td>" + username + "</td><td>" + nome + "</td><td>" + tipo + "</td>" +
            "<td><a href='#' class='button special fit' onclick='eliminaUtentiNotifiche(" + i + ");'>Elimina</a></td></tr>";
    }
    document.getElementById("elenco_utentiNotifiche").innerHTML = text;
}

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
}
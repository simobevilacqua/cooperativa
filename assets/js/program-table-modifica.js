//VARIABILI GLOBALI

var nPeriodicita=0;
var posizioneProgramma=0;

// carico da localStorage l'elenco degli utenti
var utentiJSON 		= localStorage.getItem("localUtentiJSON");
var utentiObj 		= JSON.parse(utentiJSON);

// carico da localStorage l'elenco dei programmi
var programmiJSON 	= localStorage.getItem("localProgrammiJSON");
var programmiObj 	= JSON.parse(programmiJSON);

//FUNZIONI

function ImpostazioniInizialiModifica(){

	posizioneProgramma=localStorage.getItem("Indiceprogramma");
	
// impostazione id programma	
	var id = programmiObj.programmi[posizioneProgramma].id;
	document.getElementById("id_programma").value = id;
	
// impostazione descrizione programma
	var descrizione = programmiObj.programmi[posizioneProgramma].descrizione;
	document.getElementById("descrizioneprogramma").value = descrizione;
	
// impostazione durata programma
	var durataprevista = programmiObj.programmi[posizioneProgramma].durataprevista;
	document.getElementById("durata").value = durataprevista;
	
//impostazione selezione prequisito
	var idPrerequisito = programmiObj.programmi[posizioneProgramma].prerequisito;
	if (idPrerequisito == null)
	{
		idPrerequisito = "---";
	}
	var text = "<select id='configurazione_idprerequisito' onChange='aggiorna_prerequisito()'>"+
			   "<option selected>" + idPrerequisito +"</option>";
	for(i=0; i<programmiObj.programmi.length; i++)
	{
		text= text+ "<option value='" + programmiObj.programmi[i].id + "'>" + programmiObj.programmi[i].id + "</option>";
	}
	text= text+"</select>";
	document.getElementById("selezionePrerequisito").innerHTML = text;
	
// impostazione descrizione prequisito
	var indPrerequisito = ricercaProgramma(programmiObj.programmi, idPrerequisito);
	
	if (indPrerequisito!=-1)
	{
		document.getElementById("configurazione_prerequisito").value= programmiObj.programmi[indPrerequisito].descrizione;
	}
	else
	{		
		document.getElementById("configurazione_prerequisito").value=" ";
	}
// Impostazione giorni e ore impostati precedentemente
	
	var text="";
	var periodicita = programmiObj.programmi[posizioneProgramma].periodicita;
	nPeriodicita=periodicita.length;
	for(i=0; i< nPeriodicita; i++)
	{
		var giorno = periodicita[i].giorno;
		var ora = periodicita[i].ora;
		text += "<tr><td>"+giorno+"</td><td>"+ora+"</td>"+
			    "<td><a href='#' class='button special fit' onclick='eliminaGiorno("+i+");'>Elimina</a></td></tr>";		
	}
	document.getElementById("id_elenco_data").innerHTML = text;
	
// Impostazioni opzioni per la scelta degli utenti autorizzati a lanciare il programma
	text = "<select id='configurazione_idutente'><option selected>---</option>";
	for(i=0; i<utentiObj.utenti.length; i++)
	{
		text= text+ "<option value='" + utentiObj.utenti[i].username + "'>" + utentiObj.utenti[i].username + "</option>";
	}
	text= text+"</select>";
	document.getElementById("seleziona_utente1").innerHTML = text;

// Impostazione utenti autorizzati precedentemente
	var autorizzati = programmiObj.programmi[posizioneProgramma].autorizzati;
	var text="";
	for(i=0; i< autorizzati.length; i++)
	{
		var username = autorizzati[i];
		var j=RicercaUtente(utentiObj.utenti, username);
		var nome = utentiObj.utenti[j].nome;
		var tipo = utentiObj.utenti[j].pass;
		text += "<tr><td>"+username+"</td><td>"+nome+"</td><td>"+tipo+"</td>"+
				"<td><a href='#' class='button special fit' onclick='eliminaUtentiAvvio("+i+");'>Elimina</a></td></tr>";
	}
	document.getElementById("elenco_utentiAvvio").innerHTML = text;
	
// Impostazioni opzioni per la scelta degli utenti che riceveranno notifiche
	text = "<select id='configurazione_idutente1'><option selected>---</option>";
	for(i=0; i<utentiObj.utenti.length; i++)
	{
		text= text+ "<option value='" + utentiObj.utenti[i].username + "'>" + utentiObj.utenti[i].username + "</option>";
	}
	text= text+"</select>";
	document.getElementById("seleziona_utente2").innerHTML = text;

// Impostazione utenti notifiche precedenti
	var notifiche = programmiObj.programmi[posizioneProgramma].notifiche;
	var text="";
	for(i=0; i< notifiche.length; i++)
	{
		var username = notifiche[i];
		var j=RicercaUtente(utentiObj.utenti, username);
		var nome = utentiObj.utenti[j].nome;
		var tipo = utentiObj.utenti[j].pass;
		text += "<tr><td>"+username+"</td><td>"+nome+"</td><td>"+tipo+"</td>"+
				"<td><a href='#' class='button special fit' onclick='eliminaUtentiNotifiche("+i+");'>Elimina</a></td></tr>";
	}
	document.getElementById("elenco_utentiNotifiche").innerHTML = text;
}

function ricercaProgramma(programmi, id)
{
	var i=0
	var trovato = false;
	while(i<programmi.length && !trovato)
	{
		if(programmi[i].id == id)
		{
			trovato=true;
		}
		else
		{
			i++;
		}
	}
	if(!trovato)
	{
		i=-1;
	}
	return i;
}

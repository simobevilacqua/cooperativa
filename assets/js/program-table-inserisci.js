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

function ImpostazioniIniziali(){
	// Verranno impostati i menu a tendina con i dati ricavati dal localStorage
	
	// Impostazioni opzioni per la scelta del programma prerequisito
	var text = "<select id='configurazione_idprerequisito' onChange='aggiorna_prerequisito()'><option selected>---</option>";
	for(i=0; i<programmiObj.programmi.length; i++)
	{
		text= text+ "<option value='" + programmiObj.programmi[i].id + "'>" + programmiObj.programmi[i].id + "</option>";
	}
	text= text+"</select>";
	document.getElementById("selezionePrerequisito").innerHTML = text;
	
	// Impostazioni opzioni per la scelta degli utenti autorizzati a lanciare il programma
	text = "<select id='configurazione_idutente'><option selected>---</option>";
	for(i=0; i<utentiObj.utenti.length; i++)
	{
		text= text+ "<option value='" + utentiObj.utenti[i].username + "'>" + utentiObj.utenti[i].username + "</option>";
	}
	text= text+"</select>";
	document.getElementById("seleziona_utente1").innerHTML = text;
	
	// Impostazioni opzioni per la scelta degli utenti che riceveranno notifiche
	text = "<select id='configurazione_idutente1'><option selected>---</option>";
	for(i=0; i<utentiObj.utenti.length; i++)
	{
		text= text+ "<option value='" + utentiObj.utenti[i].username + "'>" + utentiObj.utenti[i].username + "</option>";
	}
	text= text+"</select>";
	document.getElementById("seleziona_utente2").innerHTML = text;

// impostazioni iniziali programma selezionato
	var programma = {id:" ", descrizione:" ", prerequisito: " ", durataprevista:" ",  tipo: " ", autorizzati: [], notifiche: [], periodicita:[]};
	programmiObj.programmi.push(programma);
	posizioneProgramma=programmiObj.programmi.length-1;	
}

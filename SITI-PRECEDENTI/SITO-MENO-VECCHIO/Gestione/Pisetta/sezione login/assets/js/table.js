//VARIABILI GLOBALI

nInserimenti=0;
nUtenti=0;
nUtentiN=0;

checkGiorno = new Array();
checkOra = new Array();
utentiAvvio = new Array();
utentiNotifiche = new Array();

//FUNZIONI

function aggiorna_data(){
	
	var giorno = document.getElementById("configurazione_giorni").value;
	var ora = document.getElementById("id_ora_data").value;
	
	var flag = true;
		
	if(nInserimenti!=0){		
		
		for(i=0;i<checkGiorno.length;i++){
		
			if(checkGiorno[i]==giorno && checkOra[i]==ora){
					
					flag = false;
					alert("Calendarizzazione già inserita.");

			}
		}
	}
		
	if(ora==""){
			
		alert("Inserisci un orario.");
			
	}else if(flag){
			
		var text = "<tr><td>"+giorno+"</td><td>"+ora+"</td></tr>";
		
		checkOra[nInserimenti] = ora;
		checkGiorno[nInserimenti] = giorno;
		nInserimenti++;
		
		document.getElementById("id_elenco_data").innerHTML += text;
		
	}
}

function aggiorna_autorizzazioneAvvio(){
	
	var utente = document.getElementById("configurazione_idutente").value;
	
	var tipo = utente.charAt(0);
	var nome = utente.slice(3);
	
	if(tipo=='u'){
		
		tipo="utente";
		
	}else{
		
		tipo="amministratore";
		
	}
	
	
	
	var flag = true;
		
	if(nUtenti!=0){		
		
		for(i=0;i<utentiAvvio.length;i++){
		
			if(utentiAvvio[i]==utente){
					
					flag = false;
					alert("Utente già inserito.");

			}
		}
	}
	
	if(flag){
		
		var text = "<tr><td>/DA IMPLEMENTARE ID/</td><td>"+nome+"</td><td>"+tipo+"</td></tr>";
		document.getElementById("elenco_utentiAvvio").innerHTML += text;
		
		utentiAvvio[nUtenti]=utente;
		nUtenti++;
		
	}
}

function aggiorna_autorizzazioneNotifiche(){
	
	var utente = document.getElementById("configurazione_idutente1").value;
	
	var tipo = utente.charAt(0);
	var nome = utente.slice(3);
	
	if(tipo=='u'){
		
		tipo="utente";
		
	}else{
		
		tipo="amministratore";
		
	}
	
	
	
	var flag = true;
		
	if(nUtentiN!=0){		
		
		for(i=0;i<utentiNotifiche.length;i++){
		
			if(utentiNotifiche[i]==utente){
					
					flag = false;
					alert("Utente già inserito.");

			}
		}
	}
	
	if(flag){
		
		var text = "<tr><td>/DA IMPLEMENTARE ID/</td><td>"+nome+"</td><td>"+tipo+"</td></tr>";
		
		document.getElementById("elenco_utentiNotifiche").innerHTML += text;
		
		utentiNotifiche[nUtentiN]=utente;
		nUtentiN++;
		
	}
}

function salvaProgramma(){
	
	
	var conferma = confirm("Vuoi salvare le impostazioni?");
	
	if(conferma){
			
		nInserimenti=0;
		nUtenti=0;
		nUtentiN=0;

		checkGiorno = new Array();
		checkOra = new Array();
		utentiAvvio = new Array();
		utentiNotifiche = new Array();
		
		var arrayProcesso = [
		{
			idProgramma : document.getElementsByName("id_programma"),
			descrizione : document.getElementsByName("configurazione_descrizioneprogramma"),
			idPrerequisito : document.getElementsByName("configurazione_idprerequisito"),
			descrizionePrerequisito : document.getElementsByClassName("configurazione_prerequisito"),
			tipologia : document.getElementsByClassName("configurazione_tipoprogramma"),
			
			giorni : checkGiorno,
			ora : checkOra,
			
			avvio : utentiAvvio,
			notifica : utentiNotifiche,
			
		}];
			
		var myJSON,text,obj;
		
		myJSON = JSON.stringify(arrayProcesso);
		localStorage.setItem("Array",arrayProcesso);
		
		text = localStorage.getItem("Array");
		obj = JSON.parse(text);
		
		document.getElementById("nibba").innerHTML = obj.descrizione;
		
		
		
	}
}
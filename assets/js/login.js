const visibilityToggle = document.querySelector('.visibility');

const input1 = document.querySelector('.input-container input');

var password = true;

visibilityToggle.addEventListener('click', function() {
  if (password) {
    input1.setAttribute('type', 'text');
    visibilityToggle.innerHTML = 'visibility';
  } else {
    input1.setAttribute('type', 'password');
    visibilityToggle.innerHTML = 'visibility_off';
  }
  password = !password;
  
});
function validate(){
	var utentiObj = {utenti:[ 
						{username:"admin", pass: "admin", permesso: "am", nome: "Super User", email:"aa@aa.it"},
						{username:"utente", pass: "utente", permesso: "ut", nome: "utente generico", email:"bb@aa.it"},
						{username:"am-Pisetta", pass: "admin", permesso: "am", nome: "Paolo Pisetta", email:"cc@aa.it"},
						{username:"ut-Bortolon", pass: "utente", permesso: "ut", nome: "Matteo Bortolon", email:"dd@aa.it"},
						{username:"ut-Bouveret", pass: "utente", permesso: "ut", nome: "Samuele Bouveret", email:"ee@aa.it"},
						{username:"ut-Pisoni", pass: "utente", permesso: "ut", nome: "Simone Pisoni", email:"ff@aa.it"}
					]};
	var utentiJSON = JSON.stringify(utentiObj);
	localStorage.setItem("localUtentiJSON", utentiJSON);
	
	var programmiObj = {programmi:[ 
							{
							id:"a001",
							descrizione:"Programma per eseguire il backup di tutti i file nel sistema", 
							prerequisito: "nessuno",
							durataprevista:"20",
							tipo:"periodico",
							autorizzati: ["admin", "am-Pisetta"],
							notifiche: ["admin", "am-Pisetta", "ut-Bortolon"],
							periodicita: [
										{giorno:"lunedi", ora:"20:30"},
										{giorno:"martedi", ora:"20:30"}]},
							{
							id:"a002",
							descrizione:"Accende tutti i PC del piano", 
							prerequisito: "nessuno",
							durataprevista:"30",
							tipo:"periodico",
							autorizzati: ["admin", "am-Pisetta"],
							notifiche: ["admin", "am-Pisetta", "ut-Bortolon"],
							periodicita: [
										{giorno:"lunedi", ora:"20:30"},
										{giorno:"martedi", ora:"20:30"}]},
							{
							id:"b003",
							descrizione:"Cancella account", 
							prerequisito: "a001",
							durataprevista:"10",
							tipo:"su richiesta",
							autorizzati: ["admin", "am-Pisetta"],
							notifiche: ["admin", "am-Pisetta", "ut-Bortolon"],
							periodicita: []},
							{
							id:"b004",
							descrizione:"Stampa stipendi", 
							prerequisito: "a001",
							autorizzati: ["admin", "am-Pisetta"],
							durataprevista:"40",
							tipo:"su richiesta",
							notifiche: ["admin", "am-Pisetta", "ut-Bortolon"],							
							periodicita: []},
							{
							id:"c005",
							descrizione:"Stampa rendiconto", 
							prerequisito: "a002",
							durataprevista:"20",
							tipo:"periodico",
							autorizzati: ["admin", "am-Pisetta"],
							notifiche: ["admin", "am-Pisetta", "ut-Bortolon"],
							periodicita: [
										{giorno:"lunedi", ora:"20:30"},
										{giorno:"martedi", ora:"20:30"}]},
					]};
					
	var programmiJSON = JSON.stringify(programmiObj);
	localStorage.setItem("localProgrammiJSON", programmiJSON);
	
	var usernameInserito = document.getElementById("username").value;
	var passwordInserito = document.getElementById("password").value;
	i=0;
	trovato=false;
	
    while(i<utentiObj.utenti.length && !trovato)
    {	
        if(usernameInserito == utentiObj.utenti[i].username)
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
		alert("Nome utente errato");
	}
	else
	{
		if(passwordInserito != utentiObj.utenti[i].pass)
		{
			alert("Password errata");
		}
		else
		{
			if(utentiObj.utenti[i].permesso == 'am')
			{	
				window.location.assign("amministratore/home.html");
			}
            else 
			{
				window.location.assign("user/home.html");
			}
		}        
	}
}
			
function passwordVisibility() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
			
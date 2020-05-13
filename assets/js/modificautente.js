var indice = localStorage.getItem("indiceUtente");
var utentiJSON 	= localStorage.getItem("localUtentiJSON");
var utentiObj 	= JSON.parse(utentiJSON);

modifica();

function modifica(){
	document.getElementById("iduser").value = utentiObj.utenti[indice].username;
	document.getElementById("nomeecognome").value = utentiObj.utenti[indice].nome;
	document.getElementById("email").value = utentiObj.utenti[indice].email;
	document.getElementById("category").value = utentiObj.utenti[indice].permesso;
}

function aggiorna(){
	utentiObj.utenti[indice].username = document.getElementById("iduser").value;
	utentiObj.utenti[indice].nome = document.getElementById("nomeecognome").value;
	utentiObj.utenti[indice].email = document.getElementById("email").value;
	utentiObj.utenti[indice].permesso = document.getElementById("category").value;	
	
	utentiJSON = JSON.stringify(utentiObj);
	localStorage.setItem("localUtentiJSON", utentiJSON);
}
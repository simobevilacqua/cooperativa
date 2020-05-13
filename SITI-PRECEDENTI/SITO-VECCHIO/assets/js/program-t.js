var array = [
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
    
    }];
var arrayLen = array.length;
var x = "id";

function cerca() {
    var id = modulo.id.value;
    var nome = modulo.nome.value;
    text = " ";
    var i=0;
    var via=true;
    if(id != ""){
        while(i<arrayLen && via){ 
            if(array[i]["id"].localeCompare(id)==0){
                text += "<tr><td>"+array[i]["id"]+"</td>"+"<td>"+array[i]["nome"]+"</td>"+"<td>"+array[i]["descrizione"]+"</td>"+"<td>"+array[i]["durataprevista"]+"</td>"+"<td>"+array[i]["tipo"]+"</td><td><a href=" + '"#"' + "class=" + '"button special fit"' + ">" + "Avvia" + "</a></td><td><a href=" + '"program-table-modifica.html"' + "class=" + '"button special fit"' + ">" + "Modifica" + "</a></td><td><a href="+ '"#"' + "class=" + '"button special fit"' + ">" + "Elimina" + "</a></td></tr>";    
                via=false;
            }else{
                i++;
            }
        }
    }else if(nome != ""){
        while(i<arrayLen && via){
            if(array[i]["nome"].localeCompare(nome)==0){
                text += "<tr><td>"+array[i]["id"]+"</td>"+"<td>"+array[i]["nome"]+"</td>"+"<td>"+array[i]["descrizione"]+"</td>"+"<td>"+array[i]["durataprevista"]+"</td>"+"<td>"+array[i]["tipo"]+"</td><td><a href=" + '"#"' + "class=" + '"button special fit"' + ">" + "Avvia" + "</a></td><td><a href=" + '"program-table-modifica.html"' + "class=" + '"button special fit"' + ">" + "Modifica" + "</a></td><td><a href="+ '"#"' + "class=" + '"button special fit"' + ">" + "Elimina" + "</a></td></tr>";
                via=false;
            }else{
                i++;
            }
        }
    }else{
        text="";
    }
    if(text == " "){
        alert("Nessun processo trovato!");
    }else if(text != ""){
        document.getElementById("ricerca").innerHTML = text;
    }else{
        alert("Impossibile cercare se i campi sono vuoti!");
    }
    
}


function ordinamento(tipo){
    
    if(x != tipo){
        document.getElementById(x).src='../img/basso.png';
        x = tipo;
    }
 
    if(document.getElementById(tipo).src=='file:///C:/Users/davide.sontacchi/Desktop/sito/img/basso.png'){
        document.getElementById(tipo).src='../img/alto.png';
    }else{
        document.getElementById(tipo).src='../img/basso.png';
    }
    
    for(var i=0; i<arrayLen-1;i++){
        for(var y=i; y<arrayLen;y++){
            if(array[i][tipo] > array[y][tipo]){
                tmp = array[i];
                array[i] = array[y];
                array[y] = tmp;
            }
        }
    }

    var text = "";
    for(var z = 0; z<arrayLen; z++){
        text += "<tr><td>"+array[z]["id"]+"</td>"+"<td>"+array[z]["nome"]+"</td>"+"<td>"+array[z]["descrizione"]+"</td>"+"<td>"+array[z]["durataprevista"]+"</td>"+"<td>"+array[z]["tipo"]+"</td><td><a href=" + '"#"' + "class=" + '"button special fit"' + ">" + "Avvia" + "</a></td><td><a href=" + '"program-table-modifica.html"' + "class=" + '"button special fit"' + ">" + "Modifica" + "</a></td><td><a href="+ '"#"' + "class=" + '"button special fit"' + ">" + "Elimina" + "</a></td></tr>";
    }
    
    document.getElementById("ricerca").innerHTML = text;
}



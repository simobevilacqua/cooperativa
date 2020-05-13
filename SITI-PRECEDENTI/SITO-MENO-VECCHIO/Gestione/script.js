var array = 
    [{
        id: "a001",
        nome: "Backup",
        descrizione: "Programma per eseguire il backup di tutti i file nel sistema",
        durataprevista: "3:00 h",
        tipo: "periodico",
    },
    {
        id: "d002",
        nome: " Accensione PC ",
        descrizione: "Accende tutti i PC del piano",
        durataprevista: "0:30 h",
        tipo: "periodico",
    
    },
    {
        id: "h003",
        nome: "Cancella account",
        descrizione: "Cancella accounto",
        durataprevista: "1:30 h",
        tipo: "periodico",
    
    }];
arrayLen= array.length;

//for(int i=0; i<arrayLen; i++){
  //  text+= "<tr><td>"+array[i]["id"]+"</td>"+"<td>"+array[i]["nome"]+"</td>"+"<td>"+array[i]["descrizione"]+"</td>"+"<td>"+array[i]["durataprevista"]+"</td>"+"<td>"+array[i]["tipo"]+"</td></tr>"; 
//}
function cerca(){
    var id= modulo.id.value;
    var nome= modulo.nome.value;
    text= "";
    var i=0;
    var via=true;
    alert("ciao");
    if(id != ""){
        while(i<arrayLen && via){
             alert("while");
            if(array[i]["id"].equals(id)){
                 alert("ciao");
                text += "<tr><td>"+array[i]["id"]+"</td>"+"<td>"+array[i]["nome"]+"</td>"+"<td>"+array[i]["descrizione"]+"</td>"+"<td>"+array[i]["durataprevista"]+"</td>"+"<td>"+array[i]["tipo"]+"</td></tr>";             via=false;
                
            }
            i++;
        }
    }else if(nome != ""){
        while(i<arrayLen && via){
            if(array[i]["nome"].equals(nome)){
                text += "<tr><td>"+array[i]["id"]+"</td>"+"<td>"+array[i]["nome"]+"</td>"+"<td>"+array[i]["descrizione"]+"</td>"+"<td>"+array[i]["durataprevista"]+"</td>"+"<td>"+array[i]["tipo"]+"</td></tr>";             via=false;
                
            }
            i++;
        }
    }else{
        text="";
    }
    
    if(text != ""){
        tabella.corpotabella.value= text;
    }
    
}


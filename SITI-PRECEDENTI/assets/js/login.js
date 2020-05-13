function validate(){
    var trovato=false;
    var usernameInserito = document.getElementById("username").value;
    var passwordInserito = document.getElementById("password").value;

    $.get('account/account.txt', function(file) {
        var riga = file.split("-");
        var username = new Array;
        var pass = new Array;
        var permesso = new Array;
        /*	
        permesso --> am amministratore
        permesso --> ut user
        */
        for(var i=0;i<riga.length;i++){
            var rigadivisa = riga[i].split(";");
            username[i] = rigadivisa[0];
            pass[i] = rigadivisa[1];
            permesso[i] = rigadivisa[2];
        }

        for(var i=0;i < username.length && trovato == false;i++){

            if(usernameInserito == username[i]){

                if(passwordInserito == pass[i]){
                    trovato=true;		

                    if(permesso[i] == 'am'){
                        window.location = "amministratore/home.html";
                    }
                    else if(permesso[i] == 'ut'){
                        window.location = "user/home.html";
                    }
                }
                else{
                    alert("Password incorretta");
                }
            }
        }
    });
}
			
function passwordVisibility() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
			
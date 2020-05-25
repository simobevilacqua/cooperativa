function controlla(){
    if(modulo.psw.value != modulo.confpsw.value){
        alert("Hai inserito due password diverse!!");
        return false;
    }else{
        return true;
    }
}


const visibilityToggle = document.querySelector('.visibility');

const visibilityToggle2 = document.querySelector('.visibility2');

const input1 = document.querySelector('.input-container input');
const input2 = document.querySelector('.input-container2 input');

var password = true;
var password2 = true;


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


visibilityToggle2.addEventListener('click', function() {
  if (password) {
    input2.setAttribute('type', 'text');
    visibilityToggle2.innerHTML = 'visibility';
  } else {
    input2.setAttribute('type', 'password');
    visibilityToggle2.innerHTML = 'visibility_off';
  }
  password = !password;
  
});

function passwordVisibility() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function passwordVisibility2() {
  var x = document.getElementById("password2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
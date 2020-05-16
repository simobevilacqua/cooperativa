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

function passwordVisibility() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
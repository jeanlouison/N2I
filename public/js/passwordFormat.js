var pseudo = document.getElementById("pseudo");
var password = document.getElementById("password");
var confirm_password = document.getElementById("confirmPassword");

function validatePseudo() {

    // Pseudo length's check.
    if(pseudo.value.toString().length < 4) {
        pseudo.setCustomValidity("Pseudo trop court");
    } else {
        pseudo.setCustomValidity('');
    }
}

function validatePassword() {

    // Password length's check.
    if(password.value.toString().length < 4) {
        password.setCustomValidity("Mot de passe est trop court");
    }
    else {
        password.setCustomValidity('');
    }

    // Passwords' matching check.
    if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Mot de passe non identique");
    } else {
        confirm_password.setCustomValidity('');
    }
}

// Set triggers.
pseudo.onkeyup = validatePseudo;
password.onkeyup = validatePassword;
confirm_password.onkeyup = validatePassword;
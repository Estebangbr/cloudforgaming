//Captcha
$(document).ready(function() {

    const $valueSpan = $('.valueSpan2');
    const $value = $('#captcha');
    $valueSpan.html($value.val());
    $value.on('input change', () => {

        $valueSpan.html($value.val());
    });
});

function checkEmail(){
    // On récupère la value de l'input email
    let email = $('#inputEmail').val();

    // On récupère une regex de test d'email et on stocke sa réponse dans isValid
    let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    let isValid = regex.test(email);

    // Si l'email est valide on vient vérifier en base qu'il n'existe pas déjà
    if (isValid) {
        let alreadyExists = false;
        $.get(
            // URL du script
            'settings/verifField.php',
            // paramètres du script
            'email=' + email,
            // fonction callback qui récupère la data du script
            function(data){
                if (data === 'true') {
                    alreadExists = true;
                    $('#s_inputEmail').html("L\'email est déjà utilisé");
                    $('#inputEmail').css("borderColor", "red");
                } else {
                    $('#s_inputEmail').html(" ");
                }
            }
        );

        // Ternaire pour retourner true ou false selon si l'email existait ou pas
        return alreadyExists ? true:false;
    } else {
        return false;
    }
}

// check add member
function check() {

    let res = true;

    //Check if first name is correct
	const firstName = document.getElementById('firstName');
	if (checkFirstName(firstName) === false) {
		displayError(firstName);
		res = false;
	} else {
		displaySuccess(firstName);
	}

	//Check if last name is correct
	const lastName = document.getElementById('lastName');
	if (checkLastName(lastName) === false) {
		displayError(lastName);
		res = false;
	} else {
		displaySuccess(lastName);
	}

	//Check if email is correct
	const inputEmail = document.getElementById('inputEmail');
	if (checkInputEmail(inputEmail) === false) {
		displayError(inputEmail);
		res = false;
	} else {
		displaySuccess(inputEmail);
	}

    //Check if birth date is correct
    const birthDate = document.getElementById('birthDate');
    if (checkBirthDate(birthDate) === false) {
        displayError(birthDate);
        res = false;
    } else {
        displaySuccess(birthDate);
    }

    //Check if phone number is correct
    const phoneNumber = document.getElementById('phoneNumber');
    if (checkPhoneNumber(phoneNumber) === false) {
        displayError(phoneNumber);
        res = false;
    } else {
        displaySuccess(phoneNumber);
    }

    //Check if password is correct
    const inputPassword = document.getElementById('inputPassword');
    if (checkInputPassword(inputPassword) === false) {
        displayError(inputPassword);
        res = false;
    } else {
        displaySuccess(inputPassword);
    }

    //Check if confirm password is correct
    const confirmPassword = document.getElementById('confirmPassword');
    if (checkRepeatPassword(confirmPassword,inputPassword) === false) {
        displayError(confirmPassword);
        res = false;
    } else {
        displaySuccess(confirmPassword);
    }

    //Check if captcha is correct
    const slider = document.getElementById("captchaValue");
    let t = 0;
    if(slider.textContent === '100') {
        t = 1;
    }
    //const formRegister = document.getElementById('formRegister');
    if (t === 1){
        formRegister.action = "settings/verifRegister.php";
    }

    return res;
}


// Display verification
function displayError(input) {
    input.style.borderColor = 'red';
}

function displaySuccess(input) {
    input.style.borderColor = 'green';
}

// All check test

//check first name
function checkFirstName(firstName) {
    let res = true;
    let hasNumber = /\d/;
    let val = firstName.value;
    const s_firstName = document.getElementById('s_firstName');
    if (hasNumber.test(val) === true) {
        s_firstName.innerHTML = 'Le prenom ne doit pas contenir de chiffre';
        res = false;
    } else if (firstName.value.length < 1) {
        s_firstName.innerHTML = 'Remplir le prenom';
        res = false;
    } else s_firstName.innerHTML = '';
    return res;
}

//check last name
function checkLastName(lastName) {
    let res = true;
    var hasNumber = /\d/;
    var val = lastName.value;
    const s_lastName = document.getElementById('s_lastName');
    if (hasNumber.test(val) === true) {
        s_lastName.innerHTML = 'Le nom ne doit pas contenir de chiffre';
        res = false;
    } else if (lastName.value.length < 1) {
        s_lastName.innerHTML = 'Remplir le nom';
        res = false;
    } else s_lastName.innerHTML = '';
    return res;
}


//check mail
function checkInputEmail(inputEmail) {
    let res = true;

    const s_inputEmail = document.getElementById('s_inputEmail');
    if (inputEmail.value.length < 4) {
        s_inputEmail.innerHTML = 'Email min 4 caractère';
        res = false;
    } else if (inputEmail.value.indexOf('@') === -1) {
        s_inputEmail.innerHTML = 'Il manque un @';
        res = false;
    } else if (inputEmail.value.indexOf('.') === -1) {
        s_inputEmail.innerHTML = 'Il manque un point';
        res = false;
    } else s_inputEmail.innerHTML = '';
    return res;
}

//check birth date
function checkBirthDate(birthDate) {
    let res = true;
    const s_birthDate = document.getElementById('s_birthDate');
    if (birthDate.value.length < 8) {
        s_birthDate.innerHTML = 'Pas complet';
        res = false;
    } else s_birthDate.innerHTML = '';
    return res;
}

//check phone number
function checkPhoneNumber(phoneNumber) {
    let res = true;
    let phoneno = /^\d{10}$/;
    const s_phoneNumber = document.getElementById('s_phoneNumber');
    let val = phoneNumber.value.replace(/\s/g,"");
    if (val.length < 10){
        s_phoneNumber.innerHTML = 'Le numéro de téléphone n\'est pas complet';
        res = false;
    } else if (val.length > 10){
        s_phoneNumber.innerHTML = 'Le numéro de téléphone est trop grand';
        res = false;
    }else if(val.match(phoneno)) {
        res = true;
        s_phoneNumber.innerHTML = '';
    }
    return res;
}

//check password
function checkInputPassword(inputPassword) {
    let res = true;
    const s_inputPassword = document.getElementById('s_inputPassword');
    let val = inputPassword.value; // copy pwd
    let hasNumber = /\d/; // number

    if (inputPassword.value.length >= 8) {
        if (val.toLowerCase() === inputPassword.value) {
            s_inputPassword.innerHTML = 'Il manque une Majuscule';
            res = false;
        } else if (val.toUpperCase() === inputPassword.value) {
            s_inputPassword.innerHTML = 'Il manque une minuscule';
            res = false;
        } else if (hasNumber.test(val) === false) {
            s_inputPassword.innerHTML = 'Il manque un chiffre';
            res = false;
        } else s_inputPassword.innerHTML = '';
    } else {
        s_inputPassword.innerHTML = 'Vous devez renseigner au moins 8 caractères';
        res = false;
    }

    return res;
}

//check confirm password
function checkRepeatPassword(confirmPassword,inputPassword){
    let res = true;
    const s_confirmPassword = document.getElementById('s_confirmPassword');
    if (confirmPassword.value.length > 1) {
        if (confirmPassword.value !== inputPassword.value) {
            s_confirmPassword.innerHTML = 'Mot de passe différent';
            res = false;
        } else s_confirmPassword.innerHTML = '';
    } else {
        s_confirmPassword.innerHTML = 'Vous devez remplir le champ';
        res = false;
    }
    return res;
}

function delImage() {
    const mail = document.getElementById('mail');
    const r = confirm("Etes-vous sûr de vouloir supprimer l'image de profil ?");
    if (r === true) {
        const word = mail.value;
        const request = new XMLHttpRequest();
        request.open('GET', 'settings/imgDel.php?email=' + word);
        request.send();
        alert("L'image a bien été supprimé");
    }
}

// Comfirm delete account
function comfirmDel() {
    const del_form = document.getElementById('del_form');
    const r = confirm("Etes-vous sûr de vouloir supprimer ce compte ?");
    if (r === true) {
        del_form.action = "settings/delProfile.php";
        return true;
    } else {
        return false;
    }
}

// check edit profil
function checkModif() {

    let res = true;

    //Check if first name is correct
    const name = document.getElementById('name');
    if (checkFirstName(name) === false) {
        displayError(name);
        res = false;
    } else {
        displaySuccess(name);
    }

    //Check if last name is correct
    const surname = document.getElementById('surname');
    if (checkLastName(surname) === false) {
        displayError(surname);
        res = false;
    } else {
        displaySuccess(surname);
    }

    //Check if email is correct
    const mail = document.getElementById('mail');
    if (checkMail(mail) === false) {
        displayError(mail);
        res = false;
    } else {
        displaySuccess(mail);
    }

    //Check if birth date is correct
    const birthday = document.getElementById('birthday');
    if (checkBirthDate(birthday) === false) {
        displayError(birthday);
        res = false;
    } else {
        displaySuccess(birthday);
    }

    //Check if phone number is correct
    const phoneNumber = document.getElementById('phoneNumber');
    if (checkPhoneNumber(phoneNumber) === false) {
        displayError(phoneNumber);
        res = false;
    } else {
        displaySuccess(phoneNumber);
    }

    const pwd_old = document.getElementById('pwd_old');
    if (checkPwdOld(pwd_old) === false) {
        displayError(pwd_old);
        res = false;
    } else {
        displaySuccess(pwd_old);
    }
    //Check if password is correct
    const pwd1 = document.getElementById('pwd1');
    if (checkInputPassword(pwd1) === false) {
        displayError(pwd1);
        res = false;
    } else {
        displaySuccess(pwd1);
    }
    const pwd2 = document.getElementById('pwd2');
    if (checkRepeatPassword(pwd2) === false) {
        displayError(pwd2);
        res = false;
    } else {
        displaySuccess(pwd2);
    }
    return res;
}


function checkPwdOld(){
    // On récupère la value de l'input email
    let pwd_old = $('#pwd_old').val();

        let alreadyExists = false;
        $.get(
            // URL du script
            'settings/verifField.php',
            // paramètres du script
            'pwd=' + pwd_old,
            // fonction callback qui récupère la data du script
            function(data){
                if (data === 'true') {
                    alreadExists = true;
                    $('#pwd_old').css("borderColor", "green");
                } else {
                    $('#s_pwd_old').html("Le mot de passe ne correspond pas");
                    $('#pwd_old').css("borderColor", "red");
                }
            }
        );
        // Ternaire pour retourner true ou false selon si l'email existait ou pas
        return alreadyExists ? true:false;
}

function checkMail() {
    let res = true;
    // On récupère la value de l'input email
    let email = $('#mail').val();

    // On récupère une regex de test d'email et on stocke sa réponse dans isValid
    let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    let isValid = regex.test(email);

    if (isValid) {
        $('#s_mail').html("");
        $('#mail').css("borderColor", "green");
        res = true;
    } else {
        $('#s_mail').html("L'email est déjà utilisé");
        $('#mail').css("borderColor", "green");
        res = false;
    }
    return res;
}
















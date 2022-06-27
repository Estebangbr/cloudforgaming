// check add Entretien
function check() {

    let res = true;

    //Check if date is correct
	const date = document.getElementById('date');
	if (checkDate(date) === false) {
		displayError(date);
		res = false;
	} else {
		displaySuccess(date);
	}

	//Check if kilometrage is correct
	const kilometrage = document.getElementById('kilometrage');
	if (checkKilometrage(kilometrage) === false) {
		displayError(kilometrage);
		res = false;
	} else {
		displaySuccess(kilometrage);
	}

	//Check if montant is correct
	const montant = document.getElementById('montant');
	if (checkMontant(montant) === false) {
		displayError(montant);
		res = false;
	} else {
		displaySuccess(montant);
	}

    //Check if descriptif is correct
    const descriptif = document.getElementById('descriptif');
    if (checkDescriptif(descriptif) === false) {
        displayError(descriptif);
        res = false;
    } else {
        displaySuccess(descriptif);
    }

    //Check if modification is correct
    const modification = document.getElementById('modification');
    if (checkModification(modification) === false) {
        displayError(modification);
        res = false;
    } else {
        displaySuccess(modification);
    }

        addEntretien.action = "settings/addEntretien.php";

    return res;



}


// Display verification
function displayError(input) {
    input.style.borderColor = 'red';
}

function displaySuccess(input) {
    input.style.borderColor = 'green';
}



function checkDate(date) {
    let res = true;
    const s_date = document.getElementById('s_date');
    if (date.value.length < 8) {
        s_date.innerHTML = 'Pas complet';
        res = false;
    } else s_date.innerHTML = '';
    return res;
}


function checkKilometrage(kilometrage){
  var kilometrage = parseInt(kilometrage.value);
  let res = true;
  const s_kilometrage = document.getElementById('s_kilometrage');
  if(isNaN(kilometrage) || kilometrage < 1 ){
    s_kilometrage.innerHTML = "Veuillez rentrez uniquement des chiffres supérieurs à 1";
    res = false;
  } else s_kilometrage.innerHTML ='';
  return res;
}


function checkMontant(montant){
  var montant = parseInt(montant.value);
  let res = true;
  const s_montant = document.getElementById('s_montant');
  if(isNaN(montant) || montant < 1){
    s_montant.innerHTML = "Veuillez rentrez uniquement des chiffres supérieurs à 1";
    res = false;
  } else if (montant.length > 11) {
      s_montant.innerHTML = "Le montant doit comporter moins de 11 caractères";
      res = false;
  } else s_montant.innerHTML ='';
  return res;
}



function checkDescriptif(descriptif){
  let res = true;
  const s_descriptif = document.getElementById('s_descriptif');
  if (descriptif.value.length > 255){
    s_descriptif.innerHTML = "255 caractères maximum";
    res = false;
  } else if (descriptif.value.length < 1) {
      s_descriptif.innerHTML = 'Remplir le descriptif';
      res = false;
  } else s_descriptif.innerHTML ='';
  return res;
}


function checkModification(modification){
  let res = true;
  const s_modification = document.getElementById('s_modification');
  if (modification.value.length > 255){
    s_modification.innerHTML = "255 caractères maximum";
    res = false;
  } else if (modification.value.length < 1) {
      s_modification.innerHTML = 'Remplir le descriptif';
      res = false;
  } else s_modification.innerHTML ='';
  return res;
}

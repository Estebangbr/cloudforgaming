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

	//Check if ville is correct
	const ville = document.getElementById('ville');
	if (checkVille(ville) === false) {
		displayError(ville);
		res = false;
	} else {
		displaySuccess(ville);
	}

	//Check if adresse is correct
	const adresse = document.getElementById('adresse');
	if (checkAdresse(adresse) === false) {
		displayError(adresse);
		res = false;
	} else {
		displaySuccess(adresse);
	}

    //Check if codePostal is correct
    const descriptif = document.getElementById('codePostal');
    if (checkCodePostal(codePostal) === false) {
        displayError(codePostal);
        res = false;
    } else {
        displaySuccess(codePostal);
    }


        addEmplacement.action = "settings/verifAddEmplacement.php";

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


function checkCodePostal(codePostal){
  var codePostal = parseInt(codePostal.value);
  let res = true;
  const s_codePostal = document.getElementById('s_codePostal');
  if(isNaN(codePostal) || codePostal < 1 ){
    s_codePostal.innerHTML = 'Merci de remplir le champ "Code Postal"';
    res = false;
  } else s_codePostal.innerHTML ='';
  return res;
}






function checkVille(ville){
  let res = true;
  const s_ville = document.getElementById('s_ville');
  if (ville.value.length > 255){
    s_ville.innerHTML = "255 caractères maximum";
    res = false;
  } else if (ville.value.length < 1) {
      s_ville.innerHTML = 'Merci de remplir le champ "Ville"';
      res = false;
  } else s_ville.innerHTML ='';
  return res;
}


function checkAdresse(adresse){
  let res = true;
  const s_adresse = document.getElementById('s_adresse');
  if (adresse.value.length > 255){
    s_adresse.innerHTML = "255 caractères maximum";
    res = false;
  } else if (adresse.value.length < 1) {
      s_adresse.innerHTML = 'Merci de remplir le champ "Adresse"';
      res = false;
  } else s_adresse.innerHTML ='';
  return res;
}

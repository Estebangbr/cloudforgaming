// check add panne
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

    //Check if descriptif is correct
    const descriptif = document.getElementById('descriptif');
    if (checkDescriptif(descriptif) === false) {
        displayError(descriptif);
        res = false;
    } else {
        displaySuccess(descriptif);
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

function checkDate(date) {
    let res = true;
    const s_date = document.getElementById('s_date');
    if (date.value.length < 8) {
        s_date.innerHTML = 'Pas complet';
        res = false;
    } else s_date.innerHTML = '';
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

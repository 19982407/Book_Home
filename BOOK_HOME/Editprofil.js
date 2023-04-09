////////////////////////////////////////////////////////////////Validation form Edit UP///////////////////////////////////////////
const form = document.getElementById('form');
const namee = document.getElementById('name');
const date_de_naissance = document.getElementById('date');
const téléphone = document.getElementById('téléphone');
const email = document.getElementById("email");
const adress = document.getElementById('adress');
const password = document.getElementById('password');
const confirm_password = document.getElementById('confirmPassword');

function valideInput(e) {
    const nameValue = namee.value.trim();
    const emailValue = email.value.trim();
    const adressValue = adress.value.trim();
    const téléphoneValue = téléphone.value.trim();
    const date_de_naissanceValue = new Date(date_de_naissance.value);
    const passwordValue = password.value.trim();
    const confirmPasswordValue = confirm_password.value.trim();
    // is validate 
    var isValidate = true;

    // Name
    if (nameValue) {
        document.getElementById("nameContainer").classList.add("d-none");
        isValidate = true;
    } else {
        document.getElementById("nameContainer").classList.remove("d-none");
        isValidate = false;
    }

    // Email
    if ((/^((\w+).(\w+).(\w+)@(gmail|hotmail|yahoo).(com|org|net|ma))$/.test(emailValue)) && emailValue) {
        document.getElementById("emailContainer").classList.add("d-none");
        isValidate = true;
    } else {
        document.getElementById("emailContainer").classList.remove("d-none");
        isValidate = false;
    }

    // Adress
    if (adressValue) {
        document.getElementById("adressContainer").classList.add("d-none");
        isValidate = true;
    } else {
        document.getElementById("adressContainer").classList.remove("d-none");
        isValidate = false;
    }

    // phone
    if (téléphoneValue) {
        document.getElementById("phoneContainer").classList.add("d-none");
        isValidate = true;
    } else {
        document.getElementById("phoneContainer").classList.remove("d-none");
        isValidate = false;
    }

    // Date
    if (date_de_naissanceValue === "Invalid Date" || date_de_naissanceValue.getFullYear() < new Date().getFullYear()) {
        document.getElementById("dateContainer").classList.add("d-none");
        isValidate = true;
    } else {
        document.getElementById("dateContainer").classList.remove("d-none");
        isValidate = false;
    }

    // Password
    if (passwordValue) {
        document.getElementById("passwordContainer").classList.add("d-none");
        isValidate = true;
    } else {
        document.getElementById("passwordContainer").classList.remove("d-none");
        isValidate = false;
    }

    // Confirm
    if ((passwordValue === confirmPasswordValue) &&  (passwordValue) && (confirmPasswordValue)) {
        document.getElementById("confirmPasswordContainer").classList.add("d-none");
        isValidate = true;
    } else {
        document.getElementById("confirmPasswordContainer").classList.remove("d-none");
        isValidate = false;
    }
    if (!isValidate) {
        e.preventDefault();
    }
}
form.addEventListener("submit", (e) => {
    valideInput(e);
});

let profile = document.getElementById("lst")
let lstitems = document.getElementById("lstitems")
profile.addEventListener("click",function(){
    lstitems.classList.toggle("d-none")
})